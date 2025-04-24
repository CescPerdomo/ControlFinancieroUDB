<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index()
    {
        $items = Prueba::all();
        return view('prueba.index', compact('items'));
    }
}
