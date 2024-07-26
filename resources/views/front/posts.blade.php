@extends('front.master',['body_class'=> 'article-details'])
@section('content')



    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Articles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$model->title}}</li>
                    </ol>
                </nav>
            </div>
                <div class="article-image">
                    <img src="{{asset($model->image)}}">
                </div>
            <div class="article-title col-12">
                <div class="h-text col-6">
                    <h4>{{$model->title}}</h4>
                </div>
                <div class="icon col-6">
                    <button type="button"><i class="far fa-heart"></i></button>
                </div>
            </div>

            <!--text-->
            <div class="text">
                <p>{{$model->content}}</p> <br>
            </div>

            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>Related articles</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach($posts->all() as $post)
                                <div class="card">
                                    <div class="photo">
                                        <img src="{{asset($post->image)}}" class="card-img-top" alt="...">
                                        <a href="{{url('posts/'.$post->id)}}" class="click">more</a>
                                    </div>
                                    <a href="#" class="favourite">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text"> {{$post->content}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
