
<?php  

	require('config/config.php');
	require("config/db.php");
	// 编辑boke
	if(isset($_POST['submit'])){
		$title=mysqli_real_escape_string($conn,$_POST['title']);
		$author=mysqli_real_escape_string($conn,$_POST['author']);
		$body=mysqli_real_escape_string($conn,$_POST['body']);
		// 获取到update_id
		$update_id=mysqli_real_escape_string($conn,$_POST['update_id']);
		if(!empty($title)&&!empty($author)&&!empty($body)){
			$query="update posts set title='$title',auther='$author',body='$body' where id=$update_id";
			mysqli_query($conn,'set names utf8');
			if(mysqli_query($conn,$query)){
				header("location:../index.php");
			}else{
				echo "error:".mysqli_error($conn);
			}
		}
	}

	mysqli_query($conn,'set names utf8');
	// $id=$_GET['id'];
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$query="select  * from posts where id ={$id}";
	$result=mysqli_query($conn,$query);
	$post=mysqli_fetch_assoc($result);//处理一条数据
	// 断开连接
	mysqli_free_result($result);
	mysqli_close($conn);
?>
<?php include('inc/header.php') ?>

<div class="container">
	<h1 class="text-muted">编辑博客</h1><br>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<div class="form-group">
			<label for="">标题</label>
			<input type="text" name="title" class="form-control" value="<?php echo $post['title'] ?>">
		</div>
		<div class="form-group">
			<label for="">作者</label>
			<input type="text" name="author" class="form-control" value="<?php echo $post['auther'] ?>">
		</div>
		<div class="form-group">
			<label for="">内容</label>
			<input type="text" name="body" class="form-control" value="<?php echo $post['body'] ?>">
		</div>
		<input type="hidden" name="update_id" value="<?php echo $post['id'] ?>">
		<input type="submit" value="确认" name="submit" class="btn btn-primary">
	</form>
</div>

<?php include('inc/footer.php') ?>