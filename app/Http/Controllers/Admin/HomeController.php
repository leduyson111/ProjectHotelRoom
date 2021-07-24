<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
       $rooms =   Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }
}
