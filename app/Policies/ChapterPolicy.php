<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Chapter;

class ChapterPolicy
{
    public function view(User $user, Chapter $chapter)
    {
        // Vérifier si l'histoire du chapitre est publiée
        return $chapter->story->published || $user->id === $chapter->story->user_id;
    }

    public function update(User $user, Chapter $chapter)
    {
        // Seul l'auteur peut modifier le chapitre
        return $user->id === $chapter->story->user_id;
    }
}
