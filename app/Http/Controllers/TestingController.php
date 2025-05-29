<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    public function show()
    {
        return Inertia::render('Admin.Index', [
            'status' => 'Success kocak',
        ]);
    }
}
