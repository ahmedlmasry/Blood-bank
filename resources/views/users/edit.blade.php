@extends('layouts.app')
@inject('roles','\App\Models\Role')
@section('page_title')
    Edit Users
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
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
                <form action={{url(route('user.update',$model->id))}}  method="post">
                    @csrf
                    @method('put')
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" value={{$model->name}} type="text"
                           aria-label=".form-control-lg example">
                    <label for="email">email</label>
                    <input class="form-control form-control-lg" name="email" value="{{$model->email}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="password">password</label>
                    <input class="form-control form-control-lg" name="password" type="password"
                           aria-label=".form-control-lg example">
                    <label for="password confirmation">password confirm</label>
                    <input class="form-control form-control-lg" name="password confirmation" type="password"
                           aria-label=".form-control-lg example">
                    <label for="roles_list[]">roles</label>
                    <br>
                    <select name="roles_list[]" class="form-select" multiple aria-label="multiple select example">
                        @foreach($roles->all() as $role)

                            <option @if($model->hasAnyRole($role->name)) selected
                                    @endif value="{{$role->id}}">{{$role->name }}</option>
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

