<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Firebase\Auth\Token\Exception\InvalidToken;



$factory = (new Factory)
    ->withServiceAccount(__DIR__.'/chessmate-577b0-firebase-adminsdk-r242s-a3e8fae4c6.json')
    ->withDatabaseUri('https://chessmate-577b0-default-rtdb.asia-southeast1.firebasedatabase.app/');
    
$database = $factory->createDatabase();
$auth = $factory->createAuth();
?>