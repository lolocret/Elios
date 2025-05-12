<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{Story, Chapter, Choice};
use App\Policies\{StoryPolicy, ChapterPolicy, ChoicePolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Le mappage des policies pour les modèles.
     *
     * @var array
     */
    protected $policies = [
        Story::class => StoryPolicy::class,
        Chapter::class => ChapterPolicy::class,
        Choice::class => ChoicePolicy::class,
    ];

    /**
     * Enregistrez les policies dans le service container.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Autres enregistrements, si nécessaire
        // Gate::define('view', [StoryPolicy::class, ChapterPolicy::class, ChoicePolicy::class]);
    }
}
