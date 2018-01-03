## Commentable

#### Commentable is a comments model for Laravel 5.

### 1. Install

Run the following command or require this package in your composer.json and update composer.
```
composer require "Easteregg\Comment"
```

### 2. Register
Add `CommentServiceProvider` and `CommentEventProvider` to the `providers` array in
`app/config/app.php`:

```
'providers' => array(
    ...
    'Easteregg\Comment\CommentServiceProvider::class',
    'Easteregg\Comment\CommentEventProvider::class'
);
```
### 3. Publish
Publish migrations , config , views
```
php artisan vendor:publish --provider="Easteregg\Comment\CommentServiceProvider"

Or
php artisan vendor:publish --tag=comment.db
php artisan vendor:publish --tag=comment.config
php artisan vendor:publish --tag=comment.views
```

### 4. Migrate database
```
php artisan migrate
```
### 4. Configure
```
...
...
```

### Usage

Use commentable in Product model
```php
use Easteregg\Comment\Comment;
class Product extends Model
{
    use Commentable;
    ...
}
```

Adding comments for content
```php
$comment              = new Comment();
$comment->parent_id   = $parent_id;
$comment->body        = 'This is a test comment';
$comment->user_id     = auth()->user()->id;

$content = Content::findOrFail($id);
$content->comments()->save($comment);
```
Or
```php
$body      = $request->body;
$parent_id = $request->parent_id;
$content->submitComment($body, $parent_id);
```




Retrieving comments of content model
```php
$comments = $content->comments()->get();
and
$comments = $content->activeParentComments();
and
$comments = $content->childComments();
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
