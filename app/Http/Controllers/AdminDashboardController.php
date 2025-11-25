<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
  public function index(Request $request)
  {
    $user = $request->user();

    // Only admins are allowed here
    if (!$user || $user->role !== 'admin') {
      abort(403);
    }

    return view('admin.dashboard', [
      'user' => $user,
    ]);
  }
}
