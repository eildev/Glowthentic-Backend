<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'subscriber_id', 'id');
    } //
    public function blog()
    {
        return $this->belongsTo(BlogPost::class, 'blog_id', 'id');
    } //
    public function getReply()
    {
        return $this->hasMany(BlogCommentReply::class, 'comment_id');
    }
}
