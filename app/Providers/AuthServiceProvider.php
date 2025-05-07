use App\Models\{Story, Chapter, Choice};
use App\Policies\{StoryPolicy, ChapterPolicy, ChoicePolicy};

protected $policies = [
    Story::class => StoryPolicy::class,
    Chapter::class => ChapterPolicy::class,
    Choice::class => ChoicePolicy::class,
];
