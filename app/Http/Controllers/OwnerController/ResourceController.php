<?php

namespace App\Http\Controllers\OwnerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;

class ResourceController extends Controller
{
    public function index()
    {
      
        return view('owner.dashboard');
       
    }
}
