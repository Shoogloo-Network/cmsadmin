
@extends('backend.layouts.master')

@section('title')
Admins - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Routes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Routes</span></li>
                </ul>
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
                    <h4 class="header-title float-left">Routes List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('route.create'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.routes.create') }}">Create New</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="15%">Route</th>
                                    <th width="15%">CTT</th>
                                    <th width="15%">STT</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Action</th>
                                    <th width="15%">Action</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($routes as $route)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $route->name }}</td>
                                    <td>{{($route->ctt)?'On':'Off'}}</td>
                                    <td>{{($route->stt)?'On':'Off'}}</td>
                                    <td>{{$route->status}}</td>
                                    <td>
                                    @if($route->ctt)
                                        <a class="btn btn-success text-white" href="{{ route('admin.routes.edit.byDomainId', ['route' => $route->id, 'domainid'=>6000008] )}}">Edit CTT</a>
                                    @endif
                                    </td>
                                    <td>
                                    @if($route->stt)
                                        <a class="btn btn-success text-white" href="{{ route('admin.routes.edit.byDomainId', ['route' => $route->id, 'domainid'=>6000010] )}}">Edit STT</a>
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