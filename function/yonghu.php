<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';


class yonghu{
    function chakan(){
        $net=new net();
       $lianjie=$net->lianjie();
         ?>
<center>
    <table border="1" align="center" width="80%" style="margin-top: 20px;">
           
            
           
            <tr bgcolor="#cccccc">
                <th>用户名</th><th>密码</th><th>邮箱</th><th>
        <?php 
       
        $select="SELECT username,password,email FROM `user`";
        $stmt=$lianjie->query($select);
        
        $col=0;
        while(list($username,$password,$email)=$stmt->fetch(PDO::FETCH_NUM)){
            if($col%2==0){
                echo '<tr bgcolor=#cccccc>';
            }
            else {echo '<tr>';}
            
            echo  '<td><a href="">'.$username.'</a></td>';
            echo  '<td>'.$password.'</td>';
            echo  '<td>'.$email.'</td>';
            echo '</tr>';
            $col++;
            
        }
            ?>
        
         </table></center>
<?php
    }
    function xiangxi(){
        $net=new net();
       $lianjie=$net->lianjie();
       $select="SELECT username,password,email,touxiang FROM `user` WHERE username='".$_COOKIE['yonghuming']."'";
        $stmt=$lianjie->query($select);
        $stmtt=$stmt->fetch(PDO::FETCH_ASSOC);
         ?>
<center>
    <table  align="center" style="margin-top: 20px;">
          <?php 
       
        
        echo '<tr><td>用户名：</td><td>'.$stmtt['username'].'</td></tr>';
        if($stmtt['touxiang']!=NULL){
            echo '<tr><td>头像：</td><td><img width="100px" src="upload/'.$stmtt['touxiang'].'"></td></tr>';
        }
        echo '<tr><td>邮箱：</td><td>'.$stmtt['email'].'</td></tr>';
           
            ?>
        
         </table></center>
<?php
    }
    
