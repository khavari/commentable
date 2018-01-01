<?php

namespace Easteregg\Comment\Listeners;

use Easteregg\Haddock\HaddockContract;

class HandleDashboardMenu
{

    protected $menu;

    public function __construct(HaddockContract $menu)
    {
        $this->menu = $menu;

        $this->menu->title = trans("comment::messages.manageComments");
        $this->menu->icon = "fa fa-comments-o";
        $this->menu->url = url('dashboard/comments');

        $this->menu->addChildren([
            [
                'title' => trans("comment::messages.comments"),
                'icon' => 'fa-table',
                'url' => url('dashboard/comments'),
            ]
        ]);
    }

    public function handle()
    {
        return $this->menu;
    }
}
