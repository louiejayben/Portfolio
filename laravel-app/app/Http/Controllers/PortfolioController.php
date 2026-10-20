<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Show the logged-in user's portfolios.
     */
    public function index()
    {
        $portfolios = auth()->user()
            ->portfolios()
            ->latest()
            ->get();

        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Show the create portfolio form.
     */
    public function create()
    {
        return view('portfolios.create');
    }

    /**
     * Validate and save a new portfolio.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],

            'about_me' => ['nullable', 'string', 'max:5000'],
            'education' => ['nullable', 'string', 'max:5000'],
            'skills' => ['nullable', 'string', 'max:5000'],

            'project' => ['nullable', 'string', 'max:5000'],
            'project_link' => ['nullable', 'url', 'max:2048'],

            'company' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'work_description' => ['nullable', 'string', 'max:5000'],

            'website' => ['nullable', 'url', 'max:2048'],
            'facebook' => ['nullable', 'url', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:2048'],
            'github' => ['nullable', 'url', 'max:2048'],

            'template' => [
                'required',
                'in:modern,classic,minimal',
            ],
        ]);

        // Store the profile photo, if one was uploaded.
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')
                ->store('portfolio-photos', 'public');
        }

        // The uploaded file is not a database column.
        unset($validated['photo']);

        // Associate the portfolio with the logged-in user.
        // Never accept user_id directly from the form.
        auth()->user()->portfolios()->create([
            ...$validated,
            'photo_path' => $photoPath,
            'public_token' => Str::random(40),
        ]);

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Your portfolio was saved successfully!');
    }
}