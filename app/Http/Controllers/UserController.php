<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
    	try {
    		if ($request) {
    			DB::beginTransaction();
    			$user = new User();
		    	$user->name = $request->name;
		    	$user->userName = $request->userName;
		    	$user->email = $request->email;
		    	$user->rol = $request->rol;
		    	$user->telefono = $request->telefono;
		    	$user->sexo = $request->sexo;
		    	$user->password = bcrypt($request->password);
		    	$user->save();
		    	DB::commit();
    		}
    		
    	} catch (Exception $e) {
			DB::rollBack();
    		return response()->json(['response' => $e],500);

    	}
    	
    	return response()->json(['response' => 'éxito'],200);

       
    }
    public function compararEmail(Request $request)
    {
    	try {
    		if ($request->idusuario == 0) {
    			$usuario = User::where('email', '=', $request->email)->count();
    		}else{
    			$usuario = User::where('email', '=', $request->email)->where('id', '!=', $request->idusuario)->count();
    		}
    	  	return $usuario;
    	} catch (Exception $e) {
    		return $e;
    	}
       
    }
    public function compararUsuario(Request $request)
    {
    	try {
    		if ($request->idusuario == 0) {
    			$usuario = User::where('userName', '=', $request->userName)->count();
    		}else{
    			$usuario = User::where('userName', '=', $request->userName)->where('id', '!=', $request->idusuario)->count();
    		}
    		
    	    return $usuario;
    	} catch (Exception $e) {
    		return $e;
    	}
       
    }

    public function editUser(Request $request)
    {
    	try {
    		DB::beginTransaction();
    		$usuario = User::where('id', '=', $request->id )->first();
    		
		   $usuario->name = $request->name;
		   $usuario->userName = $request->userName;
		   $usuario->email = $request->email;
		   $usuario->rol = $request->rol;
		   $usuario->telefono = $request->telefono;
		   $usuario->sexo = $request->sexo;
		    if (isset($request->password)) {
		    	$usuario->password =  bcrypt($request->password);
		    }
		   $usuario->save();
		    DB::commit();

    		
    	} catch (Exception $e) {
    		
    	}
       
    }

    public function delete(Request $request)
    {

       
    }

    public function getUsers()
    {
    	try {

    		$usuarios = User::orderBy('rol')->get();

    		return response()->json(['response' => $usuarios],200);
    		
    	} catch (Exception $e) {
    		return response()->json(['response' => $e],500);
    		
    	}
      
    }

    public function getUser(Request $request)
    {
    	try {

    		$usuario = User::where( 'id','=', $request->id )->first();

    		return response()->json(['response' => $usuario],200);
    		
    	} catch (Exception $e) {

    		return response()->json(['response' => $e],500);
    		
    	}
      
    }
}
