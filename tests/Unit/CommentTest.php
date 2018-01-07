<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Easteregg\Comment\Comment;
use Illuminate\Support\Facades\Auth;
use Tests\Content;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    /**
     * @test
     */
    function it_should_method_exists()
    {
        $content = Content::create(['title' => 'title1']);
        $body = 'comment message';
        $parent_id = null;
        $comment = $content->submitComment($body, $parent_id, 1);

        $this->assertTrue(method_exists($comment, 'commentable'));
        $this->assertTrue(method_exists($comment, 'user'));
        $this->assertTrue(method_exists($comment, 'children'));
        $this->assertTrue(method_exists($comment, 'deleteComment'));
        $this->assertTrue(method_exists($comment, 'restoreComment'));
    }
    /**
     * @test
     */
    function it_should_create_and_find_contents()
    {
        Content::create(['title' => 'title1']);
        Content::create(['title' => 'title2']);
        Content::create(['title' => 'title3']);
        $count = Content::count();
        $this->assertEquals(3, $count);
        $this->assertEquals('title1', Content::first()->title);
        $this->assertEquals('title2', Content::Where('title', 'like', '%2%')->first()->title);
        $this->assertEquals('title3', Content::orderBy('id', 'desc')->first()->title);
    }

    /**
     * @test
     */
    function it_should_create_comments_in_content_model()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message 1';
        $parent_id = null;
        $content->submitComment($body, $parent_id, 1);

        $body = 'comment message 2';
        $parent_id = null;
        $content->submitComment($body, $parent_id, 1);

        $count = $content->comments->count();
        $this->assertEquals(2, $count);
    }

    /**
     * @test
     */
    function it_should_find_active_parent_comments()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message 1';
        $parent_id = null;
        $comment1 = $content->submitComment($body, $parent_id, 1);

        $body = 'comment message 2';
        $parent_id = null;
        $comment2 = $content->submitComment($body, $parent_id, 1);
        $comment2->approve = 1;
        $comment2->save();

        $count = $content->activeParentComments()->count();
        $this->assertEquals(1, $count);
        $this->assertEquals('comment message 2', $content->activeParentComments()->first()->body);
    }

    /**
     * @test
     */
    function it_should_return_read_comments()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message 1';
        $parent_id = null;
        $comment1 = $content->submitComment($body, $parent_id, 1);

        $body = 'comment message 2';
        $parent_id = null;
        $comment2 = $content->submitComment($body, $parent_id, 1);
        $comment2->read_at = Carbon::now();
        $comment2->approve = 1;
        $comment2->save();

        $count = $content->comments()->where('read_at', null)->count();
        $this->assertEquals(1, $count);
    }

    /**
     * @test
     */
    function it_should_soft_delete_comments()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message 1';
        $parent_id = null;
        $comment1 = $content->submitComment($body, $parent_id, 1);

        $body = 'comment message 2';
        $parent_id = null;
        $comment2 = $content->submitComment($body, $comment1->id, 1);

        $comment1->deleteComment();


        $count = $content->comments()->count();
        $this->assertEquals(0, $count);
    }


    /**
     * @test
     */
    function it_should_restore_comments()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message';
        $parent_id = null;
        $comment = $content->submitComment($body, $parent_id, 1);

        $comment->deleteComment();
        $comment->restoreComment();
        $comment->body = 'restored comment';
        $comment->approve = 1;
        $comment->save();

        $count = $content->comments()->count();
        $this->assertEquals(1, $count);
        $this->assertEquals('restored comment', $content->activeParentComments()->first()->body);
        $this->assertInstanceOf(Comment::class, $comment);
    }

    /**
     *
     * @test
     */
    function it_should_visit_comments_list_page()
    {
        $this->withoutMiddleware();
        $this->get('dashboard/comments')
        ->seeElement('form', [
        'action'  => url('dashboard/comments'),
        'method'  => "get",
    ])->assertResponseStatus(200);
    }

    /**
     *
     * @test
     */
    function it_should_visit_comment_edit_page()
    {
        $content = Content::create(['title' => 'title1']);

        $body = 'comment message 1';
        $parent_id = null;
        $content->submitComment($body, $parent_id, 1);

        $comment = $content->comments()->first();

        $this->assertEquals(1,$content->comments()->first()->id);

        $this->withoutMiddleware();
        $this->get('/dashboard/comments/'.$comment->id.'/edit')->assertResponseStatus(200);
    }


}
