<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
class BlogCommentController extends Controller
{
    public function BlogAllPendingComment(){
      $blogComment = BlogComment::latest()->get();
        return view('backend.blog_comments.pending_comment',compact('blogComment'));
    }//End Method
    public function BlogCommentPendingToApprove($id){
        BlogComment::findOrFail($id)->update([
            'status' => 1,
        ]);
        return redirect()->route('blog.all.approved.comment')->with('success', 'Blog Comment Successfully Approve');
    }//End  MEthod
    public function BlogAllApproveComment(){
        $blogComment = BlogComment::latest()->get();
        return view('backend.blog_comments.approve_comment',compact('blogComment'));
    }//End Method
    public function BlogCommentApproveToPending($id){
        BlogComment::findOrFail($id)->update([
            'status' => 0,
        ]);
        return redirect()->route('blog.all.pending.comment')->with('success', 'Blog Comment Successfully Pending');
    }//End Method

    public function BlogCommentDelete($id){
        BlogComment::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Blog Comment Successfully Deleted');
    }//End Method

  
}


