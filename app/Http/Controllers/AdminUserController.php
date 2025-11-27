<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
  public function index(Request $request)
  {
    // Middleware already guarantees admin + auth
    $users = User::orderBy('created_at', 'desc')->get();

    return view('admin.users.index', [
      'users' => $users,
    ]);
  }

  public function destroy(Request $request, User $user)
  {
    // Prevent admin from deleting themselves
    if ($request->user()->id === $user->id) {
      return redirect()
        ->route('admin.users.index')
        ->with('status', 'You cannot delete your own account.');
    }

    $user->delete();

    return redirect()
      ->route('admin.users.index')
      ->with('status', 'User deleted.');
  }
}
