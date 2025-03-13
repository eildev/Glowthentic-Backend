@extends('frontend.master')
@section('maincontent')
         <!-- blog-area-start -->
         <section class="blog-area pt-30" style="margin-top:80px">
            <div class="container-fluid">
               <div class="swiper-container blog-active-3">
                  <div class="swiper-wrapper">
                    @foreach ($allBlog as $blog )
                    <div class="swiper-slide">
                        <div class="tpblog__single p-relative">
                           <div class="tpblog__single-img">
                              <img src="{{asset('uploads/blog/blog_post/'.$blog->image)}}" width="392px" height="251px" alt="">
                           </div>
                           <div class="tpblog__single-text text-center">
                              <div class="tpblog__entry-wap">
                                 <span class="cat-links"><a href="#">{{$blog['category']['cat_name']}}</a></span>
                                 <span class="author-by"><a href="#">Admin</a></span>
                                 <span class="post-data"><a href="#">{{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</a></span>
                              </div>
                              <h4 class="tpblog__single-title mb-20">
                                 <a href="{{route('blog.post.details',$blog->id)}}">{{ Illuminate\Support\Str::limit($blog->title, 30) }} </a>
                              </h4>
                              <a href="{{route('blog.post.details',$blog->id)}}">Continue reading</a>
                           </div>
                        </div>
                     </div>
                    @endforeach
                  </div>
               </div>
            </div>
         </section>
         <!-- blog-area-end -->

         <!-- blog-area-start -->
         <section class="blog-area pt-80">
            <div class="container">
               <div class="row">
                  <div class="col-xl-10 col-lg-9 order-2">
                     <div class="tpblog__left-wrapper blog-left-sidebar">
                        <div class="tpblog__left-item ">
                           <div class="row">
                              @foreach ($allBlog as $blog)
                              <div class="col-lg-6 col-md-6">
                                 <div class="tpblog__item tpblog__item-2 mb-20">
                                    <div class="tpblog__thumb fix">
                                       <a href="{{route('blog.post.details',$blog->id)}}"><img src="{{asset('uploads/blog/blog_post/'.$blog->image)}}"  width="392px" height="251px" alt="blog-image"></a>
                                    </div>
                                    <div class="tpblog__wrapper p-3">
                                       <div class="tpblog__entry-wap">
                                          <span class="cat-links"><a href="#">{{$blog['category']['cat_name']}}</a></span>
                                          <span class="author-by"><a href="#">Admin</a></span>
                                          <span class="post-data"><a href="#">{{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</a></span>
                                       </div>
                                       <h4 class="tpblog__title"><a href="{{route('blog.post.details',$blog->id)}}">{{ Illuminate\Support\Str::limit($blog->title, 70) }} </a></h4>

                                       <p>{!! Illuminate\Support\Str::limit($blog->desc, 150) !!}</p>
                                       <div class="tpblog__details">
                                          <a href="{{route('blog.post.details',$blog->id)}}">Continue reading <i class="icon-chevrons-right"></i> </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endforeach

                           </div>
                        </div>
                        <div class="tpbasic__pagination pr-100">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="basic-pagination text-center mb-80">
                                    <nav>
                                       <ul>
                                          <li>
                                             <span class="current">1</span>
                                          </li>
                                          <li>
                                             <a href="#">2</a>
                                          </li>
                                          <li>
                                             <a href="#">3</a>
                                          </li>
                                          <li>
                                             <a href="#">
                                                <i class="icon-chevrons-right"></i>
                                             </a>
                                          </li>
                                       </ul>
                                     </nav>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-2 col-lg-3">
                     <div class="tpblog__right-item blog-left-sidebar pb-50">
                        <!--<div class="sidebar__widget mb-30">-->
                        <!--   <div class="sidebar__widget-content">-->
                        <!--      <div class="sidebar__search">-->
                        <!--         <form action="#">-->
                        <!--            <div class="sidebar__search p-relative">-->
                        <!--               <input type="text" placeholder="Search">-->
                        <!--               <button type="submit"><i class="far fa-search"></i></button>-->
                        <!--            </div>-->
                        <!--         </form>-->
                        <!--      </div>-->
                        <!--   </div>-->
                        <!--</div>-->
                        <div class="sidebar__widget mb-40">
                           <h3 class="sidebar__widget-title mb-15">Blog Categories</h3>
                           <div class="sidebar__widget-content">
                              <ul>
                                @foreach ($blogCat as $blogCategory)
                                @php
                               $countPost = App\Models\blogPost::Where('cat_id',$blogCategory->id)->count();
                                @endphp
                                <li><a href="#">{{$blogCategory->cat_name}}<span>({{ $countPost}})</span></a></li>
                                @endforeach

                              </ul>
                           </div>
                        </div>
                        <div class="sidebar__widget mb-35">
                           <h3 class="sidebar__widget-title mb-15">Recent Posts</h3>
                           <div class="sidebar__widget-content">
                              <div class="sidebar__post rc__post">
                                @foreach ($BlogSide as $blog )


                                 <div class="rc__post mb-20 d-flex align-items-center">
                                    <div class="rc__post-thumb">
                                       <a href="{{route('blog.post.details',$blog->id)}}"><img src="{{asset('uploads/blog/blog_post/'.$blog->image)}}" alt="blog-sidebar"></a>
                                    </div>
                                    <div class="rc__post-content">
                                       <h3 class="rc__post-title">
                                          <a href="{{route('blog.post.details',$blog->id)}}">{{ Illuminate\Support\Str::limit($blog->title, 30) }} </a>
                                       </h3>
                                       <div class="rc__meta">
                                          <span>{{Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</span>
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- blog-area-end -->

        <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
         @endsection
