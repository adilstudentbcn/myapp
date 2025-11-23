<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        $employer = $user->employer ?? new Employer([
            'name' => '',
            'website' => '',
            'logo' => '',
        ]);

        return view('employer.profile', [
            'user' => $user,
            'employer' => $employer,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'url', 'max:255'], // keep simple: URL
        ]);

        $employer = $user->employer ?? new Employer(['user_id' => $user->id]);

        $employer->fill($data);
        $employer->user_id = $user->id;
        $employer->save();

        return redirect()
            ->route('employer.profile.edit')
            ->with('status', 'Employer profile saved!');
    }
}
