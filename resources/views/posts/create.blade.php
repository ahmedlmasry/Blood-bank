@extends('layouts.app')
@inject('categories','\App\Models\Category')
@section('page_title')
    Create Posts
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Posts</h3>
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
                <form action={{url(route('post.store'))}}  method="post">
                    @csrf
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="title" type="text"
                           aria-label=".form-control-lg example">
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" selected disabled> --Categories--</option>
                        @foreach ($categories->all() as $category)
                            <option value="{{$category->id }}">{{$category->name }}</option>
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
