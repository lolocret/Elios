<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Http\Requests\StoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StoryController extends Controller
{
    /**
     * Afficher la liste de toutes les histoires publiées.
     *
     * @return \Illuminate\Http\JsonResponse
     */
   

    public function index(): JsonResponse
    {
        $stories = Story::where('published', true)
            ->select('id', 'title', 'description')
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $stories
        ]);
    }

    /**
     * Afficher une histoire spécifique avec son premier chapitre.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $story = Story::where('id', $id)
            ->where('published', true)
            ->firstOrFail();
        
        $firstChapter = $story->firstChapter();
        
        if (!$firstChapter) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cette histoire n\'a pas de premier chapitre.'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'story' => [
                    'id' => $story->id,
                    'title' => $story->title,
                    'description' => $story->description,
                ],
                'first_chapter' => [
    'id' => $firstChapter->id,
    'title' => $firstChapter->title,
    'content' => $firstChapter->content,
    'choices' => $firstChapter->choices->map(function ($choice) {
        return [
            'id' => $choice->id,
            'text' => $choice->text,
            'to_chapter_id' => $choice->to_chapter_id
        ];
    }),
]

            ]
        ]);
    }

    /**
     * Afficher la liste des histoires créées par l'utilisateur authentifié.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myStories(Request $request): JsonResponse
    {
        $user = $request->user();
        $stories = $user->stories()->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $stories
        ]);
    }

    /**
     * Créer une nouvelle histoire.
     *
     * @param \App\Http\Requests\StoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoryRequest $request): JsonResponse
    {
        $story = new Story($request->validated());
        $story->user_id = $request->user()->id;
        $story->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Histoire créée avec succès',
            'data' => $story
        ], 201);
    }

    /**
     * Mettre à jour une histoire existante.
     *
     * @param \App\Http\Requests\StoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoryRequest $request, $id): JsonResponse
{
    $story = Story::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->firstOrFail();

    // 🔐 Ajout de l'autorisation
    $this->authorize('update', $story);

    $story->update($request->validated());

    return response()->json([
        'status' => 'success',
        'message' => 'Histoire mise à jour avec succès',
        'data' => $story
    ]);
}


    /**
     * Supprimer une histoire.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        $story = Story::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();
        
        $story->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Histoire supprimée avec succès'
        ]);
    }

    /**
     * Publier ou dépublier une histoire.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function togglePublish(Request $request, $id): JsonResponse
    {
        $story = Story::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();
        
        $story->published = !$story->published;
        $story->save();
        
        return response()->json([
            'status' => 'success',
            'message' => $story->published ? 'Histoire publiée' : 'Histoire dépubliée',
            'data' => [
                'published' => $story->published
            ]
        ]);
    }
}