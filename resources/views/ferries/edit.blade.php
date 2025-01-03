
@extends('backend.layouts.master')

@section('title')
Ferry Edit - Admin Panel
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
                <h4 class="page-title pull-left">Ferry Edit</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.routes.index') }}">All Ferries</a></li>
                    <li><span>Edit Ferry</span></li>
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
                    <h4 class="header-title">Edit Ferry</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.ferries.update', $ferryById->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->
                         @method('PUT') <!-- Use PUT or PATCH for updating resources -->
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Domain</label>
                                <select name="domain" id="domain" class="form-control">
                                    <option value="6000008" {{($ferryDetailsById['domain_id']==6000008)?'selected':'';}}>Cheaptraintickets.co.uk</option>
                                    <option value="6000010" {{($ferryDetailsById['domain_id']==6000010)?'selected':'';}}>Splittraintickets.net</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes" {{($ferryDetailsById['status']=='Yes')?'selected':'';}}>Yes</option>
                                    <option value="No" {{($ferryDetailsById['status']=='No')?'selected':'';}}>No</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="name">Heading</label>
                                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading" value="{{ $ferryDetailsById['video_link'] }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Popular Order</label>
                                <input type="number" class="form-control" id="order" name="order" placeholder="Enter Order" value="{{ ($ferryById['popularorder']!='') ? $ferryById['popularorder']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ ($ferryById['name']!='') ? $ferryById['name']:'' }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" value="{{ ($ferryById['slug']!='') ? $ferryById['slug']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                                {{ $ferryDetailsById['logo'] }}
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Banner</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                                {{ $ferryDetailsById['banner'] }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Top Banner</label>
                                <input type="file" class="form-control" id="topbanner" name="topbanner">
                                {{ $ferryDetailsById['herobanner'] }}
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Top Banner Mobile</label>
                                <input type="file" class="form-control" id="topmbanner" name="topmbanner">
                                {{ $ferryDetailsById['mob_herobanner'] }}
                            </div>
                        </div>
                        <div class="form-row">                            
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Merchant Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link" value="{{ $ferryDetailsById['merchant_link'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Title</label>
                                <input type="text" class="form-control" id="mtitle" name="mtitle" placeholder="Enter Title" value="{{ $ferryDetailsById['metatitle'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Description</label>
                                <input type="text" class="form-control" id="mdesc" name="mdesc" placeholder="Enter Description" value="{{ $ferryDetailsById['metadescription'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Keyword</label>
                                <input type="text" class="form-control" id="mkeyw" name="mkeyw" placeholder="Enter Keywords" value="{{ $ferryDetailsById['metakeyword'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Short Description</label>
                                <textarea class="form-control" id="froala-editor" name="sdesc" placeholder="Short Description">{{ $ferryDetailsById['shortdesc'] }}</textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Description</label>
                                <textarea class="form-control" id="froala-editor" name="desc" placeholder="Description">{{ $ferryDetailsById['description'] }}</textarea>
                            </div>                            
                        </div>               
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Ferry</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
@endsection