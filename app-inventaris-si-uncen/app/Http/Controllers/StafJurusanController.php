<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StafJurusanController extends Controller
{
    public function index()
    {
        return view('stafJurusan.index');
    }
}
