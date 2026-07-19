<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    app()->setLocale(session('locale', 'fr')); // French by default; EN via the switcher

    // simple visit counter: total page views + unique visitors (first visit sets a year-long cookie)
    $file = storage_path('app/visits.json');
    $stats = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
    $stats['total'] = ($stats['total'] ?? 0) + 1;
    $isNew = ! $request->cookie('pcn_v');
    if ($isNew) {
        $stats['unique'] = ($stats['unique'] ?? 0) + 1;
    }
    $today = now()->toDateString();
    $stats['days'][$today] = ($stats['days'][$today] ?? 0) + 1;
    file_put_contents($file, json_encode($stats), LOCK_EX);

    $response = response(view('welcome'));
    if ($isNew) {
        $response->cookie('pcn_v', '1', 60 * 24 * 365); // remember this visitor for 1 year
    }
    return $response;
});

// Private inbox — styled session login (form at /profile, no more browser popup)
Route::get('/profile', function (Request $request) {
    if (! $request->session()->get('pcn_admin')) {
        return view('login');
    }

    $path = storage_path('app/enquiries.jsonl');
    $rows = [];
    if (is_file($path)) {
        foreach (array_reverse(file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) as $l) {
            if ($d = json_decode($l, true)) {
                $rows[] = $d;
            }
        }
    }

    $visits = is_file(storage_path('app/visits.json'))
        ? (json_decode(file_get_contents(storage_path('app/visits.json')), true) ?: [])
        : [];
    $todayVisits = $visits['days'][now()->toDateString()] ?? 0;

    return view('enquiries', ['rows' => $rows, 'visits' => $visits, 'todayVisits' => $todayVisits]);
})->name('enquiries');

// Handle the login form
Route::post('/profile/login', function (Request $request) {
    $user = config('pcn.admin_user');
    $pass = config('pcn.admin_pass');
    if ($pass && $request->input('username') === $user && hash_equals($pass, (string) $request->input('password'))) {
        $request->session()->regenerate();
        $request->session()->put('pcn_admin', true);
        return redirect('/profile');
    }
    return back()->withErrors(['auth' => 'Identifiants incorrects.'])->withInput();
})->name('profile.login');

// Log out
Route::post('/profile/logout', function (Request $request) {
    $request->session()->forget('pcn_admin');
    return redirect('/profile');
})->name('profile.logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// (unused Laravel auth account page — moved off /profile so the private inbox can use it)
Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Standalone pages linked from the homepage cards
Route::get('/horaires', function () {
    app()->setLocale(session('locale', 'fr'));
    return view('schedule');
})->name('schedule');

Route::get('/galerie', function () {
    app()->setLocale(session('locale', 'fr'));
    return view('gallery');
})->name('gallery');

// Language switch (FR default / EN)
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'], true)) {
        session(['locale' => $locale]);
    }
    return redirect('/');
})->name('lang');

require __DIR__.'/auth.php';
