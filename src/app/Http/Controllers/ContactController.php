<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()//
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $contact = $request->all();
        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        $contact = $request->all();

    }
}
