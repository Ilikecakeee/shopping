<?php
class wangye{ 
function css(){?>
        
            body{min-width:1100px;
width:100%;
margin: 0 auto;
}
#suoyou{
width:1100px;
margin: 0 auto;}
*{margin:0px;
border:0px;
padding:0px;
}
#denglulan{
    height:20px;
    background-color:#e9e9e9;
}
#biaotou{
height:120px;
}
#logo{
float:left;}
#sousuo{

margin-left:40px;
margin_top:50px;
}
#nav{height:5px;
background-color:RGB(252,162,152);
line-height:45px;
border-radius: 10px;
}
#dibu{
    background-color:RGB(252,162,152);
    height:200px;
    margin-top: 20px;
    border-radius: 10px;
}
.aa{padding:5em;display:inline;
font-weight:bold;
}
.ba{color:#3F1F1F;
font-weight:bold;
text-decoration:none;
font-size:20px;
}
a:hover{
color:#FF3300;}

p{
	
	color:#510000;
	font-size:18px;
}
a{
            text-decoration: none;
        }
       <?php }


       function biaotou(){ ?>
                <div class="datou">
            <div id="denglulan">
                <?php
                
                 if(isset($_COOKIE['isLogin'])&&$_COOKIE['isLogin']=='1'&&$_COOKIE['yonghuming']!="haha"){
                     
                     echo '<a href="">你好 '.$_COOKIE['yonghuming'].'/</a>';
                     echo '<a href="gouwuche.php">购物车/</a>';
                     echo '<a href="yonghuzhongxin.php">个人中心/</a>';
                     echo '<a href="login.php?action=logout">  注销</a>';
            }else if(isset($_COOKIE['isLogin'])&&$_COOKIE['isLogin']=='1'&&$_COOKIE['yonghuming']=="haha"){
                echo '<a href="">你好 '.$_COOKIE['yonghuming'].'/</a>';
                    
                     echo '<a href="admin.php">管理/</a>';
                     echo '<a href="login.php?action=logout">  注销</a>';
            }
            else{
                echo '<a href="login.php">登录</a>';
                echo '<a  href="regist.php">/注册</a>';
            }
            
                        ?>
                
            </div>
<div id="biaotou">
<a href="index.php"><div id="logo">
    <img src="img/timg.jpg" style="height:100px"/>
<img src="img/捕获.PNG" style="height:60px"/></div></a>
<div id="sousuo"><?php

    echo '<form name="sousuo" method="post"  > ';
            ?>
        <table>
                        <tr>
                            <td> <input name="search" type="search" style="height:33px;width:300px;color:#999999; border:2px solid;
                            border-color:RGB(255,215,235);margin-left: 50px;margin-top: 50px; " placeholder="搜索感兴趣的蛋糕"/></td>
                <td><input style="margin-top: 50px;background-color: RGB(252,162,152);height:33px;width:100px;"type="submit" name="Submit" value="搜索" style="height:33px;width:40px;"></td></tr>
        </table>
    </form>
 
</div>
</div>
</div>

<?php
if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
    if(isset($_POST['search'])){
           $search=$_POST['search'];
           $location='Location:shangpinye.php?search='.$search;
    header($location);}
           
           }

            }
   }
       ?>