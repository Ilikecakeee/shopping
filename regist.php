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
            
            height:500px;
            background-image:url(img/beijing2.jpg);
            background-repeat:no-repeat;
            background-size:100% 700px; 
        }
        #zhuce{
            background-color:RGB(255,255,255);
           
            float:right;
            width:40%;
            height:380px;
            margin-right:50px;
            margin-top:60px;
            opacity:0.7;
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
                    <form name="zhuce" method="post" action="regist.php" >
                    
                         
            <table style="margin: 0 auto;margin-top: 50px">
               <caption style="margin-left:50px;"><h2>注册</h2></caption>
                <tr ><td><p>用户名：</p></td>
             <td><input name="yonghuming" type="text" ></td></tr>
              <tr ><td><p>邮箱：</p></td>
                  <td><input name="youxiang" type="email" ></td></tr>
             <tr><td><p>密码：</p></td>
                 <td><input name="mima" type="password" ></td></tr>
             <tr ><td><p>确认密码：</p></td>
                 <td><input name="querenmima" type="password" ></td></tr>
             <tr><td colspan="2"><input type="submit" name="Submit" value="提交" style="margin-left: 50px;"></td></tr>
             <tr><td colspan="2"><a href="index.php">返回主页</a> </td></tr>
                </table>
            
        </form>
                     
                </div>
    
</div>
        </div>
        </div>
        <?php
        // put your code here
        if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
         $mode='/^\w+@\w+(\.\w+){0,3}$/';
        $lianjie=$net->lianjie();
        
        $yonghuming=$_POST['yonghuming'];
        $mima=$_POST['mima'];
        $querenmima=$_POST['querenmima'];
        $youxiang=$_POST['youxiang'];
        if($mima!=$querenmima){?>
            <script language="javascript"> 
            alert("两次密码不一样！");

             </script>
      <?php  }
        if(!preg_match($mode,$youxiang)){
            ?>
            <script language="javascript"> 
            alert("邮箱格式不正确！！");

             </script>
      <?php 
         }
         $select="SELECT username FROM `user` WHERE username=\"".$yonghuming."\"";
         $stmt2=$lianjie->prepare($select);
         $stmt2->execute();
        
         $result=$stmt2->fetch(PDO::FETCH_NUM);
        
         
         if($result!=NULL){
             ?>
            <script language="javascript"> 
            alert("该用户名已注册！！");

             </script>
      <?php 
         }
         if($yonghuming==NULL||$mima==NULL||$querenmima==NULL||$youxiang==NULL){
             ?>
            <script language="javascript"> 
            alert("不能有空项！！");

             </script>
      <?php 
         }
         if(($mima==$querenmima)&&preg_match($mode,$youxiang)&&$result==NULL
                 &&!($yonghuming==NULL||$mima==NULL||$querenmima==NULL||$youxiang==NULL)){
            $stmt=$lianjie->prepare("INSERT INTO `user` ( `username`, `password`, `email`) VALUES (?,?,?)");
             
        
             $stmt->bindParam(1,$yonghuming,PDO::PARAM_STR);
             $stmt->bindParam(2,$mima,PDO::PARAM_STR);
             $stmt->bindParam(3,$youxiang,PDO::PARAM_STR);
             
         $stmtt=$stmt->execute();
            if($stmtt){
                ?>
            <script language="javascript"> 
            alert("提交成功！！");
            header("Location:login.php")

             </script>
      <?php 
            }
             
          }
             
             
        }
        ?>
    </body>
</html>