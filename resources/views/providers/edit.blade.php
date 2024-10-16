
@extends('backend.layouts.master')

@section('title')
Provider Edit - Admin Panel
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
                <h4 class="page-title pull-left">Provider Edit</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.routes.index') }}">All Providers</a></li>
                    <li><span>Edit Provider</span></li>
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
                    <h4 class="header-title">Edit Provider</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.providers.update', $providerById->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->
                         @method('PUT') <!-- Use PUT or PATCH for updating resources -->
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Domain</label>
                                <select name="domain" id="domain" class="form-control">
                                    <option value="6000008" {{($providerDetailsById['domain_id']==6000008)?'selected':'';}}>Cheaptraintickets.co.uk</option>
                                    <option value="6000010" {{($providerDetailsById['domain_id']==6000010)?'selected':'';}}>Splittraintickets.net</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="status">Publish</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Yes" {{($providerDetailsById['status']=='Yes')?'selected':'';}}>Yes</option>
                                    <option value="No" {{($providerDetailsById['status']=='No')?'selected':'';}}>No</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="rail" {{($providerDetailsById['type']=='rail')?'selected':'';}}>Rail</option>                                    
                                    <option value="bus" {{($providerDetailsById['type']=='bus')?'selected':'';}}>Bus</option>
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ ($providerById['name']!='') ? $providerById['name']:'' }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" value="{{ ($providerById['slug']!='') ? $providerById['slug']:'' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                                {{ $providerDetailsById['logo'] }}
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Banner</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                                {{ $providerDetailsById['banner'] }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Top Banner</label>
                                <input type="file" class="form-control" id="topbanner" name="topbanner">
                                {{ $providerDetailsById['topbanner_image'] }}
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Upload Right Banner</label>
                                <input type="file" class="form-control" id="rightbanner" name="rightbanner">
                                {{ $providerDetailsById['rightbanner_image'] }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Heading</label>
                                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading" value="{{ $providerDetailsById['video_link'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Merchant Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter Merchant Link" value="{{ $providerDetailsById['merchant_link'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Title</label>
                                <input type="text" class="form-control" id="mtitle" name="mtitle" placeholder="Enter Title" value="{{ $providerDetailsById['metatitle'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Description</label>
                                <input type="text" class="form-control" id="mdesc" name="mdesc" placeholder="Enter Description" value="{{ $providerDetailsById['metadescription'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Meta Keyword</label>
                                <input type="text" class="form-control" id="mkeyw" name="mkeyw" placeholder="Enter Keywords" value="{{ $providerDetailsById['metakeyword'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Short Description</label>
                                <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="Short Description" value="{{ $providerDetailsById['merchant_details'] }}">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="email">Description</label>
                                <textarea class="form-control" id="content" name="desc" placeholder="Description">{{ $providerDetailsById['description'] }}</textarea>
                            </div>                            
                        </div>   
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="email">Seating Plan I</label>
                            <textarea class="form-control" id="seating1" name="seating1" placeholder="Description">{{ $providerDetailsById['topbanner_code'] }}</textarea>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="email">Seating Plan II</label>
                            <textarea class="form-control" id="seating2" name="seating2" placeholder="Description">{{ $providerDetailsById['rightbanner_code'] }}</textarea>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="email">Seating Plan III</label>
                            <textarea class="form-control" id="seating3" name="seating3" placeholder="Description">{{ $providerDetailsById['search_right'] }}</textarea>
                        </div>                 
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Provider</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1//tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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