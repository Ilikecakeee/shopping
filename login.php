<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
         require_once 'function.php';
         require_once 'function/net.php';
         $wangye=new wangye();
         $net=new net();
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
         <style type="text/css">
        <?php 
        $wangye->css();
       
        ?>
        #beijing{
            background-color:aqua;
            height:500px;
            background-image:url(img/beijing3.jpg);
            background-repeat:no-repeat;
            background-size:100% 700px; 
        }
        #zhuce{
            background-color:RGB(255,255,255,0.8);
            float:right;
            width:40%;
            height:380px;
            margin-right:50px;
            margin-top:60px;
            opacity:0.8;
            border-radius: 10px;
        }
        input{
    border:1px solid;
    height:30px;
    width:300px;
}
tr{
    height:35px;
}
             </style>
    </head>
    <body>
        <div id="suoyou">
        <div class="datou">
            <div id="biaotou">
<div id="logo">
<img src="img/timg.jpg" style="height:100px"/>
<img src="img/捕获.PNG" style="height:60px"/></div>

</div>
            <div id="beijing">
                <div id="zhuce">
                     <form name="zhuce" method="post" action="login.php?action=login" >
                    
                         
            <table style="margin: 0 auto;margin-top: 50px">
               <caption style="margin-left:50px;"><h2>登录</h2></caption>
                <tr ><td><p>用户名：</p></td>
             <td><input name="yonghuming" type="text" ></td></tr>
              
             <tr><td><p>密码：</p></td>
                 <td><input name="mima" type="password" ></td></tr>
             <tr><td></td><td> <img src="image_captcha.php"  onclick="this.src='image_captcha.php?'+new Date().getTime();" width="200" height="100"><br/>
        <input type="text" name="captcha" placeholder="请输入图片中的验证码"><br/></td></tr>
             <tr><td colspan="2"><input type="submit" name="Submit" value="提交" style="margin-left: 50px;"></td></tr>
             <tr><td colspan="2"><a href="index.php">返回主页</a> <a href="regist.php">还没有账号？</a></td></tr>
                </table>
            
        </form>
                     
                </div>
    
</div>
        </div>
        </div>
        <?php
        // put your code here
        function clearCookies(){
            setcookie('yonghuming','',time()-3600);
            setcookie('isLogin',"",time()-3600);
        }
        if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
            $lianjie=$net->lianjie();
        $yonghuming=$_POST['yonghuming'];
        $mima=$_POST['mima'];
        session_start();
//1. 获取到用户提交的验证码
$captcha = $_POST["captcha"];

//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
if(!(strtolower($_SESSION["captcha"]) == strtolower($captcha))){
     ?>
            <script language="javascript"> 
            alert("验证码不正确！！");

             </script>
      <?php
    
}
         $select="SELECT username,password FROM `user` WHERE username=\"".$yonghuming."\"";
         $stmt2=$lianjie->prepare($select);
         $stmt2->execute();
        
         $result=$stmt2->fetch(PDO::FETCH_NUM);
         if($yonghuming==NULL||$mima==NULL){
             ?>
            <script language="javascript"> 
            alert("不能有空项！！");

             </script>
      <?php
         }
        if(isset($_GET['action'])&&$_GET['action']=="login"&&!($yonghuming==NULL||$mima==NULL)&&(strtolower($_SESSION["captcha"]) == strtolower($captcha))){
            //clearCookies();
            $_SESSION["captcha"] = "";
            if($mima==$result[1]){
                setcookie('yonghuming',$yonghuming,time()+60*60*24);
                setcookie('isLogin','1',time()+60*60*24);
                header("Location:index.php");
            }else if($yonghuming=="haha"&&$mima=="123456"){
                 setcookie('yonghuming',$yonghuming,time()+60*60*24);
                setcookie('isLogin','1',time()+60*60*24);
                header("Location:admin.php");
            }
            else{
                ?>
            <script language="javascript"> 
            alert("用户名或密码不正确！！");

             </script>
      <?php
            }}
        }
        if(isset($_GET['action'])&&$_GET["action"]=="logout"){
            clearCookies();
           
         }
        ?>
    </body>
</html>
