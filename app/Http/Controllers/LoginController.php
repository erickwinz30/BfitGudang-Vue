<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    try {
      return Inertia::render('Auth/Index');
    } catch (\Exception $e) {
      // Handle the exception, log it, or return an error view
      Log::error('Error rendering login page: ' . $e->getMessage());
    }
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required|min:3|max:255',
      'password' => 'required|min:5|max:255',
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->route('home');
    }

    //if authentication fails
    return Inertia::render('Auth/Index');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
}
