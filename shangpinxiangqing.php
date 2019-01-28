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
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <script type="text/javascript" src="scripts/num-alignment.js"></script>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
  
        <title></title>
      
         <style type="text/css">

        #demo {
            display: block;
            width: 400px;
            height: 350px;
            margin: 10px;
            position: relative;
            border: 1px solid #ccc;
        }

        #small-box {
            position: relative;
            z-index: 1;
        }

        #float-box {
            display: none;
            width: 160px;
            height: 120px;
            position: absolute;
            background: #ffffcc;
            border: 1px solid #ccc;
            filter: alpha(opacity=50);
            opacity: 0.5;
        }

        #mark {
            position: absolute;
            display: block;
            width: 400px;
            height: 355px;
            background-color: #fff;
            filter: alpha(opacity=0);
            opacity: 0;
            z-index: 10;
        }

        #big-box {
            display: none;
            position: absolute;
            top: 0;
            left: 430px;
            width: 400px;
            height: 300px;
            overflow: hidden;
            border: 1px solid #ccc;
            z-index: 1;;
        }

        #big-box img {
            position: absolute;
            z-index: 5
        }
        <?php 
        $wangye->css();
       
        ?>
        #shangbian{
            margin-top:2em;
            width:100%;
            height:500px;
            
        }
        #zuobian{
            
            width:500px;
            height:500px;
            float:left;
            
        }
        #lan{
            width:100%;
            height:50px;
        }
        #youbian{
           
            width:600px;
            height:500px;
            float:left;
        }
        .xuanzelan{
            float:left;
            width:150px;
            height:50px;
            background-color:RGB(252,162,152);
            line-height:50px;
            
        }
        .xuanzelan:hover{
            background-color:#ffcccc;
            cursor:pointer;

        }
        .xiaotu{
            width:100px;
            height:100px;
            margin:10px;
            float:left;
            
        }
        .xiaotu:hover{
            opacity: 0.5;
        }
       
        td{
            border-bottom: dashed 1px RGB(252,162,152);
            height:100px;
        }
        
    </style>
    


    <script>

        //页面加载完毕后执行
        window.onload = function () {

            var objDemo = document.getElementById("demo");
            var objSmallBox = document.getElementById("small-box");
            var objMark = document.getElementById("mark");
            var objFloatBox = document.getElementById("float-box");
            var objBigBox = document.getElementById("big-box");
            var objBigBoxImage = objBigBox.getElementsByTagName("img")[0];

            objMark.onmouseover = function () {
                objFloatBox.style.display = "block"
                objBigBox.style.display = "block"
            }

            objMark.onmouseout = function () {
                objFloatBox.style.display = "none"
                objBigBox.style.display = "none"
            }

            objMark.onmousemove = function (ev) {

                var _event = ev || window.event;  //兼容多个浏览器的event参数模式

                var left = _event.clientX - objDemo.offsetLeft - objSmallBox.offsetLeft - objFloatBox.offsetWidth / 2;
                var top = _event.clientY - objDemo.offsetTop - objSmallBox.offsetTop - objFloatBox.offsetHeight / 2;

                if (left < 0) {
                    left = 0;
                } else if (left > (objMark.offsetWidth - objFloatBox.offsetWidth)) {
                    left = objMark.offsetWidth - objFloatBox.offsetWidth;
                }

                if (top < 0) {
                    top = 0;
                } else if (top > (objMark.offsetHeight - objFloatBox.offsetHeight)) {
                    top = objMark.offsetHeight - objFloatBox.offsetHeight;

                }

                objFloatBox.style.left = left + "px";   //oSmall.offsetLeft的值是相对什么而言
                objFloatBox.style.top = top + "px";

                var percentX = left / (objMark.offsetWidth - objFloatBox.offsetWidth);
                var percentY = top / (objMark.offsetHeight - objFloatBox.offsetHeight);

                objBigBoxImage.style.left = -percentX * (objBigBoxImage.offsetWidth - objBigBox.offsetWidth) + "px";
                objBigBoxImage.style.top = -percentY * (objBigBoxImage.offsetHeight - objBigBox.offsetHeight) + "px";
            }
        }
    </script>
    <script type="text/javascript"> 
        function xiangqing(){
            var mychar = document.getElementById("xiangqing").style.display ="block";
            var mychar2 = document.getElementById("pinglun").style.display ="none";
        }
        function pinglun(){
            var mychar = document.getElementById("xiangqing").style.display ="none"; 
            var mychar = document.getElementById("pinglun").style.display ="block"; 
        }
        function xianshi(name){
           
            document.aaa.src="upload/"+name;
            document.image.src="upload/"+name;
        }
