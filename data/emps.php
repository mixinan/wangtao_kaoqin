<?php

   header("Content-Type:application/json");

	 require("init.php"); 

	 $sql="select * from emp";

   $result=mysqli_query($conn,$sql);

	 $array=mysqli_fetch_all($result,MYSQLI_ASSOC);

	 echo json_encode($array);

?>