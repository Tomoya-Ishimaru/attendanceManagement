<?php

namespace App\Http\Controllers\OwnerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    } 


    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')
        ->paginate(3);

        return view('owner.dashboard', 
        compact('users'));
    }

    public function punchChange()
    {
        $users = User::select('id', 'name', 'email', 'created_at')
        ->paginate(3);

        return view('owner.punch-change', 
        compact('users'));
    }
}
