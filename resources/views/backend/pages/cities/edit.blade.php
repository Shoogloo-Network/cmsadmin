@extends('backend.layouts.master')

@section('title')
    City Edit - City Panel
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
                    <h4 class="page-title pull-left">City Edit</h4>
                    {{-- <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                        <li><span>Edit Admin - {{ $admin->name }}</span></li>
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
                        <h4 class="header-title">Edit City - {{ $city->name }}</h4>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Domain</label>
                                <select name="domain" id="domain" class="form-control">
                                <option value="">Select Domain</option>
                                    <option value="6000008" {{($cityDetail->domain_id==6000008)?'selected':'';}}>Cheaptraintickets.co.uk</option>
                                    <option value="6000010" {{($cityDetail->domain_id==6000010)?'selected':'';}}>Splittraintickets.net</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes" {{($cityDetail->status=='Yes')?'selected':'';}}>Yes</option>
                                    <option value="No"  {{($cityDetail->status=='No')?'selected':'';}}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="city name" autocomplete="off" value="{{$city->name}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" value="{{$city->slug}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="header">Page Header</label>
                                <input type="text" class="form-control" id="header" name="header" placeholder="header" autocomplete="off" value="{{$cityDetail->header}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="marchant_link">Merchant Link</label>
                                <input type="text" class="form-control" id="merchant_link" name="merchant_link" placeholder="merchant link" autocomplete="off" value="{{$cityDetail->merchant_link}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="banner">Big banner</label>
                                <input type="text" class="form-control" id="banner" name="banner" placeholder="banner" autocomplete="off" value="{{$cityDetail->banner}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="smallbanner">Small Banner</label>
                                <input type="text" class="form-control" id="smallbanner" name="smallbanner" placeholder="Small Banner" autocomplete="off" value="{{$cityDetail->smallbanner}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metatitle">Meta title</label>
                                <input type="text" class="form-control" id="metatitle" name="metatitle" placeholder="metatitle" autocomplete="off" value="{{$cityDetail->metatitle}}">
                            </div>  
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metakeyword">Meta Keyword</label>
                                <input type="text" class="form-control" id="metakeyword" name="metakeyword" placeholder="meta keyword" autocomplete="off" value="{{$cityDetail->metakeyword}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metadescription">Meta Description</label>
                                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="meta description" required autocomplete="off" value="{{$cityDetail->metadescription}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="shortdescription">Short Description</label>
                                <textarea class="form-control" id="froala-editor" name="shortdesc" placeholder="short description">{{$cityDetail->shortdesc}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="froala-editor" name="description" placeholder="description">{{$cityDetail->description}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save City</button>
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
