<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\Choice;
use App\Http\Requests\ChapterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  // Ajout de l'importation correcte du trait

class ChapterController extends Controller
{
    use AuthorizesRequests;  // Utilisation du trait pour autorisations

    /**
     * Afficher un chapitre spécifique avec ses choix.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $chapter = Chapter::with('choices.toChapter:id,title,is_ending')
            ->findOrFail($id);
        
        // Si le chapitre appartient à une histoire non publiée, vérifier l'autorisation
        if (!$chapter->story->published) {
            $this->authorize('view', $chapter);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'chapter' => [
                    'id' => $chapter->id,
                    'title' => $chapter->title,
                    'content' => $chapter->content,
                    'is_ending' => $chapter->is_ending,
                    'ending_type' => $chapter->ending_type,
                ],
                'choices' => $chapter->choices->map(function ($choice) {
                    return [
                        'id' => $choice->id,
                        'text' => $choice->text,
                        'code' => $choice->code,
                        'to_chapter_id' => $choice->to_chapter_id,
                        'is_ending' => $choice->toChapter->is_ending ?? false,
                    ];
                })
            ]
        ]);
    }

    /**
     * Afficher la liste des chapitres d'une histoire.
     *
     * @param Request $request
     * @param int $storyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $storyId): JsonResponse
    {
        $story = Story::findOrFail($storyId);
        
        // Si l'histoire n'est pas publiée, vérifier l'autorisation
        if (!$story->published) {
            $this->authorize('viewAny', [Chapter::class, $story]);
        }
        
        $chapters = $story->chapters()->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $chapters
        ]);
    }

    /**
     * Créer un nouveau chapitre pour une histoire.
     *
     * @param \App\Http\Requests\ChapterRequest $request
     * @param int $storyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ChapterRequest $request, $storyId): JsonResponse
    {
        $story = Story::findOrFail($storyId);
        
        // Vérifier que l'utilisateur est autorisé à ajouter un chapitre
        $this->authorize('create', [Chapter::class, $story]);
        
        $data = $request->validated();
        
        // Si ce chapitre est défini comme premier, désactiver les autres premiers chapitres
        if (isset($data['is_first']) && $data['is_first']) {
            $story->chapters()->where('is_first', true)->update(['is_first' => false]);
        }
        
        $chapter = new Chapter($data);
        $chapter->story_id = $storyId;
        $chapter->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Chapitre créé avec succès',
            'data' => $chapter
        ], 201);
    }

    /**
     * Mettre à jour un chapitre existant.
     *
     * @param \App\Http\Requests\ChapterRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ChapterRequest $request, $id): JsonResponse
    {
        $chapter = Chapter::findOrFail($id);
        
        // Vérifier que l'utilisateur est autorisé à modifier ce chapitre
        $this->authorize('update', $chapter);
        
        $data = $request->validated();
        
        // Si ce chapitre est défini comme premier, désactiver les autres premiers chapitres
        if (isset($data['is_first']) && $data['is_first']) {
            $chapter->story->chapters()->where('id', '!=', $id)->where('is_first', true)
                ->update(['is_first' => false]);
        }
        
        $chapter->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Chapitre mis à jour avec succès',
            'data' => $chapter
        ]);
    }

    /**
     * Supprimer un chapitre.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $chapter = Chapter::findOrFail($id);
        
        // Vérifier que l'utilisateur est autorisé à supprimer ce chapitre
        $this->authorize('delete', $chapter);
        
        $chapter->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Chapitre supprimé avec succès'
        ]);
    }
}
