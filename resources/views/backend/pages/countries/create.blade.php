
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
                <h4 class="page-title pull-left">Admin Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.countries.index') }}">All Countries</a></li>
                    <li><span>Create Country</span></li>
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
                    @include('backend.layouts.partials.messages')
                    <form action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Country Short Code</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="code" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="country name" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="metatitle">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Banner</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="header">Page Header</label>
                                <input type="text" class="form-control" id="header" name="header" placeholder="header" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="metatitle">Popular Order</label>
                                <input type="number" class="form-control" id="order" name="order" placeholder="order" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                    <label for="name">Merchant Link</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metatitle">Meta title</label>
                                <input type="text" class="form-control" id="metatitle" name="metatitle" placeholder="metatitle" autocomplete="off">
                            </div>
                        </div>   
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metakeyword">Meta Keyword</label>
                                <input type="text" class="form-control" id="metakeyword" name="metakeyword" placeholder="meta keyword" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">    
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="metadescription">Meta Description</label>
                                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="meta description" required autocomplete="off">
                            </div>
                        </div>                        
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="shortdescription">Short Description</label>
                                <textarea class="form-control" id="froala-editor" name="shortdesc" placeholder="short description"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="froala-editor" name="desc" placeholder="description"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Country</button>
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
