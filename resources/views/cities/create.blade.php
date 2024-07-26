@extends('layouts.app')
@section('page_title')
    Create Cities
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Cities</h3>
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
                <form action={{url(route('city.store'))}}  method="post">
                    @csrf
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" type="text"
                           aria-label=".form-control-lg example">
                    <select name="governorate_id" id="governorate_id" class="form-control" required>
                        <option value="" selected disabled> --Governorate--</option>
                        @foreach ($governorates as $governorate)
                            <option value="{{$governorate->id }}">{{$governorate->name }}</option>
                        @endforeach
                    </select>
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
