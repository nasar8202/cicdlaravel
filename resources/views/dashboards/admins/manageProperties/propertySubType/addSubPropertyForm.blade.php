@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Add Sub Property type')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Sub Property</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Add Sub Properties</a></li>
                        <li class="breadcrumb-item active">Add Sub Property Type</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.addSubPropertyType') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="PropertyType" class="col-sm-2 col-form-label">Property Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="PropertyTypeId" name="PropertyTypeId">
                                                    <option value="">Selecte Property Type</option>
                                                    @foreach ($listPropertyTypes as $listPropertyType)
                                                        <option value="{{ $listPropertyType->id }}">
                                                            {{ $listPropertyType->title }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 col-form-label">Sub Property Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="title"
                                                    placeholder="Enter Proper Type title here..." value=""
                                                    name="title">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
