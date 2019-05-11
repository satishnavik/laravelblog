<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{

    private $form_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];


    public function home(Request $request){


        if(Auth::check()){
            return redirect('home');
        }else{
            return view('login', [
            ]);

        }

        
    }

    public function login(Request $request){

        return view('login', [
        ]);
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('home');
        }else{
            return redirect('loginuser')
            ->withInput($request->only('email', 'password'))
            ->withErrors([
                'email' => 'Invalid Credentials',
            ]);
        }
    }

    public function register(Request $request){

        return view('register', [
        ]);
    }


     public function storeuser(Request $request)
    {
        
        $this->validate($request, $this->form_rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('home');
    }
    

    public function logout(){
        Auth::logout();
        return redirect('loginuser');
    }
}