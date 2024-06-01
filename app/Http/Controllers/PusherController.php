<?php

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    //
    public function broadcast(Request $request){
        broadcast(new PusherBroadcaster($request->get(key:'move')));

        return ['from'=>$request->get(key:'from'), 'to'=>$request->get(key:'to')];
    }
    public function receive(Request $request){
        return ['from'=>$request->get(key:'from'), 'to'=>$request->get(key:'to')];

    }
}
