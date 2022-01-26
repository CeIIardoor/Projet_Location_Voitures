<?php

namespace App\Http\Controllers;

use Request;

use App\Models\User;

use Auth;
use Carbon\Carbon;
use Mail;
use Validator;


class UserController extends Controller
{

    public function showAddUser()
     { 
    	return view('pages.users.add');
     }


    public function handleAddUser()
    {
	$data=Request::all();

	$rules=[
		'firstName'=>'required',
		'lastName' =>'required',
		'email'    =>'required|unique:users',
		'phone'    =>'required|numeric',
		'password' =>'required|min:8'
	];

	$messages=[
		'firstName.required'=>'firstName is required !',
		'firstName.required'=>'firstName is required !',
		'email.email       '=>'mail invalid !'
	 ];

	$validation =Validator::make($data,$rules,$messages);
		if( $validation->fails()){
			return redirect()->back()->with('danger',$validation->errors());
		}
	
	User::create([
		'firstName'	=>	$data['firstName'],
		'lastName'	=>	$data['lastName'],
		'address'	=>	$data['address'],
		'phone'		=>	$data['phone'],
		'email'		=>	$data['email'],
		'password'	=>	bcrypt($data['password']),
		'role_id'	=>	2
	]);

    return redirect(route('showCarsList'))->with('success', 'Thank you for your trust in our company.');
}


public function showUpdateUser()
   { 
   	 if(Auth::user()){
   	    return view('pages.users.update');
    }

   else{
   	return redirect(route('home'))->with('info', 'No user found.');
   }
}



    public function handleUpdateUser()
    {
	$data=Request::all();
	$rules=[
		'email'    =>'required|unique:users',
		'phone'    =>'required|numeric',
		'password' =>'required|min:8'
	];

	$messages=[
		'phone.required'=>'the number phone is required !',
		'email.email       '=>'mail invalid !'
	 ];

	$validation =Validator::make($data,$rules,$messages);
		if( $validation->fails()){
			return redirect()->back()->withErrors($validation->errors());
		}

	$user=Auth::user();
	
 	if($user){

		$user->email   =	$data['email'];
		$user->phone   =	$data['phone'];
		$user->address =	$data['address'];
		$user->password=    bcrypt($data['password']);
	    $user->save();
	      

      	 return redirect(route('home'))->with('info', 'Updated.');
	}
	else return back();
}


 public function showUserLogin()
   { 
   	return view('pages.users.login');
   }


    public function handleUserLogin()
    {
		$data=Request::all();

	  $cred=[ 'email'	=>	$data['email'],
			'password'	=>	$data['password']
	        ];

		if(Auth::attempt($cred)){
			return redirect(route('home'));
		}

		return redirect()->back() ->with('warning', 'Incorrect mail and/or password.');
}



 public function handleUserLogout()
 {
		Auth::logout();
		return redirect(route('home'));
	
}



public function showContact()
   { 
   	return view('pages.contact');
   }

public function handleContact()
{
		$data=Request::all();
		$rules=[
		'name'     =>	'required',
		'email'    =>	'required|email',
		'message'  =>	'required|min:20'
	 ];

	$messages=[
		'name.required'	=>	'Name is required !',
	];

	$validation =Validator::make($data,$rules,$messages);

	if( $validation->fails()){
		return redirect()->back()->withErrors($validation->errors());
	}

  	 Mail::send([],[],function($message) use($data){       
       $message->to('yassine.laouina97@gmail.com','admin rentCar')
       		   ->subject($data['subject'])
       		   ->setBody($data['message']); 

       $message->from($data['email'],$data['name']);
      });

   return redirect(route('home'))->with('status', 'Testing mail');
}
}
