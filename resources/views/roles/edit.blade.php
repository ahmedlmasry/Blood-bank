@extends('layouts.app')
@inject('perms','\App\Models\Permission')
@section('page_title')
    Edit Roles
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
                <form action={{url(route('role.update',$model->id))}}  method="post">
                    @csrf
                    @method('put')
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" value={{$model->name}} type="text"
                           aria-label=".form-control-lg example">
                    <label for="name">premission</label>
                    <br>
                    <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label>
                    <div class="row">
                        @foreach($perms->all() as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$permission->id}}"
                                       name="permissions_list[]"
                                       @if($model->hasPermissionTo($permission->name)) checked @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$permission->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
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
@push('scripts')
    <script>
        $("#selectAll").click(function () {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        // $("input[type=checkbox]").click(function() {
        //     if (!$(this).prop("checked")) {
        //         $("#selectAll").prop("checked", false);
        //     }
        // });
    </script>
@endpush
