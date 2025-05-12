<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Story;

class StoryPolicy
{
    public function view(User $user, Story $story)
    {
        // Exemple de logique pour autoriser l'accès si l'histoire est publiée
        return $story->published || $user->id === $story->user_id;
    }

    public function update(User $user, Story $story)
    {
        // Seul l'auteur peut modifier l'histoire
        return $user->id === $story->user_id;
    }
}
