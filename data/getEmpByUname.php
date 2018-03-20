<?php
    #1.数据库连接
	require("init.php"); 
	 
	$uname=$_REQUEST["uname"];
	 
	if($uname==null)
		echo json_encode(["ok"=>0]);
	else{
	 
	 #2.拼sql语句
	 $sql="select * from emp where uname='$uname'";
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_row($result);
	 #var_dump($row);
	 #print_r($row);
	 #$res = "工号 $row[1] 打卡时间：$row[2]<br> ";
	 #echo json_encode(array('jsonObj'=>$row));
	 echo json_encode(["ok"=>1,"uid"=>$row[0],"uname"=>$row[1],"upwd"=>$row[2],"u_join_time"=>$row[3],"is_leader"=>$row[4]]);
	}
?>