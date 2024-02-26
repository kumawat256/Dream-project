<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $user = DB::table('users')->get();
            return view('show', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation     = $request->validate([
                                            'name'      =>'bail|required|alpha|min:5|max:20',
                                            'email'     =>'required|unique:users,email',
                                            'password'  => 'required|min:5|max:10',
                                            'cpassword' => 'same:password|',
                                            'date' => 'required'
                                        ]);

        $user = User::create($validation);

        if(Auth::attempt($validation)){
            return redirect('/user')->with('success','Login successfully');
        }

        return redirect('/user')->with('completed', 'Successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user['users'] = User::find($id);
        return view('edit',$user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = $request->validate([
                                        'name'      =>'bail|required|alpha|min:5|max:20',
                                        'email'     =>'required|unique:users,email',
                                        'password'  => 'required|min:5|max:10',
                                        'cpassword' => 'same:password|',
                                        'date' => 'required'
                                        ]);
        User::whereId($id)->update($updateData);
        return redirect('/user')->with('completed', 'Student has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
