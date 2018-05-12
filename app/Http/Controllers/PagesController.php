<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // home page
    public function getIndex() { 
    	return view("page.home");
    }

}
