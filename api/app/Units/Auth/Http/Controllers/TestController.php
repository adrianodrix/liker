<?php

namespace Liker\Units\Auth\Http\Controllers;


use Illuminate\Http\Response;
use Liker\Support\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test()
    {
        return response()->json(['version' => 'v1'], Response::HTTP_OK);
    }
}