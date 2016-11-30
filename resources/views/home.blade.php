@extends('layouts.app')

@section('headcss')
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/home.css') }}">
@endsection

@section('bodyjs')
    <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
	<script type="text/javascript">
		//$("#myModal").modal("show");
	</script>	
@endsection


@section('content')
<div class="side-nav" role="navigation">
	<ul class="nav-side-nav">
		<li><a href="#onepage" class="tooltip-side-nav"></a></li>
		<li><a href="#twopage" class="tooltip-side-nav"></a></li>
		<li><a href="#threepage" class="tooltip-side-nav"></a></li>
		<li><a href="#fourpage" class="tooltip-side-nav"></a></li>
		<li><a href="#fivepage" class="tooltip-side-nav"></a></li>
	</ul>
</div>

<div class="onepage" id="onepage">
	<div class="onepage-bg" id="onepagebg"></div>
	<div class="container">
		<div class="row">
			<div class="title-text">
				<div class="col-md-12 headfontsize">
					<h1 class="headh1content">
						极客学院<br />
						在这里你可以学习到<br />
						你想要的
					</h1>
					<p>只要你有耐心，相信程序对你而言，小菜一碟，你一定是可以顺利拿下的<br />
					小菜一碟，你一定是可以顺利拿下的</p>
					<p class="btn-app-stroe">
						<a class="btn btn-success btn-lg" href="#">立即注册，开始学习</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="twopage" id="twopage">
	<div class="twopage-text">
		<h1 class="twopage-text-h1">
			选择你的第一节课程进行学习<img src="{{ asset('images/twopage-h.jpg') }}">
		</h1>
	</div>
	<div class="row">
		<div class="twopage-courses col-md-4">
			<a href="#">
				<img src="{{ asset('images/twopage-1.jpg') }}">
				<div class="classicon">
					<h3>认真学习哦</h3>
					<h1><strong>学习这个课程</strong></h1>
				</div>
			</a>
		</div>
		<div class="twopage-courses col-md-4">
			<a href="#">
				<img src="{{ asset('images/twopage-2.jpg') }}">
				<div class="classicon">
					<h3>认真学习哦</h3>
					<h1><strong>学习这个课程</strong></h1>
				</div>
			</a>
		</div>
		<div class="twopage-courses col-md-4">
			<a href="#">
				<img src="{{ asset('images/twopage-3.jpg') }}">
				<div class="classicon">
					<h3>认真学习哦</h3>
					<h1><strong>学习这个课程</strong></h1>
				</div>
			</a>
		</div>
	</div>
	<div class="twopagebtn">
		<a href="#" id="twopage-easy" class="btn btn-success btn-lg">如果你想学习快快开始吧</a>
	</div>
</div>

<div class="threepage" id="threepage">
	<div class="threepage-bg" id="threepagebg">
	<div class="threepagecontent">
		<div class="threepagetext">
			<h1>为什么要学习编程思想</h1>
			<p>只要你有耐心，相信程序对你而言，小菜一碟，你一定是可以顺利拿下的<br />
			小菜一碟，你一定是可以顺利</p>
		</div>
		<a href="#" class="btn btn-success btn-lg threepagebtncontent">
			快速注册，要干活了
		</a>
	</div>
	</div>
</div>

<div class="fourpage" id="fourpage">
	<div class="container" style="width: 70%">
		<div class="coursexingqing-text">
			<h1>要干活，必须要工具到位</h1>
			<p>怎么才能做到最快速的学习呢，你知道吗？</p>
		</div>
		<div id="carousel-example-generic" class="carousel slide" data-interval="5000" style="height: 300px">
			<ol class="carousel-indicators" style="margin-top: 200px">
				<li data-target="#carousel-example-generic" data-slide="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide="1"></li>
				<li data-target="#carousel-example-generic" data-slide="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active" style="width: 500px">
					<img src="{{ asset('images/four-1.jpg') }}">
				</div>
				<div class="item" style="width: 500px">
					<img src="{{ asset('images/four-1.jpg') }}">
				</div>
				<div class="item" style="width: 500px">
					<img src="{{ asset('images/four-1.jpg') }}">
				</div>
			</div>
			<a href="#carousel-example-generic" class="left carousel-control" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a href="#carousel-example-generic" class="right carousel-control" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>

<div class="fivepage" id="fivepage">
	<div class="fivepage-bg" id="fivepagebg">
		<div class="container">
			<div class="footertext">
				<h1>你还在等待吗？赶紧动手吧</h1>
			</div>
			<div class="footerbtncenter">
				<div class="row">
					<a href="#">
						<div class="col-md-4">
							<img src="{{ asset('images/five-1.jpg') }} " class="footerbtn queyeicon">
						</div>
					</a>
					<a href="#">
						<div class="col-md-4">
							<img src="{{ asset('images/five-2.jpg') }} " class="footerbtn queyeicon">
						</div>
					</a>
					<a href="#">
						<div class="col-md-4">
							<img src="{{ asset('images/five-3.jpg') }} " class="footerbtn queyeicon">
						</div>
					</a>
				</div>
			</div>
			<div class="footertextbtn">
				<button type="button" class="btn btn-success btn-lg" style="font-size: 25px;">你还在等待吗？</button>
				<p class="footertextbtn-text">
					只要你有耐心，相信对你不是难事！
				</p>
			</div>
		</div>
	</div>
</div>
@endsection

