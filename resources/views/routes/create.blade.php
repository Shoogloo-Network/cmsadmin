
@extends('backend.layouts.master')

@section('title')
Route Create - Admin Panel
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
                <h4 class="page-title pull-left">Route Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.routes.index') }}">All Routes</a></li>
                    <li><span>Create Route</span></li>
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
                    <h4 class="header-title">Create New Route</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.routes.store') }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="Short Description">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Description</label>
                                <textarea class="form-control" id="content" name="desc" placeholder="Description"></textarea>
                            </div> 
                            <div class="form-group col-md-12 col-sm-12">
                                <input type="hidden" name="ctt" value="0">  
                                <input type="checkbox" name="ctt" value="1">CTT       
                                <input type="hidden" name="stt" value="0">  
                                <input type="checkbox" name="stt" value="1">STT  
                            </div>        
                        </div>                  
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Rute</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/p6zy0hiplrzpwksrt914cy00r2oqu21m1snfxhayqdhrif5m/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });

  $(document).ready(function() {
    $('.select2').select2();
  })
</script>
@endsection