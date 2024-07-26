@extends('front.master',['body_class'=> 'contact-us'])
@section('content')
@inject('contacts','App\Models\Contact')


<!--contact-us-->
<div class="contact-now">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-1.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                </ol>
            </nav>
        </div>
        <div class="row methods">
            <div class="col-md-6">
                <div class="call">
                    <div class="title">
                        <h4>Contact us</h4>
                    </div>
                    <div class="content">
                        <div class="logo">
                            <img src="{{asset('front/imgs/logo-ltr.png')}}">
                        </div>
                        @foreach($contacts->all() as $contact)
                        <div class="details">
                            <ul>
                                <li><span>Telephone nomber:</span>{{$contact->phone}}</li>
                                <li><span>E-mail:</span>{{$contact->email}} </li>
                            </ul>
                        </div>
                        @endforeach
                        <div class="social">
                            <h4>Contact us</h4>
                            <div class="icons" dir="ltr">
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/001-facebook.svg')}}"></a>
                                </div>
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/002-twitter.svg')}}"></a>
                                </div>
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/003-youtube.svg')}}"></a>
                                </div>
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/004-instagram.svg')}}"></a>
                                </div>
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/005-whatsapp.svg')}}"></a>
                                </div>
                                <div class="out-icon">
                                    <a href="#"><img src="{{asset('front/imgs/006-google-plus.svg')}}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <div class="title">
                        <h4>Connect with us</h4>
                    </div>
                    <div class="fields">
                        <form>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" name="name">
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail" name="email">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Telephone number" name="phone">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Message title" name="title">
                            <textarea placeholder="Text message" class="form-control" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