    function touxiang(){ 
        $net=new net();
       $lianjie=$net->lianjie();?>
<form name="tianjia" method="post" action="yonghuzhongxin.php?action=addtouxiang" enctype="multipart/form-data">
    
            <table>
                
               <tr><td><p>头像：</p></td>
             <td><input type="file" name="tupian"  /></td></tr>
               
                </table>
            
        <input type="submit" name="Submit" value="提交"></form>
    <?php 
    if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
        
        $stmt=$lianjie->prepare("UPDATE `user` SET `touxiang` =? WHERE `user`.`username` = ?");
              $touxiang= upload1('tupian');
              $username=$_COOKIE['yonghuming'];
             
             $stmt->bindParam(1,$touxiang,PDO::PARAM_STR);
             $stmt->bindParam(2,$username,PDO::PARAM_STR);
            
             $stmtt=$stmt->execute();
             if($stmtt)
             { ?><script language="javascript"> 
            alert("提交成功");

             </script> <?php }
             else {?><script language="javascript"> 
            alert("提交失败");

             </script> <?php }
             
             
        }
    }
    function dingdan(){
        $net=new net();
       $lianjie=$net->lianjie();
       ?>
       <div id="shangpin">
       <?php  
       if(isset($_GET['action'])){
           if($_GET['action']=='wodedingdan'){
           $select="SELECT * FROM `dadingdan` WHERE `username`='".$_COOKIE['yonghuming']."'" ;}
           if($_GET['action']=='daifahuo'){
               $select="SELECT * FROM `dadingdan` WHERE `username`='".$_COOKIE['yonghuming']."' AND `fahuozhuangtai`=0" ;
           }
            if($_GET['action']=='daishouhuo'){
               $select="SELECT * FROM `dadingdan` WHERE `username`='".$_COOKIE['yonghuming']."' AND `fahuozhuangtai`=1 AND `shouhuozhuangtai`=0" ;
           }
            
       }
        $stmt=$lianjie->query($select);
        
        $zongjia=0;
       
       
         while(list($id,$fahuozhuangtai,$shouhuozhuangtai,$username,$time)=$stmt->fetch(PDO::FETCH_NUM)){ 
             echo '<p style="float:left;">订单编号:'.$id.'|  下单时间:'.$time.'</p>';
            if($_GET['action']=='daishouhuo')
                { echo '<a style="float:right;" href="yonghuzhongxin.php?action=shouhuo&&id='.$id.'">收货</a>';}
             echo '
         <center>       
        <table width="100%" style="border: none; border-bottom: dashed 1px black; margin-bottom:20px;">';
             
             
                 $select3="SELECT id,shangpinid,shuliang  FROM `dingdan` WHERE dingdanhao='".$id."'";
                 $stmt4=$lianjie->query($select3);
                 
                     $stmtt4=$stmt4->fetchAll(PDO::FETCH_ASSOC);
                     
                     for($i=0;$i<count($stmtt4);$i++){
                          $select2="SELECT mingcheng,jiage,image FROM `shangpin` WHERE id=".$stmtt4[$i]['shangpinid'];  
                          $stmt2=$lianjie->query($select2);
             $stmtt2=$stmt2->fetch(PDO::FETCH_ASSOC);
             $img=explode("+", $stmtt2['image']);  
//echo '<tr><td style="width:50px;"><input type="checkbox" >';
             echo '<td style="width:150px;"><img width="90px" src="upload/'.$img[0].'"></td>';
                echo '<td style="width:170px;"><p>'.$stmtt2['mingcheng'].'</p></td>';
                echo '<td style="width:100px;"><p>'.$stmtt2['jiage'].'</p> </td> ';
                echo ' <td style="width:100px;"><p>'.$stmtt4[$i]['shuliang'].'</p> </td>';
               
                if($i==0){
                echo '<td rowspan='.count($stmtt4).'style="width:130px;"><p>'. fahuo($fahuozhuangtai).'<p></td>';
                echo '<td rowspan='.count($stmtt4).'style="width:130px;"><p>'. shouhuo($shouhuozhuangtai).'<p></td>';
                }
                
            echo '</tr>';
                     }
                
                
               
             
             
            ?>
            </table>
        
  
            </center>
    <hr>
                   
       <?php  }
        
         
        ?>
    
            
            
           
        
    
    </div>
           <?php
           
            
        
    }
    
     function shouhuo(){
        $net=new net();
       $lianjie=$net->lianjie();
        $id=$_GET['id'];
    $stmt=$lianjie->prepare("UPDATE `dadingdan` SET `shouhuozhuangtai` = '1' WHERE `id` = ?");
        $stmt->bindParam(1, $id,PDO::PARAM_STR);
        $stmtt=$stmt->execute();
        if($stmtt)
             { ?><script language="javascript"> 
            alert("操作成功");
            window.location.href = "yonghuzhongxin.php?action=wodedingdan";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("操作失败");
            window.location.href = "yonghuzhongxin.php?action=wodedingdan";
             </script><?php }
    }
    
}
function fahuo($fahuozhuangtai){
               if($fahuozhuangtai==0){
                   return "待发货";
               }else{
                   return "已发货";
               }
           }
          function shouhuo($shouhuozhuangtai){
               if($shouhuozhuangtai==0){
                   return "待收货";
               }else{
                   return "已收货";
               }
           }
function upload1($myfile){
                 $allowtype=array("gif","png","jpg");
                 $size=10000000;
                 $path="./upload";
                 if($_FILES[$myfile]['error']>0){
                     echo "上传错误";
                 
                 switch($_FILES[$myfile]['error']){
                     case 1: die('上传文件大小超出了PHP配置文件中的约定值： upload_max_filesize');
                     case 2: die('上传文件大小超出了表单中的约定值');
                     case 3: die('文件只被部分上载');
                     case 4: die('没有上传任何文件');
                     default :die('未知错误');
                     
                 }
                 
                 }
                 $hzz=explode(".", $_FILES[$myfile]['name']);
                 $hz= array_pop($hzz);
                 
                 if(!in_array($hz, $allowtype)){
                     die("这个后缀是<b>{$hz}</b>,不是允许的文件类型！");
                 }
                 if($_FILES[$myfile]['size']>$size){
                     die("超过了允许的<b>{$size}</b>字节大小");
                 }
                 //为了系统安全，也为了同名文件不会被覆盖，上传后将文件名使用系统定义
                 $filename=date("YmdHis").rand(100,999).".".$hz;
                 if(is_uploaded_file($_FILES[$myfile]['tmp_name'])){
                     if(!move_uploaded_file($_FILES[$myfile]['tmp_name'], $path.'/'.$filename)){
                         die ('问题：不能将文件移动到指定目录。');
                     }
                 }else{
                     die("问题：上传的文件不是一个合法文件");
                 }
                 return $filename;
             }

