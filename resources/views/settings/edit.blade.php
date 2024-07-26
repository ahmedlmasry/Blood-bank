@extends('layouts.app')
@section('page_title')
    Edit Settings
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Settings</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action={{url(route('setting.update',$model->id))}}  method="post">
                    @csrf
                    @method('put')
                    <label for="text">text</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->text}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="email">email</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->email}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="about">about</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->about}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="phone">phone</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->phone}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="fb_link">fb_link</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->fb_link}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="tw_link">tw_link</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->tw_link}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="insta_link">insta_link</label>
                    <input class="form-control form-control-lg" name="name" value="{{$model->insta_link}}" type="text"
                           aria-label=".form-control-lg example">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
