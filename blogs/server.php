<?php 
	session_start();
	$errors=[];
	$db=mysqli_connect("localhost","root","123456","registration");
	// 用户注册
	if(isset($_POST['reg_user'])){
		$username=mysqli_real_escape_string($db,$_POST['username']);
		$email=mysqli_real_escape_string($db,$_POST['email']);
		$password1=mysqli_real_escape_string($db,$_POST['password1']);
		$password2=mysqli_real_escape_string($db,$_POST['password2']);
		if(empty($username)){
			array_push($errors,'username不能为空');
		}
		if(empty($email)){
			array_push($errors,'email不能为空');
		}
		if(empty($password1)){
			array_push($errors,'pasword1不能为空');
		}
		if($password1!=$password2){
			array_push($errors,'两次密码不一样');
		}
		if(count($errors)==0){
			$password=md5($password1);
			$query="insert into users (username,email,password) values ('$username','$email','$password')";
			mysqli_query($db,"set names utf8");
			if(mysqli_query($db,$query)){
				
				header("location:login.php");
			}
		}
	}

	//用户登录
	if(isset($_POST['login_user'])){
		$username=mysqli_real_escape_string($db,$_POST['username']);
		$password=mysqli_real_escape_string($db,$_POST['password1']);
		if(empty($username)){
			array_push($errors, "username 不能为空");
		}
		if(empty($password)){
			array_push($errors, "password 不能为空");
		}
		if(count($errors)==0){
			$password=md5($password);
			$query="select * from users where username='$username' and password='$password'";
			mysqli_query($db,'set names utf8');
			$result=mysqli_query($db,$query);

			// 判断有没有获取到
			if(mysqli_num_rows($result)==1){
				$_SESSION['success']="success";
				$_SESSION['username']=$username;//登录后显示用户名

				header("location:index.php");
			}else{
				echo mysqli_error($db);
			}
		}
	}

?>






