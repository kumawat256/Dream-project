<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
    // $users = DB::connection('mongodb')->collection('users')->get();

      $user = User::with('transaction')->limit(10)->get();

      return $user;
      
      return view('admin.dashboard.dashboard');
    }
}
