<?php

namespace Easteregg\Comment\Composer;

class CommentStylesComposer
{
    public function compose($view)
    {
        $view->with('scripts',
            $view->scripts .
            $view->getFactory()->make(
                'comment::frontend.scripts'
            )
        );

        $view->with('styles',
            $view->styles .
            $view->getFactory()->make('comment::frontend.styles')
        );
    }
}
