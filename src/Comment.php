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

    public function superlevel()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeParent($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeActive($query)
    {
        return $query->where('approve', 1);
    }

    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    public function deleteComment()
    {
        $comments = $this->children()->get();
        foreach ($comments as $comment) {
            if ($comment->hasChildren()) {
                $comment->deleteComment();
            }else{
                $comment->delete();
            }
        }
        $this->delete();
    }

    public function restoreComment()
    {
        $comments = $this->children()->withTrashed()->get();
        foreach ($comments as $comment) {
            if ($comment->children()->withTrashed()->count() > 0) {
                $comment->restoreComment();
            }else{
                $comment->restore();
            }
        }
        $this->restore();
    }

}
