<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use App\Models\Chapter;

class ChapterPolicy
{
    /**
     * Autoriser la vue de tous les chapitres d'une histoire si elle est publiée
     */
    public function viewAny(User $user, Story $story)
    {
        return $story->published || $user->id === $story->user_id; // Autorise la vue si l'histoire est publiée ou si l'utilisateur est l'auteur
    }

    /**
     * Autoriser la vue d'un chapitre spécifique
     */
    public function view(User $user, Chapter $chapter)
    {
        return $chapter->story->published || $user->id === $chapter->story->user_id; // Autoriser la vue si l'histoire est publiée ou si l'utilisateur est l'auteur
    }

    /**
     * Autoriser la mise à jour d'un chapitre si l'utilisateur est l'auteur
     */
    public function update(User $user, Chapter $chapter)
    {
        return $user->id === $chapter->story->user_id; // Autoriser uniquement si l'utilisateur est l'auteur de l'histoire
    }

    /**
     * Autoriser la suppression d'un chapitre si l'utilisateur est l'auteur
     */
    public function delete(User $user, Chapter $chapter)
    {
        return $user->id === $chapter->story->user_id; // Autoriser uniquement si l'utilisateur est l'auteur de l'histoire
    }
}
