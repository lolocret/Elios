<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Choice;

class ChoicePolicy
{
    public function update(User $user, Choice $choice)
    {
        // Logique pour vérifier si l'utilisateur peut modifier un choix
        return $user->id === $choice->chapter->story->user_id;
    }
}
