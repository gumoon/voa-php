@extends('admin.layouts.houtai')

@section('headcss')
<!-- Morris Charts CSS -->
<link href="{{ asset('admin/vendor/morrisjs/morris.css') }}" rel="stylesheet">
@endsection

@section('bodyjs')
<!-- Morris Charts JavaScript -->
<script src="{{ asset('admin/vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/vendor/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('admin/data/morris-data.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('admin/dist/js/sb-admin-2.js') }}"></script>
@endsection

@section('content')
<div id="wrapper">

    @include('admin.layouts.navigation')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Let's Learn English!</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>
@endsection