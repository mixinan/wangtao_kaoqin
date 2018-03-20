<?php
	header("Content-Type: text/html; charset=gbk");

   require("init.php");
	 

   $uid=$_REQUEST["uid"];

	 
	 $sql="update emp set is_leader=1 where uid='$uid'";

	 $result=mysqli_query($conn,$sql);

	 if($result==true){
		echo "ok";
	 }else{
	    echo "fail";
	 }
?>