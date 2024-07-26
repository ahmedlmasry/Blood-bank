@extends('layouts.app')
@section('page_title')
    Clients
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Clients</h3>
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
                <form action="/search" method="post">
                    @csrf
                    @method('post')
                    <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search"
                           aria-label="Search">
                </form>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">City</th>
                                <th scope="col">Blood Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Active</th>
                                <th scope="col">Deactive</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->email}}</td>
                                    <td class="text-center">{{$record->city->name}}</td>
                                    <td class="text-center">{{$record->bloodType->name}}</td>
                                    <td>{{$record->is_active}}</td>
                                    <td><a href="{{ route('active', $record->id) }}" class="btn btn-success">Active</a>
                                    </td>
                                    <td><a href="{{ route('deactive', $record->id) }}"
                                           class="btn btn-danger">DeActive</a></td>
                                    <td>
                                        <a href={{url(route('client.edit',$record->id))}} class=" btn btn-success btn-xs"><i
                                                class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form method="post" action={{url(route('client.destroy',$record->id))}}>
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
