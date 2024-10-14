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
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ $city->name }}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Enter Slug" value="{{ $city->slug }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Banner</label>
                                    <input type="text" class="form-control" id="banner" name="banner"
                                        placeholder="Enter Banner">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Small Banner</label>
                                    <input type="text" class="form-control" id="small_banner"
                                        name="small_banner" placeholder="Enter small banner">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Header</label>
                                    <input type="text" class="form-control" id="header" name="header"
                                        placeholder="Enter Header">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Mearchant Link</label>
                                    <input type="text" class="form-control" id="mearchant_link"
                                        name="mearchant_link" placeholder="Mearchant Link">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Meta Title</label>
                                    <input type="text" class="form-control" id="metatitle" name="metatitle"
                                        placeholder="Enter Metatitle">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Meta Keyword</label>
                                    <input type="text" class="form-control" id="metakeyword"
                                        name="password_confirmation" placeholder="Enter metakeyword">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="password">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description"
                                        placeholder="Enter Meta description">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="password">Short Description</label>
                                    <input type="text" class="form-control" id="short_description" name="short_description"
                                        placeholder="Enter Short description">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="status">Assign Display Status</label>
                                    <select name="status" id="status" class="form-control select2" single>
                                        <option selected="selected">Assign Display Status</option>
                                        <option value="1">1</option>
                                        <option value="0">0</option>
                                    </select>
                                    {{-- <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $city->city($city->name) ? 'selected' : '' }}>{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                </div>
                                {{-- <div class="form-group col-md-6 col-sm-6">
                                    <label for="username">Admin Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username" required value="{{ $city->name }}">
                                </div> --}}
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save City Data</button>
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
