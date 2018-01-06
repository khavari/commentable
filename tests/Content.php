<?php

namespace Tests;

use Easteregg\Comment\Commentable;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use Commentable;

    protected $table = 'contents';
    protected $guarded  = ['id'];




}
