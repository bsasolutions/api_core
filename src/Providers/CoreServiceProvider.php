<?php

declare(strict_types=1);

namespace Bsa\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interfaces to implementations here;
    }

    public function boot(): void
    {
        // Publish config, load routes if needed;
    }
}
