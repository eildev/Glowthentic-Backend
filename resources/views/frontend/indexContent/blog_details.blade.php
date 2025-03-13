@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span class="tp-breadcrumb__active"><a
                                    href="{{ route('all.blog.post') }}">{{ $singleBlog['category']['cat_name'] }}
                                </a></span>
                            <span class="dvdr">/</span>
                            <span>{{ $singleBlog->title }}</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- blog-details-area-start -->
    <section class="blog-details-area pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-blog-details__thumb">
                        <img src="{{ asset('uploads/blog/blog_post/' . $singleBlog->image) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 col-lg-12">
                    <div class="tp-blog-details__wrapper">
                        <div class="tp-blog-details__content">
                            <div class="tpblog__entry-wap mb-5">
                                <span class="cat-links"><a
                                        href="#">{{ $singleBlog['category']['cat_name'] }}</a></span>
                                <span class="author-by"><a href="#">Admin</a></span>
                                <span class="post-data"><a
                                        href="#">{{ Carbon\Carbon::parse($singleBlog->created_at)->diffForHumans() }}</a></span>
                            </div>
                            <h2 class="tp-blog-details__title mb-25">{{ $singleBlog->title }}</h2>
                            <p>
                                {!! $singleBlog->desc !!}
                            </p>
                        </div>
                        <div class="postbox__tag-border mb-10">
                            <div class="row align-items-center">
                                <div class="col-xl-7 col-lg-6 col-md-12">
                                    <div class="postbox__tag">
                                        <div class="postbox__tag-list tagcloud">
                                            <span>Tagged: </span>
                                            @php
                                                $tags = explode(',', $singleBlog->tags);
                                            @endphp
                                            @for ($i = 0; $i < count($tags); $i++)
                                                <a href="#">{{ $tags[$i] }}</a>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Blog React and share  --}}
                        <div class="postbox__tag-border mb-45">
                            <div class="row align-items-center">
                                <div class="col-xl-7 col-lg-6 col-md-12">
                                    <div class="postbox__tag">
                                        <div class="postbox__tag-list d-flex">
                                            <span></span>
                                            {{-- //Like --}}
                                            <input type="hidden" class="post_id" value="{{ $singleBlog->id }}">

                                            <span>
                                                @php
                                                    $like = App\Models\BlogReact::where('blog_id', $singleBlog->id)
                                                        ->where('like', 1)
                                                        ->count();
                                                @endphp
                                                <!--<a href="#" class="like react" name="like" value="like">-->
                                                <!--    <i class="fas fa-thumbs-up fs-4 text-primary"></i>-->
                                                <!--    <span class="like_count fw-bold text-dark">{{ $like }} </span>-->
                                                <!--</a>-->
                                            {{-- //Dislike --}}

                                                @php
                                                    $dislike = App\Models\BlogReact::where('blog_id', $singleBlog->id)
                                                        ->where('dislike', 1)
                                                        ->count();
                                                @endphp
                                                <!--<a href="#" class="dislike react" name="dislike" value="dislike">-->
                                                <!--    <i class="far fa-thumbs-down fs-4 text-info"></i>-->
                                                <!--    <span class="dislike_count">{{ $dislike }}</span>-->

                                                <!--</a>-->

                                            <!--{{-- //heart --}}-->
                                            <!--{{-- <span>-->
                                            <!--    @php-->
                                            <!--        $love = App\Models\BlogReact::where('blog_id', $singleBlog->id)-->
                                            <!--            ->where('love', 1)-->
                                            <!--            ->count();-->
                                            <!--    @endphp-->
                                            <!--    <a href="#" class="love react" name="love"  value="love"> <i-->
                                            <!--            class="fas fa-heart fs-4 text-primary"></i></a><span class="love_count fw-bold text-dark">{{ $love }}</span></span> --}}-->
                                            <!--{{-- //Sad --}}-->
                                            <!--{{-- <span>-->
                                            <!--    @php-->
                                            <!--        $sad = App\Models\BlogReact::where('blog_id', $singleBlog->id)-->
                                            <!--            ->where('sad', 1)-->
                                            <!--            ->count();-->
                                            <!--    @endphp-->
                                            <!--    <a href="#" class="sad react" name="sad"  value="sad"><i-->
                                            <!--            class="fas fa-sad-tear fs-4 text-primary"></i></a><span class="sad_count fw-bold text-dark">{{ $sad }}</span>-->
                                            <!--    </span> --}}-->

                                            <!--{{-- //anger --}}-->

                                            <!--{{-- <span>-->
                                            <!--    @php-->
                                            <!--        $angry = App\Models\BlogReact::where('blog_id', $singleBlog->id)-->
                                            <!--            ->where('angry', 1)-->
                                            <!--            ->count();-->
                                            <!--    @endphp-->
                                            <!--    <a href="#" class="angry react" name="angry"  value="angry"><i-->
                                            <!--     class="fas fa-angry fs-4 text-primary"></i></a>-->
                                            <!--        <span class="angry_count fw-bold text-dark">{{ $angry }}</span>-->
                                            <!--</span> --}}-->
                                            <!--{{-- //Funny --}}-->
                                            <!--{{-- <span>-->
                                            <!--    @php-->
                                            <!--        $haha = App\Models\BlogReact::where('blog_id', $singleBlog->id)-->
                                            <!--            ->where('haha', 1)-->
                                            <!--            ->count();-->
                                            <!--    @endphp-->
                                            <!--    <a href="#" class="haha react" name="haha"  value="haha"><i-->
                                            <!--            class="fas fa-laugh fs-4 text-primary "></i></a><span class="haha_count fw-bold text-dark">{{ $haha }}</span></span> --}}-->

                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-xl-5 col-lg-6 col-md-12">-->
                                <!--    <div class="postbox__social-tag">-->
                                <!--        <span>share:</span>-->
                                <!--        <a class="blog-d-lnkd" href="#"><i class="fab fa-linkedin-in"></i></a>-->
                                <!--        <a class="blog-d-pin" href="#"><i class="fab fa-pinterest-p"></i></a>-->
                                <!--        <a class="blog-d-fb" href="#"><i class="fab fa-facebook-f"></i></a>-->
                                <!--        <a class="blog-d-tweet" href="#"><i class="fab fa-twitter"></i></a>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        {{-- Blog React and share End  --}}
                        <div class="postbox__comment mb-65">
                        @guest
                        <h3 class="postbox__comment-title mb-35">LEAVE A COMMENTs</h3>
                        @else
                        
                        <!--<h3 class="postbox__comment-title mb-35">LEAVE A COMMENTs</h3>-->
                        @endguest
                            <ul>

                                @foreach ($blogComment as $comment)
                                    @if ($comment->status == 0)
                                    @else
                                        <li>
                                            <div class="postbox__comment-box d-flex">
                                                <div class="postbox__comment-info">
                                                    <div class="postbox__comment-avater mr-25">
                                                        <img src="{{ asset('default/user.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="postbox__comment-text">
                                                    <div class="postbox__comment-name">
                                                        <h5 class="d-inline-block">{{ $comment['user']['fullName'] }}
                                                        </h5>

                                                        <small
                                                            class="small">{{ date('d-M-Y', strtotime($comment->created_at)) }}
                                                            at {{ date('h:i A', strtotime($comment->created_at)) }}</small>
                                     @if($comment->subscriber_id == Illuminate\Support\Facades\Auth::id())
                                     <span class="btn btn-sm badge text-danger"><a href="{{route('comment.delete',$comment->id)}}"><i class="far fa-trash-alt"></i></a></span>
                                     @else
                                     @endif
                                                    </div>
                                                    <p>{{ $comment->comment }}
                                                    </p>
                                                    <div class="postbox__comment-reply">
                                                        <button class="btn btn-sm ReplyOpen" id="{{ $comment->id }}">Leave
                                                            Reply</button>
                                                    </div>
                                                    {{-- reply ///// --}}
                                                    @foreach ($comment->getReply as $reply)
                                                        <div>
                                                            <ul>
                                                                <li class="children mb-30">
                                                                    <div class="postbox__comment-box pl-90 d-flex">
                                                                        <div class="postbox__comment-info">
                                                                            <div class="postbox__comment-avater mr-25">
                                                                                <img src="{{ asset('default/user.svg') }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="postbox__comment-text">
                                                                    <div class="postbox__comment-name">
                                                                        <h5 class="d-inline-block">
                                                                            {{ $reply->user->fullName ?? null }}
                                                                        </h5><small
                                                                            class="small">{{ date('d-M-Y', strtotime($reply->created_at)) }}
                                                                            at
                                                                            {{ date('h:i A', strtotime($reply->created_at)) }}</small>
                        @if ($reply->subscriber_id == Illuminate\Support\Facades\Auth::id())
                        <span class="btn btn-sm badge text-danger"><a href="{{ route('comment.reply.delete', $reply->id) }}"><i class="fal fa-trash-alt"></i></a></span>                                                                                 @else
                         @endif
                                                                        </div>
                                                            <p>{{ $reply->reply }}

                                                                </p>

                                                </div>
                                            </div>
                                        </li>
                            </ul>
                        </div>
                        @endforeach
                        <div class="tpreview__form postbox__form ShowReply{{ $comment->id }}" style="display:none;">
                            <h4 class="tpreview__form-title mb-10">Reply A Comments </h4>
                            <form action="{{ url('blog-comment-reply-submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subcriber_id" value="{{ Auth::user()->id ?? 0 }}">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tpreview__input mb-5">
                                            <textarea name="reply_message" required placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @guest
                                            <div class="tpreview__submit mt-25">
                                                <a id="login" class="tp-btn">Leave Reply</a>
                                            </div>
                                        @else
                                            <div class="tpreview__submit mt-25">
                                                <button type="submit" class="tp-btn">Leave Reply</button>
                                            </div>
                                        @endguest
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- reply Comment///// --}}
                    </div>
                </div>
                </li>
                @endif
                @endforeach
                </ul>
            </div>
            <div class="tpreview__form postbox__form">
                @guest
                @else
                <h4 class="tpreview__form-title mb-10">LEAVE A Comments </h4>
                @endguest
                @guest
                    <h4 class="tpreview__form-title mb-10 text-danger" id="login">At first, you need to login
                        to your account | <a class="btn btn-sm bg-light" href="{{ route('login') }}">Login</a> |
                    </h4>
                @else


                    <form action="{{ route('blog.comment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subcriber_id" id="subcriber_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="blog_id" id="blog_id" value="{{ $singleBlog->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tpreview__input mb-5">
                                    <textarea name="message" required placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="tpfooter__widget-newsletter-check postbox__check-box">

                                </div>
                                <div class="tpreview__submit mt-25">
                                    <button type="submit" class="tp-btn">Post Comment</button>
                                </div>
                            </div>
                        </div>

                    </form>
                @endguest
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <!-- blog-details-area-end -->

    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
    <script type="text/javascript">
        $('.ReplyOpen').click(function() {
            var id = $(this).attr('id');
            $('.ShowReply' + id).toggle();
        });
        $(document).ready(function() {
            $('.react').click(function(e) {
                e.preventDefault();
                // alert('ok');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let value = $(this).attr('value');
                let post_id = $('.post_id').val();
                $.ajax({
                    url: "/blog/user-like",
                    type: "POST",
                    data: {
                        value: value,
                        post_id: post_id
                    },
                    success: function(res) {
                        console.log(res.like);
                        $('.like_count').text(res.like);
                        $('.dislike_count').text(res.dislike);
                        // $('.love_count').text(res.love);
                        // $('.sad_count').text(res.sad);
                        // $('.angry_count').text(res.angry);
                        // $('.haha_count').text(res.hh);
                    }
                })
            });
        })
    </script>
@endsection
