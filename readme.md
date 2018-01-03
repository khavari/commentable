## Commentable

#### Commentable is a comments model for Laravel 5.

### Installation

Require this package in your composer.json and update composer.

```
composer require "Easteregg\Comment"
```

Add `CommentServiceProvider` and `CommentEventProvider` to the `providers` array in
`app/config/app.php`:

```
'providers' => array(
    ...
    'Easteregg\Comment\CommentServiceProvider::class',
    'Easteregg\Comment\CommentEventProvider::class'
);
```

To publish Migrations , Config , views
```
php artisan vendor:publish --provider="Easteregg\Comment\CommentServiceProvider"

Or
php artisan vendor:publish --tag=comment.db
php artisan vendor:publish --tag=comment.config
php artisan vendor:publish --tag=comment.views
```


run the migration:
```
php artisan migrate
```

### Comment relation in Product model
```php
namespace Easteregg\Diagon\Product;

use Easteregg\Comment\Comment;

class Product extends Model
{
   ...
   public function comments()
       {
           return $this->morphMany(Comment::class, 'commentable');
       }
}
```

### Comment relation in Content model
```php
namespace  Easteregg\CMS\ContentManagement\Content\Eloquent;

use Easteregg\Comment\Comment;

class Content extends Model
{
   ...
   public function comments()
       {
           return $this->morphMany(Comment::class, 'commentable');
       }
}
```

### Adding comments for content
```php
$comment              = new Comment();
$comment->parent_id   = $parent_id;
$comment->body        = 'This is a test comment';
$comment->user_id     = auth()->user()->id;

$content = Content::findOrFail($id);
$content->comments()->save($comment);
```

### Retrieving comments of content
```php
$content  = Content::findOrFail($id);
$comments = $content->comments;
```

### Show comments section in frontend
If you have comments section in `product` or `content` or etc  
you must include `comment::frontend.comments` with 
`['commentable_id' => $content->id ,'commentable_type' => 'fullClassName']`

Example:
```php
@include("comment::frontend.comments",['commentable_id' => $content->id ,'commentable_type' => 'Easteregg\CMS\ContentManagement\Content\Eloquent\Content'])

@include("comment::frontend.comments",['commentable_id' => $product->id ,'commentable_type' => 'Easteregg\Diagon\Product\Product'])
```
