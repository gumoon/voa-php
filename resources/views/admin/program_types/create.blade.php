@extends('admin.layouts.houtai')

@section('headcss')
<!-- Morris Charts CSS -->
<link href="{{ asset('admin/vendor/morrisjs/morris.css') }}" rel="stylesheet">
@endsection

@section('thirdjs')
<!-- Morris Charts JavaScript -->
<script src="{{ asset('admin/vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/vendor/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('admin/data/morris-data.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/data/jquery.form.js') }}"></script>
@endsection

@section('customjs')
<script type="text/javascript">
	$(document).ready(function(){
		$("#programTypeCreate").submit(function(){
			var name = $("#name").val();
			var desc = $("#desc").val();
			var category_id = $("#category_id").val();
			var is_recommend = $("input:checked").val();
			var token = $("input[name='_token']").val();
			var postData = {name: name, desc: desc, category_id: category_id, is_recommend: is_recommend, _token: token};

			console.log(postData);

			var options = {
				url: "{{ url('/houtai/program_types') }}",
				type: 'post',
				dataType: 'json',
				data: postData,
				success: function(data){
					alert(data.msg);
					window.location.href = "{{ url('/houtai/program_types') }}";
				},
				error: function(){
					alert('出错了')
				}
			};
			$("#programTypeCreate").ajaxSubmit(options);
			return false;
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
                <h1 class="page-header">添加节目分类</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
        				请输入相关信息
        			</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-6">
        						<form role="form" id="programTypeCreate" ">
        							<div class="form-group" id="namediv">
        								<label>*名称：</label>
        								<input type="text" id="name" name="name" class="form-control" placeholder="请输入VOA官网上的节目标准名称，用英文输入">

	                                    <span class="help-block">
	                                    </span>
        							</div>
									<div class="form-group" id="introdiv">
										<label>描述：</label>
										<textarea class="form-control" rows="3" id="desc" name="desc" placeholder="节目的英文描述"></textarea>

										<span class="help-block">
	                                    </span>
									</div>
									<div class="form-group" id="typediv">
										<label>*节目类型：</label>
										<select class="form-control" id="category_id" name="category_id">
											<option value="-1">请选择节目类型</option>
											<option value="1">音频节目</option>
											<option value="2">视频节目</option>
											<option value="3">音视频节目</option>
											<option value="0">其他类型</option>
										</select>

										<span class="help-block">
	                                    </span>
									</div>
									<div class="form-group">
	                                    <label>是否推荐</label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="is_recommend" value="0" checked>否
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="is_recommend" value="1">是
	                                    </label>
	                                </div>
									{{ csrf_field() }}
									<button type="submit" class="btn btn-success">添加</button>
        						</form>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection