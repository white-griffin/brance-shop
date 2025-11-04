<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\CommentFilter;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function list()
    {
        $comments = Comment::filter(new CommentFilter())
            ->whereNull('admin_id')
            ->paginate()
            ->withQueryString();
        return view('admin.comments.list',compact('comments'));
    }

    public function adminReply()
    {
        $this->validateComment();
        DB::beginTransaction();
        try {
            $comment = Comment::findOrFail(request('comment_id'));
            $reply = Comment::updateOrCreate([
                'parent_id' => $comment->id,
                'admin_id' => Auth::guard('admin')->id(),
            ],[
                'admin_id' => Auth::guard('admin')->id(),
                'parent_id' => $comment->id,
                'commentable_id' => $comment->commentable_id,
                'commentable_type' => $comment->commentable_type,
                'text' => request('text'),
                'status' => Constant::PUBLISHED
            ]);

            DB::commit();

            return redirect()->route('admin.comments.list')->with('success','عملیات موفق');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در عملیات ');
        }
    }

    public function updateStatus(Comment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->update([
                'admin_id' => Auth::guard('admin')->id(),
                'status' => \request('status')
            ]);
            DB::commit();
            return redirect()->route('admin.comments.list')->with('success','عملیات موفق');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در عملیات ');
        }
    }

    public function delete(Comment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();
            return redirect()->route('admin.comments.list')->with('success','عملیات موفق');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در عملیات ');
        }
    }


    private function validateComment()
    {
        request()->validate([
            'text' => ['required'],
        ], [
            "text.required" => "وارد کردن این فیلد الزامی است ",
        ]);

    }
}
