<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        // Emit built assets as root-relative paths (/build/...) instead of
        // absolute https://host/build/... URLs - cleaner and fully portable
        // across domains. Only affects production build output, not `npm run dev`.
        Vite::createAssetPathsUsing(
            fn (string $path, ?bool $secure = null) => '/'.ltrim($path, '/')
        );
    }
}
