<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
use App\Http\Controllers\StoryController;


Route::get('/story/reflet', function () {
    return Story::with('chapters.choices')->first();  // Exemple avec un modèle d'histoire et des relations
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
