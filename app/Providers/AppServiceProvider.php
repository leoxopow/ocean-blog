<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Post::class => \App\Policies\PostPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
