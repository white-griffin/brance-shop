<?php

namespace App\Providers;

use App\Models\Bookmark;
use App\Models\File;
use App\Models\Like;
use App\Models\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Relation::morphMap([
            'file' => File::class,
            'like' => Like::class,
            'bookmark' => Bookmark::class,
            'view' => View::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
