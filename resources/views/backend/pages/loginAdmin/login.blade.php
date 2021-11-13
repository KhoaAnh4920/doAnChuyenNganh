<!DOCTYPE html>
<head>
<title>Đăng nhập Admin</title>
@include('backend.partial.head')
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng nhập</h2>
	<?php
	$message = Session::get('message');
	if($message){
		echo $message;
		Session::put('message', null);
	}
	?>
		<form action="{{URL::to('/admin-dashboard')}}" method="post">
			{{ csrf_field() }} <!--Chống injection-->
			<input type="email" class="ggg" name="adminEmail" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="adminPass" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
		</form>
</div>
</div>
@include('backend.partial.script')
</body>
</html>
