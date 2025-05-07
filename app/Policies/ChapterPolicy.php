namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use App\Models\Chapter;

class ChapterPolicy
{
    public function view(User $user, Chapter $chapter): bool
    {
        return $chapter->story->user_id === $user->id;
    }

    public function viewAny(User $user, Story $story): bool
    {
        return $story->user_id === $user->id;
    }

    public function create(User $user, Story $story): bool
    {
        return $story->user_id === $user->id;
    }

    public function update(User $user, Chapter $chapter): bool
    {
        return $chapter->story->user_id === $user->id;
    }

    public function delete(User $user, Chapter $chapter): bool
    {
        return $chapter->story->user_id === $user->id;
    }
}
