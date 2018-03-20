<?php
     #1.数据库连接
	 require("init.php"); 
	 
	 $uname=$_REQUEST["uname"];
	 $upwd=$_REQUEST["upwd"];
	 
	 #2.拼sql语句
	 $sql="select * from emp where uname='$uname' and upwd='$upwd'";
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_row($result);
	 #var_dump($row);
	 #print_r($row);
	 if($row){
		echo "ok";
	 }else{
		echo "fail";
	 }
?>