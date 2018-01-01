<?php

namespace Easteregg\Comment;

use App\User;
use Dimsav\Translatable\Translatable;
use Easteregg\Diagon\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use Translatable;
    public $translatedAttributes = ['body'];

    protected $table = "comments";
    protected $guarded  = ['id'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }


}
