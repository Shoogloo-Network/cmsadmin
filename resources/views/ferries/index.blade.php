
@extends('backend.layouts.master')

@section('title')
Ferries - Admin Panel
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
                <h4 class="page-title pull-left">Ferries</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Ferries</span></li>
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
                    <h4 class="header-title float-left">Ferries List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('ferry.create'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.ferries.create') }}">Create New</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="20%">ferry</th>
                                    <th width="15%">CTT</th>
                                    <th width="15%">STT</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Action</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ferries as $ferry)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $ferry->name }}</td>
                                    <td>{{($ferry->ctt)?'On':'Off'}}</td>
                                    <td>{{($ferry->stt)?'On':'Off'}}</td>
                                    <td>{{$ferry->status}}</td>
                                    @if($ferry->ctt)
                                    <td><a class="btn btn-success text-white" href="{{ route('admin.ferries.edit.byDomainId', ['ferry' => $ferry->id, 'domainid'=>6000008] )}}">Edit</a></td>
                                    @endif
                                    @if($ferry->stt)
                                    <td><a class="btn btn-success text-white" href="{{ route('admin.ferries.edit.byDomainId', ['ferry' => $ferry->id, 'domainid'=>6000010] )}}">Edit</a></td>
                                    @endif
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