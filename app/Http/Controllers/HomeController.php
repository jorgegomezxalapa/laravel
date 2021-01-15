<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
           $user = Auth::user();
            return response(['message' =>'success', 'data' => $user], 200);
        }else{
            return response()->json(['error' => 'Invalid user name or password.'], 401);
        }
       
    }

    public function getperfil(){
        $user = Auth::user();
        return response(['message' =>'success', 'data' => $user], 200);

    }

    public function dashboard (){
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

         return response(['message' =>'success'], 200);
    }
}
