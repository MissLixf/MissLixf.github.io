<?php 

	require('config/config.php');
	require("config/db.php");
	//实现删除
	if(isset($_POST['delete'])){
		$delete_id=mysqli_real_escape_string($conn,$_POST['delete_id']);
		$query="delete from posts where id='$delete_id'";
		if(mysqli_query($conn,$query)){
			header("location:../index.php");
		}else{
			echo "error:".mysqli_error($conn);
		}
	}
	//博客详情
	mysqli_query($conn,'set names utf8');
	// $id=$_GET['id'];//若没传会报错,是从浏览器直接拿
	$id=mysqli_real_escape_string($conn,$_GET['id']);//出掉特殊字符,直接在$conn里找获取到的id,从浏览器拿到后去$conn连接的数据库里匹配
	$query="select  * from posts where id ={$id}";
	$result=mysqli_query($conn,$query);
	$post=mysqli_fetch_assoc($result);//处理一条数据
	// 断开连接
	mysqli_free_result($result);
	mysqli_close($conn);
 ?>

<?php include('inc/header.php') ?>
 	<div class="container">
 		<h2>博客详情</h2>
 			<div class="well">
 				<h3><?php echo  $post['title'] ?></h3>
 				<p>
 					<strong>id:</strong>
 					<?php echo $post['id'] ?>
 				</p>
 				<p>
 					<strong>作者:</strong>
 					<?php echo $post['auther']; ?>
 				</p>
 				<p>
 					<strong>时间:</strong>
 					<?php echo $post['create_at']; ?>
 				</p>
 				<p>
 					<?php echo $post['body']; ?>
 				</p>
 				<br>
 				<form class="pull-right" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 					<!-- 当点击submit按钮后.页面会刷新,是在当前页面直接刷新,博客详情里的拿不到 -->
 					<input type="hidden" name="delete_id" value="<?php echo $post['id'] ?>">
 					<input type="submit" name="delete" value="删除" class="btn btn-danger">
 				</form>
 				<a class="btn btn-info" href="<?php echo ROOT_URL; ?>main/editepost.php?id=<?php echo $post['id'] ?>" >编辑</a>
 			</div>
 	</div>
<?php include('inc/footer.php') ?>

