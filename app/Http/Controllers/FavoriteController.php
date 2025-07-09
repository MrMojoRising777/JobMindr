<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    private const FAVORITABLE_TYPES = [
        'application' => ['class' => \App\Models\Application::class, 'label' => 'Application'],
        'company' => ['class' => \App\Models\Company::class, 'label' => 'Company'],
    ];

    public function index(): View
    {
        $models = collect(self::FAVORITABLE_TYPES);
        $favoritesQuery = auth()->user()->favorites();

        $filter = request('model');
        if ($filter && isset(self::FAVORITABLE_TYPES[$filter])) {
            $favoritesQuery->where('favoritable_type', self::FAVORITABLE_TYPES[$filter]['class']);
        }

        $favorites = $favoritesQuery->get();

        return view('favorites.index', compact('models', 'favorites'));
    }

    public function store(StoreFavoriteRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = Auth::user();

        if (!array_key_exists($validated['favoritable_type'], self::FAVORITABLE_TYPES)) {
            return redirect()->back()->with(['error' => 'Invalid favoritable type.']);
        }

        $favoritableConfig = self::FAVORITABLE_TYPES[$validated['favoritable_type']];
        $favoritableClass = $favoritableConfig['class'];
        $favoritableId = $validated['favoritable_id'];

        try {
            $favoritableClass::findOrFail($favoritableId);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['favoritable' => 'Favoritable item not found.']);
        }

        $existing = Favorite::where('user_id', $user->id)
            ->where('favoritable_type', $favoritableClass)
            ->where('favoritable_id', $favoritableId)
            ->first();

        if ($existing) {
            $existing->delete();
            return redirect()->back()->with(['message' => 'Favorite removed.']);
        }

        $user->favorites()->create([
            'favoritable_type' => $favoritableClass,
            'favoritable_id' => $favoritableId,
        ]);

        return redirect()->back()->with(['message' => 'Favorite added.']);
    }
}
