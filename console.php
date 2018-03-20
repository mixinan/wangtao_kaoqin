<?php
	$uname=$_REQUEST["uname"];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<script type="text/javascript" src="js/jquery-1.11.3.js" ></script>
		<title>在线考勤管理系统-管理</title>
		<style type="text/css">
			body,ul,li,p{margin: 0;padding: 0;}
			div#container{
				width: 580px;
				margin: 10px auto;
				text-align: center;
			}
			
			p.inp{
				position: relative;
			}
			
			p.inp>input{
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
		<div>你好：<span><?php echo $uname;?> </span><a href="./">退出</a></div>
		<div id="container">
			<h1>控制台</h1>
			<p id="btns">
				<button id="bt_regist">添加新员工</button>
				<button id="bt_select">查询考勤记录</button>
				<button id="bt_get_emps">查看员工列表</button>
			</p>
			<br />
			
			<!--
				显示结果的部分
			-->
			
			<div class="show_result">
				
				<!--
                               添加新员工
        -->
				<div id="regist_box" style="display: none;">
					<p class="inp">
						<input type="text" id="uname" placeholder="请输入用户名" />
						<i class="input_img"></i>
					</p>
					<p class="inp">
						<input type="password" id="upwd" placeholder="请输入密码" />
						<i class="input_img"></i>
					</p>
					<p class="btns">
						<button id="submit">提交</button>
						<button id="bt_lastid">此新员工的工号是？</button>
					</p>
				</div>
				
				<div id="select_box" style="display: none;">
					<p>
						<input type="text" id="uid" placeholder="要查询的工号"/>
						<select id="month">
							<option value="3">3月</option>
							<option value="2">2月</option>
							<option value="1">1月</option>
						</select>
						<button id="select">查询</button>
					</p>
				</div>
				
				
				
				<div id="search_result">
					
				</div>
				
			</div>
		</div>
		
		
		<script type="text/javascript">
		
			/*
			 	点击“添加员工”按钮
			*/
			$("#bt_regist").on("click",function(){
				$("#select_box").hide();
				$("#search_result").html("");
				$("#regist_box").show();
			});
			
			/*
			 	点击“查询记录”按钮
			*/
			$("#bt_select").on("click",function(){
				$("#regist_box").hide();
				$("#search_result").html("");
				$("#uid").val("");
				$("#select_box").show();
			});
			
			
			
			$("#submit").click(()=>{
				var uname=$("#uname").val().trim();
				var upwd=$("#upwd").val().trim();
				if(uname && upwd){
					//alert("test");
					regist(uname,upwd);
				}else{
					alert("请输入完整信息");
					
				}
				
			});
			
			
			/*
				点击查询考勤按钮
			*/
			$("#select").click(()=>{
				
				var uid = $("#uid").val();
				var month = $("#month").val();
				
				getKaoqin(uid,month);
				
				//alert(uid+""+month);
				
				
			});
			
			
			/*
				点击查询员工列表按钮
			*/
			$("#bt_get_emps").click(()=>{
				$("#select_box").hide();
				$("#regist_box").hide();
				getEmps();
			});
			
			
			function getKaoqin(uid,month){
				$.ajax({
					url:"./data/getkaoqin.php",
					type:"get",
					data:{
						uid:uid,
						month:month
					},
					async:true,
					dataType:'json',
					success:function(data){
						console.log(data);						
					
						var html="";
						for(var i=0;i<data.length;i++){

						   var kaoqin=data[i];

						   html += "<p>"+kaoqin.uname+" : "+kaoqin.kcreate_time+"</p>";

						}
						
						$("div#search_result").html(html);
					},
					error:function(data){
						//$("p.show_result").html(data);
					}
				});
				
			}
			
			
			$("#bt_lastid").click(function(){
				$.ajax({
					url:"./data/getLastUid.php",
					type:"get",
					async:true,
					dataType:'text',
					success:function(data){
						//获取最后一个用户的id，并加一，把结果显示在按钮上
						$("#bt_lastid").text("工号："+(parseInt(data)+1));
					},
					error:function(data){
						//$("p.show_result").html(data);
					}
				});
				
			});
			
			
			function regist(uname,upwd){
				$.ajax({
					url:"./data/regist.php",
					type:"post",
					async:true,
					data:{
						uname:uname,
						upwd:upwd						
					},
					dataType:'text',
					success:function(data){
						if(data=="ok")
							$("#regist_box").html("<h2>注册成功！</h2><p>用户名："+uname+"</p><p>密码："+upwd+"</p>");
						//0.2秒后刷新页面
						//setTimeout(getLastOne(uid),200);
						//打卡按钮变为“不可用”状态
						//$("#daka").text("打卡完毕").attr("disabled", true);
					},
					error:function(data){
						$("p.show_result").html(data);
					}
				});
				
			}
			
			
			
			function getEmps(){
				$.ajax({
					url:"./data/emps.php",
					type:"get",
					async:true,
					dataType:'json',
					success:function(data){
						console.log(data);						
					
						var html="<table border='1' cellspacing='0' cellpadding='8px'>";
						html += "<thead><td>工号</td><td>名字</td><td>入职时间</td><td>操作</td></thead>";
						for(var i=0;i<data.length;i++){

						   var emp=data[i];
						   
						   if(emp.is_leader==1){
							   html += "<tr><td>"+emp.uid+"</td><td>"+emp.uname+"</td><td>"+emp.u_join_time+"</td><td>管理员</td></tr>";
						   }else{
							   html += "<tr><td>"+emp.uid+"</td><td>"+emp.uname+"</td><td>"+emp.u_join_time+"</td><td><span style='color:blue;cursor:pointer;'>设为管理员</a></td></tr>";
						   }

						}
						
						html += "</table>";
						
						$("div#search_result").html(html);
					},
					error:function(data){
						//$("p.show_result").html(data);
					}
				});
				
			}
			
			
			$("#search_result").on("click","tr>td>span",(e)=>{
				var uid = $(e.target).parent().parent().children().eq(0).text();
				//console.log(uid);
				setManager(uid);
			});
			
			
			
			function setManager(uid){
				$.ajax({
					url:"./data/setManager.php",
					type:"post",
					async:true,
					data: {uid:uid},
					dataType:'text',
					success:function(data){
						if(data=="ok")
							getEmps();
					},
					error:function(data){
						$("p.show_result").html(data);
					}
				});
				
			}
			
			
		</script>
	</body>
</html>
