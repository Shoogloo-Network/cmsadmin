@extends('backend.layouts.master')

@section('title')
    Cities - City Panel
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
                    <h4 class="page-title pull-left">Cities</h4>
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
                        <h4 class="header-title float-left">Popular City Map List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('citymap.edit'))
                                <a class="btn btn-primary text-white" href="{{ route('admin.citymap.create') }}">Create New
                                    City Map</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th width="10%">Navbar Main</th>
                                        <th width="10%">City Subpage</th>
                                        <th width="10%">Routes ID</th>
                                        <th width="10%">Routes Status</th>
                                        <th width="10%">Provider</th>
                                        <th width="10%">Provider Status</th>
                                        <th width="15%">Action</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($populars as $populr)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $populr->page_id }}</td>
                                            <td>{{ $populr->cityname }}</td>
                                            <td></td>
                                            <td>{{ $populr->route_status }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>

                                                @if (Auth::guard('admin')->user()->can('citymap.edit'))
                                                    <a class="btn btn-success text-white"
                                                        href="{{ route('admin.citymap.edit', [$populr->id, $populr->page_id,$populr->subpage_id]) }}">Edit</a>
                                                @endif

                                                @if (Auth::guard('admin')->user()->can('city.delete'))
                                                    {{-- <a class="btn btn-danger text-white"
                                                        href="{{ route('admin.cities.destroy', $admin->id) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                                        Delete
                                                    </a>
                                                    <form id="delete-form-{{ $admin->id }}"
                                                        action="{{ route('admin.cities.destroy', $admin->id) }}"
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
