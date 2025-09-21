<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class HomeController extends Controller
{
    public function index()
        {
            $publications = Publication::with('stepsPlans')->get();
            return view('tampilan.homeketua', compact('publications'));
            // return view('tampilan.homeketua');
        }
}