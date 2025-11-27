<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        // Use existing employer if present, otherwise an empty one
        $employer = $user->employer ?? new Employer([
            'name' => '',
            'website' => '',
            'logo_path' => '',
        ]);

        return view('employer.profile', [
            'user' => $user,
            'employer' => $employer,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // Validate fields + image file
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Find or create employer linked to this user
        $employer = $user->employer ?? new Employer(['user_id' => $user->id]);

        $employer->name = $data['name'];
        $employer->website = $data['website'] ?? null;
        $employer->user_id = $user->id;

        // If a new logo file was uploaded
        if ($request->hasFile('logo')) {
            // Delete old file if exists
            if ($employer->logo_path) {
                Storage::disk('public')->delete($employer->logo_path);
            }

            // Store new file in storage/app/public/logos
            $path = $request->file('logo')->store('logos', 'public');

            // Save relative path (e.g. "logos/company123.png")
            $employer->logo_path = $path;
        }

        $employer->save();

        return redirect()
            ->route('employer.profile.edit')
            ->with('status', 'Employer profile saved!');
    }
}
