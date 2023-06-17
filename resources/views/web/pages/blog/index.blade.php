@extends('web.layouts.app', [
    'title' => config('app.links.blogs.page'),
])

@section('content')

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container mt-5">
        <div class="row clearfix">
            
            <!-- Content Side -->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="our-courses">
                    
                    <!-- Options View -->
                    {{-- <div class="options-view">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h3>Featured Posts</h3>
                            </div>
                            <div class="pull-right clearfix">
                                <!-- Type Form -->
                                <div class="type-form">
                                    <form>
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <select class="custom-select-box">
                                                <option>Newest</option>
                                                <option>Old</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="row clearfix">
                    @if($blogs->count() > 0)
                        @foreach($blogs as $blog)
                        <!-- Cource Block Two -->
                        <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ route('post.show', $blog->slug) }}"><img src="{{ asset('public/uploads/blogs/'.$blog->id.'/'.$blog->image) }}" style="width: 270px; height: 150px;" alt="" /></a>
                                </div>
                                <div class="lower-content">
                                    <h5><a href="{{ route('post.show', $blog->slug) }}">{{ $blog->title }}</a></h5>
                                    {{-- <div class="text">And meat blessed void a fruit gathered waters.</div> --}}
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <div class="students">By Ismail Arafa</div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="hours">
                                                {{ date("d/m/Y", strtotime($blog->posted_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="col-12">
                            <!-- Post Share Options -->
                            <div class="styled-pagination">
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
                        </div> --}}
                    @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="jumbotron text-center">
                                    @if(request()->query('category') != null)
                                        <h3>No Blog Found in {{ request()->query('category') }}, Please come back later</h3>
                                    @else
                                        <h3>No Blog Found, Please come back later</h3>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Side -->
            <div class="sidebar-side style-two col-lg-3 col-md-12 col-sm-12">
                <div class="sidebar-inner sticky-top">
                    <aside class="sidebar ">
                        
                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                        
                            <!-- Sidebar Title -->
                            <div class="sidebar-title">
                                <h5>Recent Posts</h5>
                            </div>
                            
                            <div class="widget-content">
                            @if($recentBlogs->count() > 0)
                                @foreach($recentBlogs as $recentBlog)
                                <article class="post">
                                    <div class="post-inner">
                                        <div class="text"><a href="{{ route('post.show', $recentBlog->slug) }}">{{ $recentBlog->title }}</a></div>
                                        <div class="post-info">By Ismail Arafa</div>
                                    </div>
                                </article>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        
                        <!-- Popular Tags -->
                        <div class="sidebar-widget popular-tags">
                        
                            <!-- Sidebar Title -->
                            <div class="sidebar-title">
                                <h5>Category</h5>
                            </div>
                            
                            <div class="widget-content">
                                <a href="{{ route('blogs') }}">All</a>
                                @foreach($categories as $category)
                                <a href="{{ route('blogs', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        
                    </aside>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection