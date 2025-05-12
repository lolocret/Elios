<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
use App\Http\Controllers\StoryController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
