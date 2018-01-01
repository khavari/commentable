<?php

namespace Easteregg\Comment;


use Illuminate\Support\ServiceProvider;
use Easteregg\Comment\CommentEventProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->loadViewsFrom(__DIR__.'/Views/', 'comment');
        $this->loadTranslationsFrom(__DIR__.'/Locale', 'comment');

        //$this->loadMigrations();
        $this->publishMigrations();

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/comment'),
        ], 'comment.views');
        $this->publishes([
            __DIR__.'/Config/comment.php' => config_path('comment.php'),
        ], 'comment.config');
    }

    public function register()
    {
       $this->app->register(CommentEventProvider::class);
    }


    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    /**
     * Publish migrations
     */
    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'comment.db');
    }



}
