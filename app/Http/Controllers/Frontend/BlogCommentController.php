<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use App\Models\BlogCommentReply;
use Carbon\Carbon;
class BlogCommentController extends Controller
{
   public function BlogCommentInsert(Request $request){
    $subcriber_id =  $request->subcriber_id;
    $blogs_id = $request->blog_id;

    BlogComment::create([
        'subscriber_id' => $subcriber_id ,
        'blog_id' => $blogs_id,
        'comment' => $request->message,
    ]);
   return redirect()->back()->with('success', 'Comments Successfully Submited');
   }//
   public function BlogCommentDelete($id){
    BlogComment::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Comment Delete Successfully');
   }
   //Comment Reply route

   public function BlogCommentReplys(Request $request){
    $subcriber_id =  $request->subcriber_id;
    $comment_id = $request->comment_id;
    BlogCommentReply::create([
        'subscriber_id' => $subcriber_id,
        'comment_id' => $comment_id,
        'reply' => $request->reply_message,
        'created_at' =>Carbon::now(),
    ]);
   return redirect()->back()->with('success', 'Comment Reply Successfully');
   }//
   public function ReplyDelete($id){
    BlogCommentReply::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Comment Delete Successfully');
   }
}
