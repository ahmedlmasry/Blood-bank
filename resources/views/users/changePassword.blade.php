@extends('layouts.app')
@section('page_title')
    Change Password
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
                <form action={{url(route('update-password'))}}  method="post">
                    @csrf
                    @method('post')

                    <label for="old_password">old password</label>
                    <input class="form-control form-control-lg" name="old_password" type="password"
                           aria-label=".form-control-lg example">
                    <label for="new_password">new password</label>
                    <input class="form-control form-control-lg" name="new_password" type="password"
                           aria-label=".form-control-lg example">
                    <label for="new_password_confirmation">password confirm</label>
                    <input class="form-control form-control-lg" name="new_password_confirmation" type="password"
                           aria-label=".form-control-lg example">
                    <br>

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

