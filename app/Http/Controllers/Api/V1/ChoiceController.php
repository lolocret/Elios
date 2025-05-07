<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Chapter;
use App\Http\Requests\ChoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChoiceController extends Controller
{
    /**
     * Afficher la liste des choix d'un chapitre.
     *
     * @param int $chapterId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($chapterId): JsonResponse
    {
        $chapter = Chapter::findOrFail($chapterId);
        
        // Si le chapitre appartient à une histoire non publiée, vérifier l'autorisation
        if (!$chapter->story->published) {
            $this->authorize('view', $chapter);
        }
        
        $choices = $chapter->choices()->with('toChapter:id,title')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $choices
        ]);
    }

    /**
     * Créer un nouveau choix pour un chapitre.
     *
     * @param \App\Http\Requests\ChoiceRequest $request
     * @param int $chapterId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ChoiceRequest $request, $chapterId): JsonResponse
    {
        $chapter = Chapter::findOrFail($chapterId);
        
        // Vérifier que l'utilisateur est autorisé à ajouter un choix
        $this->authorize('update', $chapter);
        
        $data = $request->validated();
        $data['from_chapter_id'] = $chapterId;
        
        $choice = Choice::create($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Choix créé avec succès',
            'data' => $choice
        ], 201);
    }

    /**
     * Mettre à jour un choix existant.
     *
     * @param \App\Http\Requests\ChoiceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ChoiceRequest $request, $id): JsonResponse
    {
        $choice = Choice::findOrFail($id);
        
        // Vérifier que l'utilisateur est autorisé à modifier ce choix
        $this->authorize('update', $choice->fromChapter);
        
        $choice->update($request->validated());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Choix mis à jour avec succès',
            'data' => $choice
        ]);
    }

    /**
     * Supprimer un choix.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $choice = Choice::findOrFail($id);
        
        // Vérifier que l'utilisateur est autorisé à supprimer ce choix
        $this->authorize('update', $choice->fromChapter);
        
        $choice->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Choix supprimé avec succès'
        ]);
    }
}
