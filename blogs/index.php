<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	require('main/config/config.php');
	require("main/config/db.php");
	// 设置编码
	mysqli_query($conn,"set names utf8");
	// 设置sql语句
	$query="select * from posts order by create_at DESC";	
	// var_dump($posts);
	if(isset($_GET['idname'])){
		$auther=$_SESSION['username'];
		$query="select * from posts where auther='$auther' order by create_at DESC";
	}
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0){
		$flag=1;
	}else{
		$flag=0;
	}
	// 获取数据
	$posts=mysqli_fetch_all($result,MYSQLI_ASSOC);
	// 断开连接
	mysqli_free_result($result);
	mysqli_close($conn);
 ?>

<?php include('main/inc/header.php') ?>
 	<div class="container">
 		<h2 class="btn btn-default btn-lg btn-block">博客总览</h2>
 		<br>
 	<?php if($flag==1): ?>
 		<?php foreach ($posts as $post) :?>
 			<div class="well">
 				<h3><?php echo  $post['title'] ?></h3>
 				<span>
 					<strong>作者:</strong>
 					<?php echo $post['auther']; ?>
 				</span>
 				<span class="pull-right small">
 					<strong>时间:</strong>
 					<?php echo $post['create_at']; ?>
 				</span>
 				<br><br>
 				<p>
 					<?php echo $post['body']; ?>
 				</p>
 				<br><br>
 				<a href="main/post.php?id=<?php echo $post['id'] ?>" class="btn btn-info">博客详情</a>
 			</div>
 		<?php endforeach; ?>
 	<?php else: ?>
 		<div class="jumbotron">
		  <h3>Hello,you are a lazy man,please write your blogs! </h3>
		</div>
 	<?php endif ?>
 	</div>
 <?php include('main/inc/footer.php') ?>


















