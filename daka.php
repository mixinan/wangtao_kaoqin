<?php
	$uname=$_REQUEST["uname"];
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script type="text/javascript" src="js/jquery-1.11.3.js" ></script>
		<title>在线考勤管理系统-打卡</title>
		<style type="text/css">
			body,ul,li,p{margin: 0;padding: 0;}
			div#container{
				width: 330px;
				margin: 10px auto;
				text-align: center;
			}
			
			p.inp{
				position: relative;
			}
			
			input{
				width: 100%;
				height: 40px;
				margin-bottom: 20px;
				padding-left: 40px;
			}
			
			p.inp>i.input_img{
				background: red;
				display: inline-block;
				width: 32px;
				height: 32px;
				position: absolute;
				top: 5px;
				left: 4px;
			}
			
			p.btns{
				width: 100%;
				display: flex;
				justify-content: space-around;
			}
			
			button{
				padding: 12px;
				border-radius: 6px;
			}
		</style>
	</head>
	<body>
		<div id="uname">你好：<span><?php echo $uname?></span> <a id="console" style="display:none;" href="console.php?uname=<?php echo $uname;?>">控制台</a> <a href="./">退出</a></div>
		<div id="container">
			<h2 class="currentTime">
				<!--使用js代码获取当前时间-->
			</h2>
			
			<p>
				<button id="daka">签到</button>
			</p>
			<br>
			<p class="show_result">
				<!--显示打卡时间-->
			</p>
		</div>
		
		
		<script type="text/javascript">
				/*
					分、秒，如果是一位数，在前面加0
				*/
				function jiaLing (obj) {
        			if (obj < 10) return "0" + obj; 
					else return obj;
     			}
		
				
				function current(){
					var d=new Date();
					var str='';
					str +=d.getFullYear()+'-'; //获取当前年份
					str +=d.getMonth()+1+'-'; //获取当前月份（0——11）
					str +=d.getDate()+'<br>';
					str +=d.getHours()+':';
					str +=jiaLing(d.getMinutes())+':';
					str +=jiaLing(d.getSeconds());
					return str; 
				}
				
				$(".currentTime").html(current);

				setInterval(function(){$(".currentTime").html(current)},1000); 
				
				

					//setInterval(getCurrentTime(),1000);    

				
				function getCurrentTime(){
					$(".currentTime").text(new Date().toLocaleString());
				}
				
				var emp = null;
				
				$.ajax({
					url:"./data/getEmpByUname.php",
					type:"post",
					async:true,
					data:{
						uname:"<?php echo $uname?>"
					},
					dataType:'json',
					success:function(data){
						//alert(data);
						emp = data;
						
						var is_leader=data.is_leader;
						if(is_leader==1){
							$("a#console").show();
						}
					},
					error:function(data){
						//$("p.show_result").html(data);
					}
				});
			
			
			/*
			 	点击签到按钮
			*/
			$("#daka").on("click",function(){
				
				daka(emp.uid);
				
				
			});
			
			
			
			function daka(uid){
				jQuery.ajax({
					url:"./data/daka.php",
					type:"post",
					async:true,
					data:{
						uid:uid				
					},
					dataType:'text',
					success:function(data){
						
						$("p.show_result").html(data);
						//0.2秒后刷新页面
						setTimeout(getLastOne(uid),200);
						//打卡按钮变为“不可用”状态
						$("#daka").text("打卡完毕").attr("disabled", true);
					},
					error:function(data){
						$("p.show_result").html(data);
					}
				});
			}
			
			
			function getLastOne(uid){
				jQuery.ajax({
					url:"./data/getLastByUid.php",
					type:"get",
					async:true,
					data:{
						uid:uid				
					},
					dataType:'text',
					success:function(data){
						
						$("p.show_result").html(data);

					},
					error:function(data){
						$("p.show_result").html(data);
					}
				});
			}
			
			
		</script>
	</body>
</html>
