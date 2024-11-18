@extends('backend.layouts.master')

@section('title')
    Country Edit - Country Panel
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
                    <h4 class="page-title pull-left">Country Edit</h4>
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
                        <h4 class="header-title">Edit Country - {{ $country->name }}</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.countries.update', $country->id) }}" method="POST" enctype="multipart/form-data"> 
                            @method('PUT')
                            @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Country Short Code</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="code" autocomplete="off" value="{{ ($country['shortcode']!='') ? $country['shortcode']:'' }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes" {{($country['status']=='Yes')?'selected':'';}}>Yes</option>
                                    <option value="No" {{($country['status']=='No')?'selected':'';}}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="city name" autocomplete="off" value="{{ ($country['name']!='') ? $country['name']:'' }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="metatitle">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off" value="{{ ($country['slug']!='') ? $country['slug']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                                {{ ($countryDetail['logo']!='' ) ? $countryDetail['logo']:'' }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Banner</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                                {{ ($countryDetail['banner']!='') ? $countryDetail['banner']:'' }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="header">Page Header</label>
                                <input type="text" class="form-control" id="header" name="header" placeholder="header" autocomplete="off" value="{{ ($countryDetail['header']!='') ? $countryDetail['header']:'' }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="metatitle">Popular Order</label>
                                <input type="number" class="form-control" id="order" name="order" placeholder="order" autocomplete="off" value="{{ ($country['popularorder']!='') ? $country['popularorder']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                    <label for="name">Merchant Link</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link" value="{{ ($countryDetail['merchant_link']!='') ? $countryDetail['merchant_link']:'' }}">
                            </div>
                        </div>    
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metatitle">Meta title</label>
                                <input type="text" class="form-control" id="metatitle" name="metatitle" placeholder="metatitle" autocomplete="off" value="{{ ($countryDetail['metatitle']!='') ? $countryDetail['metatitle']:'' }}">
                            </div>
                        </div>   
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metakeyword">Meta Keyword</label>
                                <input type="text" class="form-control" id="metakeyword" name="metakeyword" placeholder="meta keyword" autocomplete="off" value="{{ ($countryDetail['metakeyword']!='') ? $countryDetail['metakeyword']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">    
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metadescription">Meta Description</label>
                                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="meta description" required autocomplete="off" value="{{ ($countryDetail['metadescription']!='') ? $countryDetail['metadescription']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="shortdescription">Short Description</label>
                                <input type="textarea" class="form-control" id="shortdesc" name="shortdesc" placeholder="short description" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="description">Description</label>
                                <input type="textarea" class="form-control" id="desc" name="desc" placeholder="description" autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Country Data</button>
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
