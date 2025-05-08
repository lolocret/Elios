<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
use App\Models\Chapter;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $stories = Story::all();
        return view('dashboard', compact('stories'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/story/{id}', function ($id) {
        $story = Story::with('chapters.choices')->findOrFail($id);
        return view('reflet.start', compact('story'));  // Passe les données à la vue Blade
    })->name('story.play');

    Route::get('/chapters/{id}', function ($id) {
        $chapter = Chapter::with('choices')->findOrFail($id);
        return view('reflet.chapter', compact('chapter'));
    })->name('chapter.show');
});

require __DIR__.'/auth.php';
