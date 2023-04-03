<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function store()
    {
        Authors::create(request()->only(['name','dob']));
    }
}
