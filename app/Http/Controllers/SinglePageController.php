<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SinglePageController extends Controller
{
  public function index() {
    if (str_contains(URL::current(), '/api/')) {
      return response()->json(['message' => 'Invalid Attribute'], 404);
    } else {
      return view('app');
    }
  }
}
