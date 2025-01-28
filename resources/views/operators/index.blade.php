
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
                <h3 class="page-title pull-left">Operators</h3>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Operators</span></li>
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
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Operators List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('operator.create'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.operators.create') }}">Create New</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="2%">Sl</th>
                                    <th width="30%">Operator</th>
                                    <th width="15%">CTT</th>
                                    <th width="15%">STT</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">Ctt Action</th>
                                    <th width="10%">Stt Action</th>
                                    <th width="3%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($operators as $operator)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $operator->name }}</td>
                                    <td>{{($operator->ctt)?'On':'Off'}}</td>
                                    <td>{{($operator->stt)?'On':'Off'}}</td>
                                    <td>{{$operator->status}}</td>
                                    <td> @if($operator->ctt)
                                    <a class="btn btn-success text-white" href="{{ route('admin.operators.edit.byDomainId', ['operator' => $operator->id, 'domainid'=>6000008] )}}">Edit CTT</a>
                                    @endif 
                                    </td>                                    
                                    <td>
                                    @if($operator->stt)
                                    <a class="btn btn-success text-white" href="{{ route('admin.operators.edit.byDomainId', ['operator' => $operator->id, 'domainid'=>6000010] )}}">Edit STT</a>
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
