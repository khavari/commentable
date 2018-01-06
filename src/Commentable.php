<?php

namespace Easteregg\Comment;

use Easteregg\Comment\Comment;


trait Commentable
{

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function activeParentComments()
    {
        return $this->comments()->active()->parent()->get();
    }

    public function childComments()
    {
        return $this->comments()->children()->active()->get();
    }


    public function submitComment($body, $parent_id = null, $user_id = null)
    {
        $comment = new Comment();
        $comment->parent_id = $parent_id;
        $comment->body = $body;
        if (! is_null($user_id)) {
            $comment->user_id = $user_id;
        } else {
            $comment->user_id = auth()->user()->id;
        }
        $this->comments()->save($comment);

        return $comment;
    }




}
