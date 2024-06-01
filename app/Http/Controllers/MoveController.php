<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MakeMove;
class MoveController extends Controller
{
    //
    public function makeMove(Request $request){
        event(new MakeMove( $request->input('from'), $request->input('to') ));

        return ['from'=>$request->input('from'), 'to'=>$request->input('to')];
    }

    public function receiveMove(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    event(new MakeMove($from, $to));
    return ['from'=>$request->input('from'), 'to'=>$request->input('to')];
}
}
