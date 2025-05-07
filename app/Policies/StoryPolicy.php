namespace App\Policies;

use App\Models\User;
use App\Models\Story;

class StoryPolicy
{
    public function view(User $user, Story $story): bool
    {
        return $story->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Story $story): bool
    {
        return $story->user_id === $user->id;
    }

    public function delete(User $user, Story $story): bool
    {
        return $story->user_id === $user->id;
    }
}
