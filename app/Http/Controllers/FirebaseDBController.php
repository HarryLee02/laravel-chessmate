<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseDBController extends Controller
{
    //
    private $database;

    public function __construct()
    {
       $this->database = \App\Services\FirebaseService::connect();
    }
    /**
     * Display a listing of the resource.
     */
    public function profile(Request $request)
    {
        $informations = $this->database->getReference("players/".session()->get('uid'))->getValue();

        return view('profile', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function shop(Request $request)
    {
        // if ($request->ajax()) {
        //     $items = $this->database->getReference("shops/")->getSnapshot(); 
        //     return response()->json($items);
        // }
        $items = $this->database->getReference("shops/")->getValue(); 
        return view('shop', compact('items'));
    }
}
