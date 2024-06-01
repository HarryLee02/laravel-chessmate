<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FirebaseController extends Controller
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
        $items = $this->database->getReference("shops/")->getValue(); 
        return view('shop', compact('items'));
    }

    public function buy(Request $request)
    {
        //970436 
        // x-client-id : 8cb92a9c-b462-4e28-9b07-093f11113506
        // x-api-key : d47ef468-2302-474e-9815-247709ae0430
        $data = [
            'accountNo' => '1015563285',
            'accountName' => 'ChessMate team',
            'acqId' => '970436',
            'addInfo' => 'Payment for '.$request->input('itemName'),
            'amount' => $request->input('price'),
            'template' => 'Q3n5IT7',
            'format'=> "text"
        ];
           
        $response = Http::withHeaders([
            'x-client-id' => '8cb92a9c-b462-4e28-9b07-093f11113506',
            'x-api-key' => 'd47ef468-2302-474e-9815-247709ae0430'
        ])->withBody(json_encode($data), 'application/json')->post('https://api.vietqr.io/v2/generate');

        return $response->json();
    }
}