</script>
</head>
<body>
    <div id="suoyou">
        <?php
        // put your code here
        $wangye->biaotou();
         $id=$_GET['id'];
        $select="SELECT * FROM `shangpin` WHERE id=".$id;
        $stmt=$lianjie->query($select); 
        $stmt2=$stmt->fetch(PDO::FETCH_ASSOC);
        ?>
    <div id="nav"></div>
    <div id="shangbian">
    <div id="zuobian">
        <div id="demo">
    <div id="small-box">
        <div id="mark"></div>
        <div id="float-box"></div>
        <?php
        $img= explode("+", $stmt2['image']);
        $count=count($img);
        
        echo '<img name="aaa" width="400px" height="350px" src="upload/'.$img[0].'"/>';
         ?>
    </div>
    <div id="big-box">
        
        <?php echo '<img name="image" src="upload/'.$img[0].'"/>';
        //<img name="image" src="img/beijing3.jpg"/>?>
    </div>
</div><?php

for($i=0;$i<$count;$i++){
   echo '<div class="xiaotu"><img width="100px" height="100px" src="upload/'.$img[$i].'" onclick="xianshi('."'$img[$i]'".')"/></div>';
        }

        ?>
    </div>
    <div id="youbian">
        <?php
       
       
        echo '<h1>'.$stmt2['mingcheng'].'</h1><a href="yonghuzhongxin.php?action=addshoucang&&id='.$id.'">收藏</a>';
        echo '<p>'.$stmt2['jieshao'].'</p><hr/>';
        echo '<p>销量：'.$stmt2['xiaoliang'].'</p>';
        echo '<h2>￥'.$stmt2['jiage'].'</h2>';
        
        echo '<form method="post" action="shangpinxiangqing.php?id='.$id.'"><input name="shuliang" id="5" data-step="1" data-min="1" data-max="50" data-digit="0" value="1"/><br><br>';
           echo ' <input style="background-color: RGB(252,162,152);height:50px;width:150px;"type="submit" name="Submit" data-edit="true" value="加入购物车" >
    </form>';
        
        if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
            if(!isset($_COOKIE['isLogin'])||$_COOKIE['isLogin']==""){
                ?><script language="javascript"> 
            alert("请先登录！！");

             </script> <?php
            }else{
        
        $stmt=$lianjie->prepare("INSERT INTO `gouwuche`(`id`, `username`, `shangpinid`, `shuliang`) VALUES (NULL,?,?,?)");
        $username=$_COOKIE['yonghuming'];
        $shangpinid=$id;
        $shuliang=$_POST['shuliang'];
              
             $stmt->bindParam(1,$username,PDO::PARAM_STR);
             $stmt->bindParam(2,$shangpinid,PDO::PARAM_STR);
             $stmt->bindParam(3,$shuliang,PDO::PARAM_STR);
            
             $stmtt=$stmt->execute();
             if($stmtt)
             { ?><script language="javascript"> 
            alert("添加成功");

             </script> <?php }
             else {?><script language="javascript"> 
            alert("添加失败");

             </script> <?php }
            }
             
        }
        ?>
    <script>

        // 自定义类型：参数为数组，可多条数据
        alignmentFns.createType([{"test": {"step" : 10, "min" : 10, "max" : 999, "digit" : 0}}]);
        
        // 初始化
        alignmentFns.initialize();
        
        // 销毁
        alignmentFns.destroy();
        
        // js动态改变数据
        $("#4").attr("data-max", "12")
        // 初始化
        alignmentFns.initialize();
        
    </script>

    </div>
    </div>
    <div id="pinglunhexiangqing">
        
        <div id="lan">
            <div class="xuanzelan" onclick="xiangqing()"><p align='center'>详情</p></div>
            <div class="xuanzelan" onclick="pinglun()"><p align='center'>评论</p></div>
        </div>
        <div id="nav"></div>
        <div id="xiangqing">
            <?php 
            $img2=explode("+",$stmt2['jieshaoimg']);
            $count2=count($img2);
            for($j=0;$j<$count2;$j++){
                echo '<img style="width:100%;margin-top: 3em;"src="upload/'.$img2[$j].'">';
            }
           
            ?>
        </div>
        <div id="pinglun" style="display: none;">
            <?php
            $select2="SELECT * FROM `pinglun` WHERE shangpinid=".$id;
            $stmt3=$lianjie->query($select2);
            echo '<table width="100%" style="margin-top:20px;">';
            while(list($id,$idd/*商品id*/,$username,$time,$neirong)=$stmt3->fetch(PDO::FETCH_NUM)){
                $select3="SELECT touxiang FROM `user` WHERE username='".$username."'";
                $stmt4=$lianjie->query($select3);
                $stmtt4=$stmt4->fetch(PDO::FETCH_NUM);
                echo '<tr>';
                echo '<td style="width:120px;"><img width="100px" src="upload/'.$stmtt4[0].'">'
                        . '<br><p align="center" style="font-size:12px;">'.$username.'<p></td>';
                echo ' <td><p style="text-align:left;">'.$neirong.'</p><br><p align="right" style="font-size:12px;">'.$time.'</p></td>';
                echo '</tr>';
            }
            ?>
            
            </table>
        </div>
        
    </div>
    
    </div>
    
    </body>
</html>