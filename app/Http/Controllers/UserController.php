<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
    	try {
    		if ($request) {
    			$user = new User();
		    	$user->name = $request->name;
		    	$user->userName = $request->userName;
		    	$user->email = $request->email;
		    	$user->rol = $request->rol;
		    	$user->telefono = $request->telefono;
		    	$user->sexo = $request->sexo;
		    	$user->password = bcrypt($request->password);
		    	$user->save();
    		}
    		
    	} catch (Exception $e) {

    		return response()->json(['response' => $e],500);

    	}
    	
    	return response()->json(['response' => 'éxito'],200);

       
    }
    public function compararEmail(Request $request)
    {
    	try {
    		$usuario = User::where('email', '=', $request->email)->count();
    	  	return $usuario;
    	} catch (Exception $e) {
    		return $e;
    	}
       
    }
    public function compararUsuario(Request $request)
    {
    	try {
    		$usuario = User::where('userName', '=', $request->userName)->count();
    	    return $usuario;
    	} catch (Exception $e) {
    		return $e;
    	}
       
    }

    public function edit(Request $request)
    {

       
    }

    public function delete(Request $request)
    {

       
    }

    public function getUsers()
    {

       
    }
}
