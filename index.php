<?php 
         require_once 'function.php';
         require_once 'function/net.php';
         $wangye=new wangye();
         $net=new net();
       $lianjie=$net->lianjie();
        ?>
<html>
    <head>
        <meta charset="UTF-8">
         
        <title></title>
      <link rel="stylesheet" type="text/css" href="./css/style.css">
         <style type="text/css">
        <?php 
        $wangye->css();
       
        ?>
        body{
            background-color:white;
        }
        
           
            
        #zhongjian{
            height:500px;
           
            margin-top:10px;
        }
        #zuobian{
            height:500px;
            background-color:bisque;
            float:left;
            width:250px;
            margin-right: 50px;
        }
        #huadong{
            height:500px;
            
            float:left;
            width:800px;
        }
        .xuanze{
           
            height:50px;
            line-height: 50px;
            width:220px;
            margin:0 auto;
            border-radius: 10px;
            background-color:RGB(255,255,255);
            opacity:0.7;
            margin-top:5px;
            
        }
        .xuanze:hover {background-color:RGB(254,214,209);}
        
        #rexiao{
            margin-top: 2em;
        }
        
        tr{
            height: 100px;
        }
        
        
             </style> 
            
    </head>
    <body>
        <div id="suoyou">
        <?php
        // put your code here
        $wangye->biaotou();
        ?>
        <div id="nav">

    
</div>
        <div id="zhongjian">
            <div id="zuobian"> <?php 
             $select="SELECT id,mingcheng FROM `fenlei`";
        $stmt=$lianjie->query($select);
        echo '<a href="shangpinye.php"><div class="xuanze"><p align="center">所有商品</p></div></a>';
        while(list($id,$mingcheng)=$stmt->fetch(PDO::FETCH_NUM)){
            
            echo '<a href="shangpinye.php?fenlei='.$id.'" ><div class="xuanze" ><p align="center" >'.$mingcheng.'</p></div></a>';
        }
        
        $select2="SELECT * FROM `guanggao`";
        $stmt2=$lianjie->query($select2);
       
       ?>
            </div>
            <div id="huadong">
                <div class="content">
		<div class="a-content">
			<div class="carousel-content">
				<ul class="carousel">
                                    <?php
                                    while(list($id,$img,$url)=$stmt2->fetch(PDO::FETCH_NUM)){
                                       
                                        echo '<li><a href="'.$url.'"><img src="./upload/guanggao/'.$img.'"></a></li>';
                                    }/*<li><img src="./img/beijing.jpg"></li>
					<li><img src="./img/beijing2.jpg"></li>
					<li><img src="./img/beijing.jpg"></li>
                                        <li><img src="./img/beijing3.jpg"></li>*/
                                    
                                    ?>
					
				</ul>
				<ul class="img-index"></ul>
				<div class="carousel-prev"><img src="./img/left1.png"></div>
				<div class="carousel-next"><img src="./img/right1.png"></div>
			</div>
		</div>
	</div>
	<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="./scripts/carousel.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".carousel-content").carousel({
				carousel : ".carousel",//轮播图容器
				indexContainer : ".img-index",//下标容器
				prev : ".carousel-prev",//左按钮
				next : ".carousel-next",//右按钮
				timing : 3000,//自动播放间隔
				animateTime : 700,//动画时间
				autoPlay : true,//是否自动播放 true/false
				direction : "left",//滚动方向 right/left
			});

			$(".carousel-content").hover(function(){
				$(".carousel-prev,.carousel-next").fadeIn(300);
			},function(){
				$(".carousel-prev,.carousel-next").fadeOut(300);
			});

			$(".carousel-prev").hover(function(){
				$(this).find("img").attr("src","./img/left2.png");
			},function(){
				$(this).find("img").attr("src","./img/left1.png");
			});
			$(".carousel-next").hover(function(){
				$(this).find("img").attr("src","./img/right2.png");
			},function(){
				$(this).find("img").attr("src","./img/right1.png");
			});
		});
	</script>
            </div>
           
        </div>
        <div id="rexiao">
            <center><img src="img/rexiaoshangpin.png">
            <form>
                <table cellspacing="30px">
                    <tr>
                        <?php
                        $select2="SELECT id,mingcheng,image FROM `shangpin` ORDER BY xiaoliang DESC LIMIT 4";
                        $stmt2=$lianjie->query($select2);
                        while(list($id,$mingcheng,$image)=$stmt2->fetch(PDO::FETCH_NUM)){
                            $img= explode("+", $image);
                            echo '<td><a href="shangpinxiangqing.php?id='.$id.'"><img width="230px" height="200px" src="upload/'.$img[0].'"><p align="center">'.$mingcheng.'</p></a></td>';
                        }
                        ?>
                        
                    </tr>
                   
                </table>
            </form></center>
        </div>
        
        <div id="dibu">
            
    <p text-align="center">made by haha</p>
</div>
        </div>
       
    </body>
</html>
