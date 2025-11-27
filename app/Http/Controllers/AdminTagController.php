<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
  /**
   * Extra safety on top of the 'admin' middleware.
   */
  protected function ensureAdmin(Request $request): void
  {
    $user = $request->user();

    if (!$user || $user->role !== 'admin') {
      abort(403);
    }
  }

  /**
   * List all tags + show form to create a new one.
   */
  public function index(Request $request)
  {
    $this->ensureAdmin($request);

    $tags = Tag::orderBy('name')->get();

    return view('admin.tags.index', [
      'tags' => $tags,
    ]);
  }

  /**
   * Store a new tag.
   */
  public function store(Request $request)
  {
    $this->ensureAdmin($request);

    $data = $request->validate([
      'name' => ['required', 'string', 'max:50', 'unique:tags,name'],
    ]);

    Tag::create([
      'name' => $data['name'],
    ]);

    return redirect()
      ->route('admin.tags.index')
      ->with('status', 'Tag created.');
  }

  /**
   * Delete an existing tag.
   */
  public function destroy(Request $request, Tag $tag)
  {
    $this->ensureAdmin($request);

    // Pivot rows in job_tag will be removed automatically
    // because of cascadeOnDelete() in your migration.
    $tag->delete();

    return redirect()
      ->route('admin.tags.index')
      ->with('status', 'Tag deleted.');
  }
}
