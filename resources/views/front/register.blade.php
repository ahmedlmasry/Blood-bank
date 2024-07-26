@extends('front.master',['body_class'=>'create'])
@section('content')
<!--form-->
<div class="form">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">create new account</li>
                </ol>
            </nav>
        </div>
        <div class="account-form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('client-post-register')}}" method="POST">
                @csrf
                <input required name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
                <input required name="d_o_b" placeholder="Birth date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                @inject('bloodtypes','App\Models\BloodType')
                <select id="blood_types" name="blood_type_id" class="form-control">
                    <option selected>blood types</option>
                    @foreach($bloodtypes->all() as $bloodtype)
                        <option value="{{$bloodtype->id}}">{{$bloodtype->name}}</option>
                    @endforeach
                </select>
                @inject('governorates','App\Models\Governorate')
                <select id="governorates" name="governorates" class="form-control">
                    <option selected>Governorate</option>
                    @foreach($governorates->all() as $governorate)
                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                    @endforeach
                </select>
                @inject('cities','App\Models\City')
                <select id="cities" name="city_id" class="form-control">
                    <option selected>cities</option>
{{--                    @foreach($cities->all() as $city)--}}
{{--                        <option value="{{$city->id}}">{{$city->name}}</option>--}}
{{--                    @endforeach--}}
                </select>
                <input  name="phone" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telephone number">
                <input  name="last_donation_date" placeholder="Last date for donation" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="confirm password">
                <div class="create-btn">
                    <input type="submit" value="Creat">
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $("#governorates").change(function (e){
            // console.log("ad");
            // alert('test');
            e.preventDefault();
            var governorate_id = $("#governorates").val();
            if(governorate_id){
                $.ajax({
                    url: '{{url('api/cities?governorate_id=')}}'+governorate_id,
                    type: 'get',
                    success: function (data){
                        if(data.status == 1){
                            $("#cities").empty();
                          $.each(data.data,function (index,city){
                              $("#cities").append('<option value="">cities</option>')
                              $("#cities").append('<option value="'+city.id+'">'+city.name+'</option>')
                          });
                        }
                    },
                    error: function (jqXhr , textStatus , errorMessage){
                        alert(errorMessage)
                    }
                })
            }else{

            }
        })


    </script>
@endpush
@endsection
