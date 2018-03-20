<?php
     #1.数据库连接
	 require("init.php"); 
	 
	 #2.拼sql语句
	 $sql="select uid from emp order by uid desc limit 1";
	 
	 #echo $sql;
	 
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_row($result);
	 #var_dump($row);
	 #print_r($row);
	 echo $row[0];
?>