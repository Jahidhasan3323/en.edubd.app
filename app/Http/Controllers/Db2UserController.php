<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDb2;
class Db2UserController extends Controller
{
     public function index()
    {
         return UserDb2::all();
    }
}
