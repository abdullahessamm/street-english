@extends('layouts.app', [
    'title' => $blog->title,
])

@section('content')

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container" style="margin-top: 50px;">
        <div class="row clearfix">
            
            <!-- Sidebar Side -->
            <div class="sidebar-side style-two blog-sidebar col-lg-3 col-md-12 col-sm-12">
                <div class="sidebar-inner sticky-top">
                    <aside class="sidebar ">
                        
                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                        
                            <!-- Sidebar Title -->
                            <div class="sidebar-title">
                                <h5>Recent Posts</h5>
                            </div>
                            
                            <div class="widget-content">
                            @if($recentPosts->count() > 0)
                                @foreach ($recentPosts as $recentPost)
                                <article class="post">
                                    <div class="post-inner">
                                        <div class="text"><a href="{{ route('post.show', $recentPost->slug) }}">{{ $recentPost->title }}</a></div>
                                        <div class="post-info">By Admin</div>
                                    </div>
                                </article>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            
            <!-- Content Side -->
            <div class="content-side blog-detail-column col-lg-9 col-md-12 col-sm-12">
                <div class="blog-detail">
                    <div class="inner-box">
                        <h2>{{ $blog->title }}</h2>
                        <ul class="author-info">
                            <li>By Ismail Arafa</li>
                            <li><span class="theme_color">{{ date("d M Y", strtotime($blog->posted_at)) }}</span></li>
                            {{-- <li>15 Commnets</li> --}}
                        </ul>
                        @if($blog->media_type == "image")
                        <div class="image">
                            <img src="{{ asset('public/uploads/blogs/'.$blog->id.'/'.$blog->image) }}" alt="" />
                        </div>
                        @else
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$blog->video}}?rel=0" allowfullscreen></iframe>
                          </div>
                        @endif
                        {!! $blog->content !!}
                        {{-- <div class="social-box">
                            <span>Share this article on </span>
                            <a href="#" class="fa fa-facebook-square"></a>
                            <a href="#" class="fa fa-twitter-square"></a>
                            <a href="#" class="fa fa-linkedin-square"></a>
                            <a href="#" class="fa fa-github"></a>
                        </div> --}}
                    </div>
                    
                    <!-- Post Share Options -->
                    {{-- <div class="styled-pagination text-center">
                        <ul class="clearfix">
                            <li class="prev"><a href="#"><span class="fa fa-angle-left"></span> </a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="active"><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">7</a></li>
                            <li><a href="#">8</a></li>
                            <li class="next"><a href="#"><span class="fa fa-angle-right"></span> </a></li>
                        </ul>
                    </div>
                     --}}
                    {{-- <!-- Comments Area -->
                    <div class="comments-area">
                        <div class="group-title">
                            <h4>Recent Comments</h4>
                        </div>
                        
                        <div class="comment-box">
                            <div class="comment">
                                <div class="author-thumb"><img src="https://via.placeholder.com/90x90" alt=""></div>
                                <div class="comment-info clearfix"><strong>Anna Sthesia</strong><div class="comment-time">June 28, 2019</div></div>
                                <div class="text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</div>
                                <a class="theme-btn reply-btn" href="#"> Reply</a>
                            </div>
                        </div>
                        
                        <div class="comment-box reply-comment">
                            <div class="comment">
                                <div class="author-thumb"><img src="https://via.placeholder.com/90x90" alt=""></div>
                                <div class="comment-info clearfix"><strong>Paul Molive </strong><div class="comment-time">July 01, 2019</div></div>
                                <div class="text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal tion of letters, as opposed to using 'Content here</div>
                                <a class="theme-btn reply-btn" href="#"> Reply</a>
                            </div>
                        </div>
                        
                        <div class="comment-box">
                            <div class="comment">
                                <div class="author-thumb"><img src="https://via.placeholder.com/90x90" alt=""></div>
                                <div class="comment-info clearfix"><strong>Mouna Sthesia </strong><div class="comment-time">June 28, 2019</div></div>
                                <div class="text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</div>
                                <a class="theme-btn reply-btn" href="#"> Reply</a>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Comment Form -->
                    <div class="comment-form">
                        <div class="group-title"><h4>Leave Comment</h4></div>
                        
                        <!--Comment Form-->
                        <form method="post" action="blog.html">
                            <div class="row clearfix">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="username" placeholder="Full Name*" required>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email Address*" required>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea class="" name="message" placeholder="Write your comment..."></textarea>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">Submit Your Comment <i class="fa fa-angle-right"></i></span></button>
                                </div>
                                
                            </div>
                        </form>
                            
                    </div>
                    <!--End Comment Form --> --}}
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection