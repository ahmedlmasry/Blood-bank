@extends('layouts.app')
{{--@inject('client','App\Models\Client')--}}
{{--@inject('model','App\Models\Post')--}}
@section('page_title')
    Posts
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
                <a href={{url(route('post.create'))}} class=" btn btn-primary"><i class="fas fa-plus"></i>Create </a>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Category Name</th>
                                <th scope="col" class="text-center">Edit</th>
                                <th scope="col" class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                    <td class="text-center">{{$record->title}}</td>
                                    <td class="text-center">{{$record->category->name}}</td>
                                    <td class="text-center">
                                        <a href={{url(route('post.edit',$record->id))}} class=" btn btn-success btn-xs"><i
                                                class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action={{url(route('post.destroy',$record->id))}}>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                        class="fas fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
