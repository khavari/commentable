<?php

namespace Easteregg\Comment\Composer;

class CommentStylesComposer
{
    public function compose($view)
    {
        $view->with('scripts',
            $view->scripts .
            $view->getFactory()->make(
                'safari::general.scripts'
            )
        );

        $view->with('styles',
            $view->styles .
            $view->getFactory()->make('safari::general.styles')
        );
    }
}
