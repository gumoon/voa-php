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
var changeCatUrl = "{{ url('houtai/programs/get_types') }}";

function processJson(data){
	$("#image_url1").attr("src", data.data.url);
	$("#image_url1").attr("alt", data.data.filename);
}

function clickButton()
{
	$("#image_url1").attr("src", "");
	$("#image_url1").attr("alt", "");
}

function processError(){
	alert('上传出错了');
}
//选择文件后，自动上传图片
function changeFile(){
	var options = {
		url: "{{ url('/tools/upload_image') }}",
		type: 'post',
		dataType: 'json',
		success: processJson,
		error: processError
	};
	$("#uploadImage").ajaxSubmit(options);
	return false;
}

//分类改变调用函数
function changeCat(){
	var category_id = $("#category option:selected").val();
	var token = $("input[name='_token']").val();
	var postData = {category_id: category_id, _token: token};
	console.log(postData);
	$.post(changeCatUrl, postData, function(data){
		if(data.err_no){
			alert(data.msg);
		}else{
			console.log(data);
			for(key in data.data){
				var tmp = data.data[key];
				var str = '<option value="'+tmp.category_id+'">'+tmp.name+'</option>';
				$("#program_type").append(str);
			}
		}
	});
}

function submitCreateProgram()
{
	var title = $("#title").val();
	var program_type_id = $("#program_type :selected").val();
	var content = $("#content").val();
	var image_url = $("#image_url1").attr("alt");
	var published_at = $("#published_at").val();
	var anchor_id = $("#anchor_id :selected").val();
	var level = $("#level :selected").val();
	var audio_url = $("#audio_url").val();
	var video_url = $("#video_url").val();


	var postData = {title: title, 
		anchor_id: anchor_id,
		program_type_id: program_type_id,
		level: level,
		image_url: image_url,
		audio_url: audio_url,
		video_url: video_url,
		content: content,
		published_at: published_at
	};
	console.log(postData);

	var options = {
		url: "{{ url('/houtai/programs') }}",
		type: 'post',
		dataType: 'json',
		data: postData,
		success: function(data){
			alert(data.msg);
			window.location.href = "{{ url('/houtai/programs') }}";
		},
		error: function(){
			alert('出错了')
		}
	};
	$("#programCreate").ajaxSubmit(options);
	return false;
}

$(document).ready(function(){
	$("#image_url").on("change", changeFile);
	$("#category").on("change", changeCat);
	$("#programCreate").submit(submitCreateProgram);
});
</script>
@endsection

@section('content')
<div id="wrapper">

    @include('admin.layouts.navigation')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">添加节目</h1>
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
    							<div class="form-group">
    								<label>标题：</label>
    								<input type="text" id="title" name="title" class="form-control" placeholder="">
    							</div>
    						</div>
    						<div class="col-lg-6">
								<div class="form-group">
									<label>发布日期：</label>
									<input type="date" name="published_at" id="published_at" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>节目大类：</label>
									<select class="form-control" id="category">
										<option value="-1">请选择大类</option>
										@foreach ($programCategories as $cat_id => $cat_name)
										<option value="{{ $cat_id }}">{{ $cat_name }}</option>
										@endforeach
									</select>
								</div>
							</div>		

							<div class="col-lg-6">
								<div class="form-group">
									<label>节目小类：</label>
									<select class="form-control" id="program_type" name="program_type">
										<option value="-1">请选择节目小类</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>主播</label>
									<select class="form-control" id="anchor_id" name="anchor_id">
										<option value="-1">请选择主播</option>
										@foreach($anchors AS $anchor)
										<option value="{{$anchor->id}}">{{$anchor->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>适合哪个水平的学习者</label>
									<select class="form-control" id="level" name="level">
										<option value="-1">请选择合适等级</option>
										@foreach($levels AS $level)
										<option value="{{$level['id']}}">{{$level['name']}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>音频链接</label>
									<input type="text" name="audio_url" id="audio_url" class="form-control">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>视频链接</label>
									<input type="text" name="video_url" id="video_url" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<form role="form" id="uploadImage" enctype="multipart/form-data">
        							<div class="form-group">
                                            <label>头图</label>
                                            <input type="file" id="image_url" name="image_url">
                                            {{ csrf_field() }}
                                 	</div>
								</form>

								<img src="" id="image_url1" style="width: 400px; height: 200px">
								<button class="btn btn-default" onclick="clickButton()">删除</button>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
										<label>简介：</label>
										<textarea class="form-control" name="content" id="content" rows="10"></textarea>
								</div>
							</div>
						</div>
									
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6">
								<form role="form" id="programCreate"">
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