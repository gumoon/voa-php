@extends('admin.layouts.houtai')

@section('headcss')
<!-- DataTables CSS -->
<link href="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('thirdjs')
<!-- DataTables JavaScript -->
<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
@endsection

@section('customjs')
<script type="text/javascript">
	$(document).ready(function(){
		$("#programTables").DataTable({
			responsive: true,
			"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "全部"]]
		});
	});
</script>
@endsection

@section('content')
<div id="wrapper">

    @include('admin.layouts.navigation')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">全部节目</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
        				节目列表
        			</div>
        			<div class="panel-body">
        				<table  width="100%" class="table table-striped table-bordered table-hover" id="programTables">
        					<thead>
        						<tr>
        							<th>ID</th>
        							<th>节目名</th>
                                    <th>主播</th>
        							<th>操作</th>
        						</tr>
        					</thead>
        					<tbody>
        					@forelse ($programs as $program)
							    <tr>
        							<td>{{ $program->id }}</td>
        							<td>{{ $program->title }}</td>
        							<td>{{ $program->anchor->name }}</td>
        							<td><a href="{{ route('programs.edit', ['program' => $program->id]) }}">编辑</a></td>
        						</tr>
							@empty
							    <tr>
							    	<td>No programs</td>
							    </tr>
							@endforelse
        						
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection