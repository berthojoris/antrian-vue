<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function list()
    {
        return view('list');
    }
}
