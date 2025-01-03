
@extends('backend.layouts.master')

@section('title')
Item Update - Admin Panel
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
                <h4 class="page-title pull-left">Item Update</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.items.index') }}">All Items</a></li>
                    <li><span>Update Item</span></li>
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
                    <h4 class="header-title">Update New Item</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.items.update',$itemById->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT or PATCH for updating resources -->
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="1">Product</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="publish">Publish</label>
                                <select name="publish" id="publish" class="form-control">
                                    <option value="0" {{($itemById['publish']==0)?'selected':'';}}>Disable</option>
                                    <option value="1" {{($itemById['publish']==1)?'selected':'';}}>Enable</option>        
                                    <option value="2" {{($itemById['publish']==2)?'selected':'';}}>Delete</option>                             
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="subcat_id">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="1">Subcategory</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="admin_id">Admin</label>
                                <select name="admin_id" id="admin_id" class="form-control">
                                    <option value="1">Admin</option>                          
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{$itemById['title']}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" value="{{$itemById['slug']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="howto">How To</label>
                                <input type="text" class="form-control" id="howto" name="howto" placeholder="Enter howto" value="{{$itemById['howto']}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="gems_origin">Gems Origin</label>
                                <input type="text" class="form-control" id="gems_origin" name="gems_origin" placeholder="Enter Gems Origin" value="{{$itemById['gems_origin']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{$itemById['price']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="usd_price">USD Price</label>
                                <input type="text" class="form-control" id="usd_price" name="usd_price" placeholder="Enter USD Price" value="{{$itemById['usd_price']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="slicer_price">Slicer Price</label>
                                <input type="text" class="form-control" id="slicer_price" name="slicer_price" placeholder="Enter Slicer Price" value="{{$itemById['slicer_price']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="b2b_price">B2B Price</label>
                                <input type="text" class="form-control" id="b2b_price" name="b2b_price" placeholder="Enter B2B Price" value="{{$itemById['b2b_price']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="discount">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter Discount" value="{{$itemById['discount']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="cgst">CGST</label>
                                <input type="text" class="form-control" id="cgst" name="cgst" placeholder="Enter CGST" value="{{$itemById['cgst']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="sgst">SGST</label>
                                <input type="text" class="form-control" id="sgst" name="sgst" placeholder="Enter SGST" value="{{$itemById['sgst']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="top_sale">Top Sale</label>
                                <input type="text" class="form-control" id="top_sale" name="top_sale" placeholder="Enter Top Sale" value="{{$itemById['top_sale']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="view_count">Views</label>
                                <input type="text" class="form-control" id="viewcount" name="view_count" placeholder="Enter Views" value="{{$itemById['view_count']}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="sale_count">Sales</label>
                                <input type="text" class="form-control" id="salecount" name="sale_count" placeholder="Enter Sales" value="{{$itemById['sale_count']}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="shipping">Shipping</label>
                                <input type="text" class="form-control" id="shipping" name="shipping" placeholder="Enter Shipping" value="{{$itemById['shipping']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="is_homepage">On Homepage</label>
                                <input type="text" class="form-control" id="is_homepage" name="is_homepage" placeholder="Enter" value="{{$itemById['is_homepage']}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="video_url">Video Url</label>
                                <input type="text" class="form-control" id="video_url" name="video_url" placeholder="Enter Video Url" value="{{$itemById['video_url']}}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{$itemById['meta_title']}}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="meta_description">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Description" value="{{$itemById['meta_description']}}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="meta_key">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_key" name="meta_key" placeholder="Enter Keywords" value="{{$itemById['meta_key']}}">
                            </div>                                  
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Short Description</label>
                                <textarea class="form-control" id="froala-editor" name="short_description" placeholder="Short Description">{{$itemById['short_description']}}</textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Description</label>
                                <textarea class="form-control" id="froala-editor" name="description" placeholder="Description">{{$itemById['description']}}</textarea>
                            </div>
                        </div>                                           
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Item</button>
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