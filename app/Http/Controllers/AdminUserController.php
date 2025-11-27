<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
  protected function ensureAdmin(Request $request): void
  {
    $user = $request->user();

    if (!$user || $user->role !== 'admin') {
      abort(403);
    }
  }

  public function index(Request $request)
  {
    $this->ensureAdmin($request);

    // Load all users ordered by newest, with simple counts
    $users = User::orderBy('created_at', 'desc')->get();

    return view('admin.users.index', [
      'users' => $users,
    ]);
  }

  public function destroy(Request $request, User $user)
  {
    $this->ensureAdmin($request);

    // Prevent admin from deleting themselves by mistake
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
