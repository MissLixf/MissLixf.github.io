<?php 
	if(!isset($_SESSION)){
		session_start();
	}	
 ?>
<nav class="navbar navbar-inverse">
	<div class="container">
		<a class="navbar-brand" href="#">个人博客</a>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo ROOT_URL ?>">Home</a></li>
				<li><a href="<?php echo isset($_SESSION['success'])?ROOT_URL.'main/addpost.php':ROOT_URL.'login.php' ?>">添加博客</a></li>
				<li><a href="<?php echo isset($_SESSION['success'])?$_SERVER['PHP_SELF'].'?idname=mbk':ROOT_URL.'login.php' ?>">我的博客</a></li>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<a href="#">
					<?php echo isset($_SESSION['username'])?$_SESSION['username']:'游客'; ?>
					</a>
				</li>
				
				<li>
					<a href="<?php echo isset($_SESSION['success'])?'./logout':'./login'?>.php">
						<?php echo isset($_SESSION['success'])?'退出':'登录'?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>