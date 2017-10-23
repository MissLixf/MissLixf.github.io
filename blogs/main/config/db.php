<?php 
	// 连接数据库
	 $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_TEST);
	 // 判断连接成功,0代表成功
	 if(mysqli_connect_errno()){
	 	echo "error:".mysql_connect_error();
	 }