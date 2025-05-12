<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
use App\Models\Chapter;
use App\Http\Controllers\Api\V1\StoryController;
use App\Http\Controllers\Api\V1\ChapterController;


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



// Routes API versionnées exposées via le routeur
Route::prefix('api/v1')->group(function () {

    // Récupérer toutes les histoires publiées
    Route::get('/stories', [StoryController::class, 'index']);
    
    // Récupérer la liste des chapitres d'une histoire
    Route::get('/stories/{storyId}/chapters', [ChapterController::class, 'index']);

    // Récupérer un chapitre spécifique
    Route::get('/chapters/{id}', [ChapterController::class, 'show']);

    // Récupérer tous les choix d'un chapitre
    Route::get('/chapters/{chapterId}/choices', [ChoiceController::class, 'index']);

    // Créer une histoire (authentifié)
    Route::middleware('auth:sanctum')->post('/stories', [StoryController::class, 'store']);

    // Créer un chapitre pour une histoire (authentifié)
    Route::middleware('auth:sanctum')->post('/stories/{storyId}/chapters', [ChapterController::class, 'store']);

    // Créer un choix pour un chapitre (authentifié)
    Route::middleware('auth:sanctum')->post('/chapters/{chapterId}/choices', [ChoiceController::class, 'store']);

    // Mettre à jour une histoire (authentifié)
    Route::middleware('auth:sanctum')->put('/stories/{id}', [StoryController::class, 'update']);

    // Mettre à jour un chapitre (authentifié)
    Route::middleware('auth:sanctum')->put('/chapters/{id}', [ChapterController::class, 'update']);

    // Mettre à jour un choix (authentifié)
    Route::middleware('auth:sanctum')->put('/choices/{id}', [ChoiceController::class, 'update']);

    // Supprimer une histoire (authentifié)
    Route::middleware('auth:sanctum')->delete('/stories/{id}', [StoryController::class, 'destroy']);

    // Supprimer un chapitre (authentifié)
    Route::middleware('auth:sanctum')->delete('/chapters/{id}', [ChapterController::class, 'destroy']);

    // Supprimer un choix (authentifié)
    Route::middleware('auth:sanctum')->delete('/choices/{id}', [ChoiceController::class, 'destroy']);
});





require __DIR__.'/auth.php';
