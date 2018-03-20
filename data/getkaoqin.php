<?php

   header("Content-Type:application/json");

	$uid = $_REQUEST["uid"];
	$month = $_REQUEST["month"];
	
	 require("init.php"); 

	 if($uid){
		 $sql="select uname,kcreate_time from kaoqin k,emp e where k.uid=e.uid and k.uid='$uid'and kcreate_time like '%2018-0$month%' order by kid desc";
	 }else{
		//查询所有人的本月打卡记录 
		$sql="select uname,kcreate_time from kaoqin k,emp e where k.uid=e.uid and kcreate_time like '%2018-0$month%' order by kid desc";
	 }
	 

   $result=mysqli_query($conn,$sql);

	 $array=mysqli_fetch_all($result,MYSQLI_ASSOC);

	 echo json_encode($array);

?>