@extends('layouts.app')
@inject('roles','App\Models\Role')
@section('page_title')
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Create Users</h3>
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
                <form action={{url(route('user.store'))}}  method="post">
                    @csrf
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" type="text"
                           aria-label=".form-control-lg example">
                    <label for="email">email</label>
                    <input class="form-control form-control-lg" name="email" type="text"
                           aria-label=".form-control-lg example">
                    <label for="password">password</label>
                    <input class="form-control form-control-lg" name="password" type="password"
                           aria-label=".form-control-lg example">
                    <label for="password confirmation">password confirm</label>
                    <input class="form-control form-control-lg" name="password confirmation" type="password"
                           aria-label=".form-control-lg example">

                    <label for="roles_list[]">roles</label>
                    <br>
                    <select name="roles_list[]" class="form-control" multiple>
                        @foreach($roles->all() as $role)
                            <option value="{{$role->name}}">{{$role->name }}</option>
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

