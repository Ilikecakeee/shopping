<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
         require_once 'function.php';
         require_once 'function/yonghu.php';
         require_once 'function/fenlei.php';
         require_once 'function/shangpin.php';
         require_once 'function/dingdan.php';
         require_once 'function/guanggao.php';
         $wangye=new wangye();
         $yonghu=new yonghu();
         $fenlei=new fenlei();
         $shangpin=new shangpin();
         $dingdan=new dingdan();
         $guanggao=new guanggao();
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
         <style type="text/css">
             
		img{border:0;}
        
		
		.treebox{ width: 270px; margin: 0 auto; background-color: RGB(252,162,152); }
		.menu{ overflow: hidden; border-color: #ddd; border-style: solid ; border-width: 0 1px 1px ; }
		/*第一层*/
		.menu li.level1>a{ 
			display:block;
			height: 45px;
			line-height: 45px;
			color: #fff;
			padding-left: 50px;
			border-bottom: 1px solid #000; 
			font-size: 16px;
			position: relative;
			transition:all .5s ease 0s;
		 }
		 .menu li.level1 a:hover{ text-decoration: none;background-color: RGB(253,198,191);   }
		 .menu li.level1 a.current{ background: #0f4679;background-color: RGB(252,162,152); }

		/*============修饰图标*/
		 /*.ico{ width: 20px; height: 20px; display:block;   position: absolute; left: 20px; top: 10px; background-repeat: no-repeat; background-image: url(img/ico1.png); }*/

		 /*============小箭头*/
		 .level1 i{ width: 20px; height: 10px; background-image:url(img/arrow.png); background-repeat: no-repeat; display: block; position: absolute; right: 20px; top: 20px; }
		.level1 i.down{ background-position: 0 -10px; }

		 .ico1{ background-position: 0 0; }
		 .ico2{ background-position: 0 -20px; }
		 .ico3{ background-position: 0 -40px; }
		 .ico4{ background-position: 0 -60px; }
                 .ico5{ background-position: 0 -80px; }

		 /*第二层*/
		 .menu li ul{ overflow: hidden; }
		 .menu li ul.level2{ display: none;background: #0f4679;  }
		 .menu li ul.level2 li a{
                     background-color: RGB(253,198,191);
		 	display: block;
			height: 45px;
			line-height: 45px;
			color:#510000;
	                font-size:18px;
			text-indent: 60px;
			/*border-bottom: 1px solid #ddd; */
			
			 transition:all 1s ease 0s;
		 }
                 .menu li ul.level2 li a:hover{
                     background-color:RGB(254,214,209);
                 }
        <?php 
        $wangye->css();
       
        ?>
        #xiabu{
            width:100%;
            margin-top:20px;
        }
        #cebianlan{
            width:270px;
            height:500px;
            float:left;
            
        }
        #neirong{
            width:800px;
            margin-left:20px;
            float:left;
        }
        input{
    border:1px solid;
    height:30px;
    width:300px;
}
p{
	font-weight:bold;
	color:#510000;
	font-size:18px;
}
        
        
        
             </style>
    </head>
    <body>
        <div id="suoyou">
        <div class="datou">
            <div id="denglulan">
                <?php
                
                 if(isset($_COOKIE['isLogin'])&&$_COOKIE['isLogin']=='1'){
                     
                     echo '<a href="index.php?type=yonghu">你好 '.$_COOKIE['yonghuming'].'/</a>';
                     echo '<a href="login.php?action=logout">  注销</a>';
            }else{
                echo '<a href="login.php">登录</a>';
                echo '<a  href="regist.php">/注册</a>';
            }
                        ?>
                
            </div>
<div id="biaotou">
<a href="index.php"><div id="logo">
    <img src="img/timg.jpg" style="height:100px"/>
<img src="img/捕获.PNG" style="height:60px"/></div></a>

</div>
</div>
        <div id="nav"></div>
        <div id="xiabu">
            <div id="cebianlan">
                <div class="treebox">
		<ul class="menu">
			<li class="level1">
				<a href="#none"><em class="ico ico1"></em>管理用户<i class="down"></i></a>
				<ul class="level2">
					<li><a href="admin.php?action=yonghu">查看用户</a></li>
					
					
				</ul>
			</li>
                        <li class="level1">
				<a href="#none"><em class="ico ico2"></em>管理分类<i></i></a>
				<ul class="level2">
					<li><a href="admin.php?action=addfenlei">添加分类</a></li>
                                        <li><a href="admin.php?action=showfenlei">查看分类</a></li>
					
					
				</ul>
			</li>
			<li class="level1">
				<a href="#none"><em class="ico ico3"></em>管理商品<i></i></a>
				<ul class="level2">
					
					<li><a href="admin.php?action=addshangpin">添加商品</a></li>
					<li><a href="admin.php?action=showshangpin">修改商品</a></li>
					
				</ul>
			</li>
			<li class="level1">
				<a href="#none"><em class="ico ico4"></em>管理订单<i></i></a>
				<ul class="level2">
					<li><a href="admin.php?action=suoyoudingdan">所有订单</a></li>
					<li><a href="admin.php?action=daifahuo">待发货</a></li>
					
				</ul>
			</li>
			<li class="level1">
				<a href="#none"><em class="ico ico5"></em>管理广告<i></i></a>
				<ul class="level2">
					<li><a href="admin.php?action=addguanggao">添加广告</a></li>
					<li><a href="admin.php?action=chakanguanggao">查看广告</a></li>
					
				</ul>
			</li>
                        
		</ul>
	</div>
            </div>
            <div id="neirong">
                <?php
                if(isset($_GET['action'])){
                    if($_GET['action']=='yonghu')
                    { $yonghu->chakan();}
                    if($_GET['action']=='addfenlei'){
                        $fenlei->addfenlei();
                                
                    }if($_GET['action']=='showfenlei'){
                        
                        $fenlei->show();
                    }if($_GET['action']=='addshangpin'){
                        $shangpin->addshangpin();
                    }if($_GET['action']=='showshangpin'){
                        $shangpin->show();
                    }if($_GET['action']=='xiugaizhuangtai'){
                        $shangpin->fashouu();
                    }if($_GET['action']=='xiugaishangpin'){
                        $shangpin->xiugai();
                    }if($_GET['action']=='shanchushangpin'){
                        $shangpin->shanchu();
                    }
                    if($_GET['action']=='suoyoudingdan'){
                        $dingdan->show();
                    }if($_GET['action']=='fahuo'){
                        $dingdan->fahuo();
                    }if($_GET['action']=='daifahuo'){
                        $dingdan->show();
                    }if($_GET['action']=='addguanggao'){
                        $guanggao->addguanggao();
                    }if($_GET['action']=='chakanguanggao'){
                        $guanggao->show();
                    }if($_GET['action']=='shanchuguanggao'){
                        $guanggao->shanchu();
                    }
                    
                }else{
                    echo "<img width=100% src='img/beijing.jpg'>";
                }
                ?>
            </div>
        </div>
        </div>
        
        
        <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="scripts/easing.js"></script>
<script>
//等待dom元素加载完毕.
	$(function(){
		$(".treebox .level1>a").click(function(){
			$(this).addClass('current')   //给当前元素添加"current"样式
			.find('i').addClass('down')   //小箭头向下样式
			.parent().next().slideDown('slow','easeOutQuad')  //下一个元素显示
			.parent().siblings().children('a').removeClass('current')//父元素的兄弟元素的子元素去除"current"样式
			.find('i').removeClass('down').parent().next().slideUp('slow','easeOutQuad');//隐藏
			 return false; //阻止默认时间
		});
	})
</script>
        
    </body>
</html>