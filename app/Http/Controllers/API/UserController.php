<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller {

public $successStatus = 200;
/** 
* login api end point
* requires email and password
* @return \Illuminate\Http\Response 
*/ 
public function login(){ 
	
	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
	
		$user = Auth::user(); 
		$success['token'] =  $user->createToken('laravelAPI')-> accessToken; 
		$success["user_id"] = $user->id;
		return response()->json(['success' => $success], $this-> successStatus); 
	
	} 
	else{ 
		return response()->json(['error'=>'Unauthorised'], 401); 
	} 
}
/** 
* Register api end point 
* @param Request $request 	name, email, password and confirm password required to register users
* @return \Illuminate\Http\Response 
*/ 
public function register(Request $request){

	$validator = Validator::make($request->all(), [ 
		'name' => 'required', 
		'email' => 'required|email', 
		'password' => 'required', 
		'c_password' => 'required|same:password', 
	]);

	if ($validator->fails()) { 
	    return response()->json(['error'=>$validator->errors()], 401);            
	}

	$input = $request->all(); 
	$input['password'] = bcrypt($input['password']); 
	$user = User::create($input); 
	$success['token'] =  $user->createToken('laravelAPI')-> accessToken; 
	$success['name'] =  $user->name;

	return response()->json(['success'=>$success], $this-> successStatus); 
}



}