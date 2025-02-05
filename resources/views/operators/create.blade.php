
@extends('backend.layouts.master')

@section('title')
Operator Create - Admin Panel
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
                <h4 class="page-title pull-left">Operator Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.routes.index') }}">All Operators</a></li>
                    <li><span>Create Operator</span></li>
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
                    <h4 class="header-title">Create New Operator</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.operators.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Domain</label>
                                <select name="domain" id="domain" class="form-control">
                                    <option value="6000008">Cheaptraintickets.co.uk</option>
                                    <option value="6000010">Splittraintickets.net</option>
                                </select>
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
                                <label for="type">OTA Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="All">All</option>
                                    <option value="trains">Trains</option>
                                    <option value="hotels">Hotels</option>
                                    <option value="cars">Cars</option>
                                    <option value="ferries">Ferries</option>
                                    <option value="flights">Flights</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Popular Order</label>
                                <input type="number" class="form-control" id="order" name="order" placeholder="Enter Order">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug">
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
                                <label for="name">Upload Top Banner</label>
                                <input type="file" class="form-control" id="topbanner" name="topbanner">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Right Banner</label>
                                <input type="file" class="form-control" id="rightbanner" name="rightbanner">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Heading</label>
                                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Merchant Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Title</label>
                                <input type="text" class="form-control" id="mtitle" name="mtitle" placeholder="Enter Title">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Description</label>
                                <input type="text" class="form-control" id="mdesc" name="mdesc" placeholder="Enter Description">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Keyword</label>
                                <input type="text" class="form-control" id="mkeyw" name="mkeyw" placeholder="Enter Keywords">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Short Description</label>
                                <textarea class="form-control" id="froala-editor" name="sdesc" placeholder="Short Description"></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Description</label>
                                <textarea class="form-control" id="froala-editor" name="desc" placeholder="Description"></textarea>
                            </div>   
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Seating Plan I</label>
                                <textarea class="form-control" id="froala-editor" name="seating1" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Seating Plan II</label>
                                <textarea class="form-control" id="froala-editor" name="seating2" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Seating Plan III</label>
                                <textarea class="form-control" id="froala-editor" name="seating3" placeholder="Description"></textarea>
                            </div>   
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Seating Plan IV</label>
                                <textarea class="form-control" id="froala-editor" name="seating4" placeholder="Description"></textarea>
                            </div>  
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="customHtml">Custom HTML</label>
                                <textarea class="form-control" id="froala-editor" name="customhtml" placeholder="Custom Html"></textarea>
                            </div>  
                        </div>                  
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Operator</button>
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