<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\MessageRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



//MODELS
use App\User;

//DB
use DB;

class UsersController extends Controller
{
    
    public function createRegistro(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
        	return response()->json($validator->errors(), 202);
        }


    	DB::beginTransaction();

    	$users 					= new User();
        $users->username      	= $request->username;
        $users->email       	= $request->email;
        $users->password		= bcrypt($request->password);

        if ($users->save()) {

            // login automatico
            Auth::login($users);

           	Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new MessageRegister($request));
           	DB::commit();
            return response()->json(["message" => "ok"], 202);
        }
        else {
            DB::rollback();
            return response()->json(["message" => "off"], 202);
        }
    }
}
