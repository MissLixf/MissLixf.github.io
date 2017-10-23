<?php 
	require('config/config.php');
	require("config/db.php");
	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_POST['submit'])){
		// 获取数据
		$title=mysqli_real_escape_string($conn,$_POST['title']);
		$author=$_SESSION['username'];
		$body=mysqli_real_escape_string($conn,$_POST['body']);
		if(!empty($title)&&!empty($author)&&!empty($body)){
			$query="insert into posts(title,auther,body) values('$title','$author','$body')";
			mysqli_query($conn,'set names utf8');
			if(mysqli_query($conn,$query)){
				header("location:../index.php");
			}else{
				echo "error:".mysqli_error($conn);
			}
		}
	}
 ?>


<?php include('inc/header.php') ?>

<div class="container">
	<h1 class="text-muted">添加博客</h1><br>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<div class="form-group">
			<label for="">标题</label>
			<input type="text" name="title" class="form-control">
		</div>
		<div class="form-group">
			<label for="">内容</label>
			<input type="text" name="body" class="form-control">
		</div>
		<input type="submit" value="添加" name="submit" class="btn btn-primary">
	</form>
</div>

<?php include('inc/footer.php') ?>