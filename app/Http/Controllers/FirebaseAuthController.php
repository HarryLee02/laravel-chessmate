<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Carbon\Carbon;
use Exception;
use Throwable;

class FirebaseAuthController extends Controller
{
    //
    protected $auth;
    protected $database;
    public function __construct()
    {
        $this->auth = Firebase::auth();
        $this->database = \App\Services\FirebaseService::connect();
    }
    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $createdUser = $this->auth->createUserWithEmailAndPassword($email,$password);
        if ($createdUser) {
            $uid = $this->auth->getUserByEmail($email)->uid;

            $this->database->getReference('players/'.$uid.'/profile')->set([
                'displayName' => $request->input('full_name'),
                'phoneNumber' => $request->input('phone_number'),   
                'gender' => $request->input('gender'),
                'country' => $request->input('country'),
                'since' => Carbon::now()->toFormattedDateString(),
            ]);
            
            return redirect('/home');
        } else {
            return redirect('/register')->with('error','email has not been registered');
        }
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $response = $this->auth->signInWithEmailAndPassword($email, $password);
        } catch (Throwable $e) {
            return redirect('/login')->with('danger',$e->getMessage());
        }

        if ($response) {
            $uid = $this->auth->getUserByEmail($email)->uid;
            session(['uid' => $uid]);
            session()->put('logged_in',true);
            return redirect('/home')->with('success','Login successful');
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        $this->auth->revokeRefreshTokens(session('uid'));
        session()->flush();
        return redirect('/home');
    }
}
