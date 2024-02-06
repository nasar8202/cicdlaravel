@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'List Property type')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Of Property Type</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User List Of Property Type</li>
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
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sub Property Name</th>
                                <th>Property Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listSubPropertyTypes as $listSubPropertyType)
                                <tr>
                                    <td>{{ $listSubPropertyType->title }}</td>
                                    <td>{{ $listSubPropertyType->propertyType->title }}</td>
                                    <td>{{ $listSubPropertyType->status }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.editSubPropertyTypeForm', $listSubPropertyType->id) }}">Edit</a>
                                        |<a
                                            href="{{ route('admin.deleteSubPropertyType', $listSubPropertyType->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3" align="center"> No Property Found!</td>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
