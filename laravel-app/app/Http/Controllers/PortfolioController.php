<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Show only the authenticated user's portfolios.
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

            'template' => ['required', 'in:modern,classic,minimal'],
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')
                ->store('portfolio-photos', 'public');
        }

        unset($validated['photo']);

        // Associate the portfolio with the authenticated user.
        auth()->user()->portfolios()->create([
            ...$validated,
            'photo_path' => $photoPath,
            'public_token' => Str::random(40),
        ]);

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Your portfolio was saved successfully!');
    }

    /**
     * Show the edit form for a portfolio owned by this user.
     */
    public function edit(Request $request, int $portfolio)
    {
        $portfolio = $request->user()
            ->portfolios()
            ->findOrFail($portfolio);

        return view('portfolios.edit', compact('portfolio'));
    }

    /**
     * Update a portfolio owned by this user.
     */
    public function update(Request $request, int $portfolio)
    {
        $portfolio = $request->user()
            ->portfolios()
            ->findOrFail($portfolio);

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

            'template' => ['required', 'in:modern,classic,minimal'],
        ]);

        unset($validated['photo']);

        $oldPhotoPath = $portfolio->photo_path;

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')
                ->store('portfolio-photos', 'public');
        }

        $portfolio->update($validated);

        // Remove the previous photo only after the update succeeds.
        if (
            isset($validated['photo_path']) &&
            $oldPhotoPath &&
            $oldPhotoPath !== $validated['photo_path']
        ) {
            Storage::disk('public')->delete($oldPhotoPath);
        }

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Your portfolio was updated successfully!');
    }

    /**
     * Delete a portfolio owned by this user.
     */
    public function destroy(Request $request, int $portfolio)
    {
        $portfolio = $request->user()
            ->portfolios()
            ->findOrFail($portfolio);

        if ($portfolio->photo_path) {
            Storage::disk('public')->delete($portfolio->photo_path);
        }

        $portfolio->delete();

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Your portfolio was deleted successfully!');
    }

    /**
     * Display a portfolio through its public sharing token.
     * Login is not required for this page.
     */
    public function showPublic(string $token)
    {
        $portfolio = Portfolio::where('public_token', $token)
            ->firstOrFail();

        return view('portfolios.public', compact('portfolio'));
    }
}