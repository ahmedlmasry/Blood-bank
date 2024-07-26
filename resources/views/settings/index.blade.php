@extends('layouts.app')
@section('page_title')
    Settings
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


                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Text</th>
                                <th scope="col">About</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Fb-link</th>
                                <th scope="col">Tw-link</th>
                                <th scope="col">Insta-link</th>
                                <th scope="col">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$record->notifications_settings_text}}</td>
                                    <td>{{$record->about_app}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->fb_link}}</td>
                                    <td>{{$record->tw_link}}</td>
                                    <td>{{$record->insta_link}}</td>
                                    <td class="text-center">
                                        <a href={{url(route('setting.edit',$record->id))}} class=" btn btn-success
                                           btn-xs"><i class="fas fa-edit"></i></a>
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
