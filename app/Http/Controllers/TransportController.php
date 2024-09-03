<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function test()
    {
        dd(City::all());
    }
}
