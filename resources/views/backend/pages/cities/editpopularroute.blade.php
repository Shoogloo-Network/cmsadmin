
@extends('backend.layouts.master')

@section('title')
Admin Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit City Mapping</h4>
                {{-- <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.citymap.index') }}">City Mapping</a></li>
                    <li><span>Create</span></li>
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
                    @include('backend.layouts.partials.messages')
                    <form action="{{ route('admin.citymap.update', $associatedRoutes[0]->id) }}" method="POST" name="popularroutemap" id="popularroutemap" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Domain</label>
                                <select name="domain" id="domain" class="form-control">
                                <option value="">Select Domain</option>
                                    <option value="6000008">Cheaptraintickets.co.uk</option>
                                    <option value="6000010">Splittraintickets.net</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="topnavpage">Top Navbar Name</label>
                                <select name="topnavpageid" id="topnavpageid" class="form-control">
                                    <option value="{{ $associatedRoutes[0]->page_id }}" selected="selected">Cities</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Sub Page Name where route will display</label>
                                <select name="navsubpageid" id="navsubpageid" class="form-control">
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{( $city->id == $associatedRoutes[0]->subpage_id ) ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Popular Train Routes to city page</label><i class="bi bi-arrow-down-square-fill"></i>
                                <select name="trainrouteid[]" id="trainrouteid" class="form-control select2" multiple>
                                    @foreach ($routes as $route)
                                       <option value="{{ $route->id }}"
                                        {{  in_array($route->id, $extingRouteIdAry) ? 'selected' : '' }}>
                                        {{ $route->name }}
                                    </option>
                                   @endforeach
                               </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Display</label>
                                <select name="routestatus" id="routestatus" class="form-control">
                                    <option @readonly(true) value="">--Select Status--</option>
                                    <option value="Yes" selected="selected">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="header">Popular train companies to city page</label>
                                <select name="operatorid[]" id="operatorid" class="form-control select2" multiple>
                                    @foreach ($operators as $operator)
                                       <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                    @endforeach
                               </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Display</label>
                                <select name="operatorstatus" id="operatorstatus" class="form-control">
                                    <option @readonly(true) value="">--Select Status--</option>
                                    <option value="Yes" selected="selected">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="metakeyword">Meta Keyword</label>
                                <input type="text" class="form-control" id="metakeyword" name="metakeyword" placeholder="meta keyword" autocomplete="off">
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                     @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="metadescription">Meta Description</label>
                                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="meta description" required autocomplete="off">
                            </div>
                        </div> --}}

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Mapping</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection
