<?php
	 header("Content-Type: text/html; charset=gbk");

   require("init.php");
	 

   $uid=$_REQUEST["uid"];
	 
	 $sql="insert into kaoqin(uid) values('$uid')";

	 $result=mysqli_query($conn,$sql);

	 if($result==true){
		echo "ok";
	 }else{
	    echo "fail";
	 }
?>