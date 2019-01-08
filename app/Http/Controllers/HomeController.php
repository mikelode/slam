<?php

namespace Logistica\Http\Controllers;

use Illuminate\Http\Request;

use Logistica\Http\Requests;
use Logistica\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vista= view('home');
        return $vista;
        //return view('home');
    }
}
