<?php

namespace Easteregg\Comment;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Easteregg\Haddock\Events\DashboardMenu;
use Easteregg\Comment\Listeners\HandleDashboardMenu;


class CommentEventProvider extends ServiceProvider
{
    protected $listen = [
        DashboardMenu::class => [
            HandleDashboardMenu::class,
        ]
    ];
}
