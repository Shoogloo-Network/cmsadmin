@extends('backend.layouts.master')

@section('title')
    Countries - Country Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Countries</h4>
                    {{-- <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All Admins</span></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Countries List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('country.edit'))
                                <a class="btn btn-primary text-white" href="{{ route('admin.countries.create') }}">Create New
                                    Country</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th width="10%">Name</th>
                                        <th width="10%">Slug</th>
                                        <th width="10%">Active</th>
                                        <th width="15%">Action</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $admin)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->slug }}</td>
                                            <td>{{ $admin->status }}</td>
                                            <td>

                                                @if (Auth::guard('admin')->user()->can('country.edit'))
                                                    <a class="btn btn-success text-white"
                                                        href="{{ route('admin.countries.edit.byDomainId', ['country' => $admin->id, 'domainid'=>6000008]) }}">Edit</a>
                                                @endif

                                                @if (Auth::guard('admin')->user()->can('country.delete'))
                                                    {{-- <a class="btn btn-danger text-white"
                                                        href="{{ route('admin.countries.destroy', $admin->id) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                                        Delete
                                                    </a>
                                                    <form id="delete-form-{{ $admin->id }}"
                                                        action="{{ route('admin.countries.destroy', $admin->id) }}"
                                                        method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form> --}}
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection


@section('scripts')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        /*================================
                                datatable active
                                ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
