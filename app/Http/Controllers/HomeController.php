<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
        {
            $publications = Publication::all();
            return view('tampilan.homeketua', compact('publications'));
            // return view('tampilan.homeketua');
        }
}