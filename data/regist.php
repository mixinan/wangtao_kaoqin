<?php
	header("Content-Type: text/html; charset=gbk");

   require("init.php");
	 

   $uname=$_REQUEST["uname"];
   $upwd=$_REQUEST["upwd"];
	 
	 $sql="insert into emp(uname,upwd) values('$uname','$upwd')";

	 $result=mysqli_query($conn,$sql);

	 if($result==true){
		echo "ok";
	 }else{
	    echo "fail";
	 }
?>