namespace App\Policies;

use App\Models\User;
use App\Models\Choice;

class ChoicePolicy
{
    public function update(User $user, Choice $choice): bool
    {
        return $choice->fromChapter->story->user_id === $user->id;
    }

    public function delete(User $user, Choice $choice): bool
    {
        return $choice->fromChapter->story->user_id === $user->id;
    }
}
