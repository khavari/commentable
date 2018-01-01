<?php

namespace Easteregg\Comment;


use Carbon\Carbon;
use Easteregg\Diagon\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;


class CommentController extends Controller
{
    protected $setting;


    public function index()
    {

//        $product = Product::find(1);
//        $c = new Comment();
//        $c->body = str_random(60);
//        $c->user_id = auth()->user()->id;
//        $product->comments()->save($c);

        if (Request('search')) {
            $search = Request('search');
            $comments = Comment::withTrashed()->Where('body', 'like', '%' . $search . '%')->paginate(15);
        }
        elseif (Request('approve')) {
            $approve = Request('approve');
            if ($approve == 'approve') {
                $comments = Comment::withTrashed()->Where('approve', 1)->paginate(15);
            } elseif ($approve == 'unapprove') {
                $comments = Comment::withTrashed()->Where('approve', 0)->paginate(15);
            } elseif ($approve == 'pending') {
                $comments = Comment::withTrashed()->Where('approve', null)->paginate(15);
            }else{
                $comments = Comment::withTrashed()->paginate(15);
            }

        } else {
            $comments = Comment::withTrashed()->paginate(15);
        }

        return view('comment::dashboard.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        if (is_null($comment->read_at)) {
            $comment->read_at = Carbon::now();
            $comment->save();
            session()->flash('success', trans('comment::messages.readMessage'));
        }

        return view('comment::dashboard.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comment::dashboard.edit', compact('comment'));
    }

    public function store(Request $request)
    {
        $parent = Comment::findOrFail($request->parent_id);

        Comment::create([
            'user_id'          => auth()->user()->id,
            'parent_id'        => $request->parent_id,
            'commentable_id'   => $parent->commentable_id,
            'commentable_type' => $parent->commentable_type,
            'body'             => $request->body,
            'approve'          => 1,
            'read_at'          => Carbon::now(),
        ]);

        return redirect('dashboard/comments');
    }

    public function update($id, Request $request)
    {
        Comment::findOrFail($id)->update($request->all());
        session()->flash('success', trans('comment::messages.updatedMessage'));

        return redirect('dashboard/comments');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->children()->delete();
        $comment->delete();
        session()->flash('error', trans('comment::messages.deletedMessage'));

        return back();
    }

    public function restore($id)
    {
        Comment::withTrashed()->where('id', $id)->restore();
        session()->flash('success', trans('comment::messages.restoredMessage'));

        return back();
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approve = 1;
        $comment->save();
        session()->flash('success', trans('comment::messages.approvedMessage'));

        return back();
    }

    public function unapprove($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approve = 0;
        $comment->save();
        session()->flash('success', trans('comment::messages.unapprovedMessage'));

        return back();
    }

}