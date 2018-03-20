<?php
     #1.数据库连接
	 require("init.php"); 
	 
	 $uid=$_REQUEST["uid"];
	 
	 #2.拼sql语句
	 $sql="select * from kaoqin where uid=$uid order by kid desc limit 1";
	 
	 #echo $sql;
	 
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_row($result);
	 #var_dump($row);
	 #print_r($row);
	 $res = "<b>$row[1]</b>号员工的打卡时间：$row[2]<br> ";
	 echo $res;
?>