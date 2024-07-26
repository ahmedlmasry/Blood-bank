@extends('layouts.app')
@inject('perms','\App\Models\Permission')
@section('page_title')
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Create Roles</h3>
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
                <form action={{url(route('role.store'))}}  method="post">
                    @csrf
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" type="text"
                           aria-label=".form-control-lg example">
                    <label for="display name">display name</label>
                    <input class="form-control form-control-lg" name="display name" type="text"
                           aria-label=".form-control-lg example">
                    <label for="description">description</label>
                    <input class="form-control form-control-lg" name="description" type="text"
                           aria-label=".form-control-lg example">
                    <label for="name">permission</label>
                    <br>
                    <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label>
                    <div class="row">
                        @foreach($perms->all() as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$permission->id}}"
                                       name="permissions_list[]">
                                {{$permission->name}}
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
    </script>
@endpush
