<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['list', 'dashboard']
        ]);
    }

    public function index()
    {
        return view('home');
    }

    public function list()
    {
        return view('list');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
