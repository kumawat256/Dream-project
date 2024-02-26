<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;
use PhonePe\payments\v1\PhonePePaymentClient;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function showAllDataForDataTable(Request $request){

    $users = DB::connection('mongodb')->collection('users')->get();
    dd($users);
      return view('admin.dashboard.dashboard');
    }

    public function getLocation(){
        
    }

    public function loadMoney(Request $req){
      echo $req->ip(); die;
       

      $phonePePaymentsClient = new PhonePePaymentClient("PGTESTPAYUAT", "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399", 1, "UAT",false);
      $merchantTransactionId = "MT7850590068188106";
      $request = PgPayRequestBuilder::builder()
          ->mobileNumber("8441098140")
          ->callbackUrl("http://127.0.0.1:8000/admin/response")
          ->merchantId("PGTESTPAYUAT")
          ->merchantUserId("MUID123")
          ->amount(100)
          ->merchantTransactionId($merchantTransactionId)
          ->redirectUrl("http://127.0.0.1:8000/admin/response")
          ->redirectMode("REDIRECT")
          ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
          ->build();
      
      $response = $phonePePaymentsClient->pay($request);
      
      $PagPageUrl = $response->getInstrumentResponse()->getRedirectInfo()->getUrl();
      
      echo "<pre>"; print_r($PagPageUrl); die;
      


      $data = array (
        'merchantId' => 'PGTESTPAYUAT',
        'merchantTransactionId' => "MT7850590068188106",
        'merchantUserId' => 'MUID123',
        'amount' => 10000,
        'redirectUrl' => route('response'),
        'redirectMode' => 'REDIRECT',
        'callbackUrl' => route('response'),
        'mobileNumber' => '8441098140',
        'paymentInstrument' => 
        array (
        'type' => 'PAY_PAGE',
        ),
    );

    $encode = base64_encode(json_encode($data));

    $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
    $saltIndex = 1;

    $string = $encode.'/pg/v1/pay'.$saltKey;
    $sha256 = hash('sha256',$string);

    $finalXHeader = $sha256.'###'.$saltIndex;



    $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

    $request = json_encode(array('request'=>$encode));
                
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS => $request,
      CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
         "X-VERIFY: " . $finalXHeader,
         "accept: application/json"
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $res = json_decode($response);
      echo "<pre>"; print_r($res); die;
      if(isset($res->success) && $res->success=='1'){
        $paymentCode=$res->code;
        $paymentMsg=$res->message;
        $payUrl=$res->data->instrumentResponse->redirectInfo->url;
        
        header('Location:'.$payUrl);
        }
    }

    //return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
    }

    public function phonepe_notify(Request $request){
      \Log::info(json_encode($request));
    }
}
