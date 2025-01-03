
@extends('backend.layouts.master')

@section('title')
Deal Create - Admin Panel
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
                <h4 class="page-title pull-left">Deal Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.deals.index') }}">All Deals</a></li>
                    <li><span>Create Deal</span></li>
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
                    <h4 class="header-title">Create New Deal</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.deals.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="name">Page</label>
                                <select name="page" id="page" class="form-control">
                                    <option value="">Select Page</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-row">                            
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter Discount">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="expiry">Expiry</label>
                                <input type="date" class="form-control" id="expiry" name="expiry" placeholder="Enter Expiry">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                            </div>                                
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Merchant Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link">
                            </div>                         
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="froala-editor" name="desc" placeholder="Description"></textarea>
                            </div>                              
                        </div>                  
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Deal</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#domain').on('change', function() {
            //alert('xyz');
            var id = $(this).val(); // Get selected value from the first dropdown
            if (id) {
                $.ajax({
                    url: '/admin/get-options/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#page').empty(); // Clear the second dropdown
                        $('#page').append('<option value="">Select an option</option>');
                        $.each(data, function(key, value) {
                            $('#page').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#page').empty(); // Clear the second dropdown if no value is selected
            }
        });
    });
</script>
@endsection
