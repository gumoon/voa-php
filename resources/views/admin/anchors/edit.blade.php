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

$(document).ready(function(){

	$("#image_url").on("change", changeFile);

	$("#anchorCreate").submit(function(){
		var name = $("#name").val();
		var intro = $("#intro").val();
		var profile_image_url = $("#image_url1").attr("alt");
		var gender = $("input:checked").val();
		var token = $("input[name='_token']").val();
		var postData = {name: name, intro: intro, profile_image_url: profile_image_url, gender: gender, _token: token};

		console.log(postData);

		var options = {
			url: "{{ url('/houtai/anchors') }}"+"/"+"{{$anchor->id}}",
			type: 'put',
			dataType: 'json',
			data: postData,
			success: function(data){
				alert(data.msg);
				window.location.href = "{{ url('/houtai/anchors') }}";
			},
			error: function(){
				alert('出错了')
			}
		};
		$("#anchorCreate").ajaxSubmit(options);
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
                <h1 class="page-header">编辑主播</h1>
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
        						<form role="form" id="anchorCreate" ">
        							<div class="form-group" id="namediv">
        								<label>*姓名：</label>
        								<input type="text" id="name" name="name" class="form-control" placeholder="" value="{{$anchor->name}}">

	                                    <span class="help-block">
	                                    </span>
        							</div>
									<div class="form-group" id="introdiv">
										<label>简介：</label>
										<textarea class="form-control" rows="3" id="intro" name="intro" placeholder="">{{$anchor->intro}}</textarea>

										<span class="help-block">
	                                    </span>
									</div>
									<div class="form-group">
	                                    <label>性别</label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="gender" value="2" @if( $anchor->gender == 2)checked @endif>女
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="gender" value="1" @if( $anchor->gender == 1)checked @endif>男
	                                    </label>
	                                </div>
									{{ csrf_field() }}
									<button type="submit" class="btn btn-success">更新</button>
        						</form>
        					</div>

							<div class="col-lg-6">
								<form role="form" id="uploadImage" enctype="multipart/form-data">
        							<div class="form-group">
                                            <label>头像</label>
                                            <input type="file" id="image_url" name="image_url">
                                            {{ csrf_field() }}
                                 	</div>
								</form>

								<img src="{{$anchor->image_url_src}}" alt="{{$anchor->profile_image_url}}" id="image_url1" style="width: 100px; height: 100px">
								<button class="btn btn-default" onclick="clickButton()">删除</button>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection