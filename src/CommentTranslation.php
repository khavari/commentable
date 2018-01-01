<?php

namespace Easteregg\Comment;

use Illuminate\Database\Eloquent\Model;

class CommentTranslation extends Model
{
    public $timestamps = false;
    protected $table = "comment_translations";
    protected $fillable = ['body'];

}
