<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';
class dingdan{
    function show(){
        $net=new net();
       $lianjie=$net->lianjie();
       ?>
       <div id="shangpin">
       <?php  
       if(isset($_GET['action'])){
           if($_GET['action']=='suoyoudingdan'){
                $select="SELECT * FROM `dadingdan` " ;
           }if($_GET['action']=='daifahuo'){
                $select="SELECT * FROM `dadingdan` WHERE `fahuozhuangtai`=0" ;
           }
       }
      
        $stmt=$lianjie->query($select);
        while(list($id,$fahuozhuangtai,$shouhuozhuangtai,$username,$time)=$stmt->fetch(PDO::FETCH_NUM)){ 
             echo '<p style="float:left;">用户名:'.$username.'|  订单编号:'.$id.'|  下单时间:'.$time.'</p>';
             if($fahuozhuangtai==0){
             echo '<a style="float:right;" href="admin.php?action=fahuo&&id='.$id.'">发货</a>';}
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
    
    function fahuo(){
        $net=new net();
       $lianjie=$net->lianjie();
        $id=$_GET['id'];
    $stmt=$lianjie->prepare("UPDATE `dadingdan` SET `fahuozhuangtai` = '1' WHERE `id` = ?");
        $stmt->bindParam(1, $id,PDO::PARAM_STR);
        $stmtt=$stmt->execute();
        if($stmtt)
             { ?><script language="javascript"> 
            alert("操作成功");
            window.location.href = "admin.php?action=suoyoudingdan";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("操作失败");
            window.location.href = "admin.php?action=suoyoudingdan";
             </script><?php }
    }
    
    function daipinglun(){
        $net=new net();
        $lianjie=$net->lianjie();
        $username=$_COOKIE['yonghuming'];
        $select="SELECT dingdan.id,dingdan.shangpinid,shuliang FROM `dingdan`,`dadingdan` WHERE `dingdan`.`username`='".$username."' "
                . "AND `pinglun`=0 AND `shouhuozhuangtai`=1 AND dadingdan.id=dingdan.dingdanhao";
        $stmt=$lianjie->query($select); ?>
       <center>       
        <table width="100%" >
             
             <?php
                 
                 
                     $stmtt=$stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                     for($i=0;$i<count($stmtt);$i++){
                          $select2="SELECT mingcheng,jiage,image FROM `shangpin` WHERE id=".$stmtt[$i]['shangpinid'];  
                          $stmt2=$lianjie->query($select2);
             $stmtt2=$stmt2->fetch(PDO::FETCH_ASSOC);
             $img=explode("+", $stmtt2['image']);  
//echo '<tr><td style="width:50px;"><input type="checkbox" >';
             echo '<td style="width:150px;"><img width="90px" src="upload/'.$img[0].'"></td>';
                echo '<td style="width:170px;"><p>'.$stmtt2['mingcheng'].'</p></td>';
                echo '<td style="width:100px;"><p>'.$stmtt2['jiage'].'</p> </td> ';
                echo ' <td style="width:100px;"><p>'.$stmtt[$i]['shuliang'].'</p> </td>';
               echo ' <td style="width:70px;"><a href="yonghuzhongxin.php?action=pinglun&&shangpinid='.$stmtt[$i]['shangpinid'].''
                       . '&&id='.$stmtt[$i]['id'].'">评论</a></td>';
               
                
            echo '</tr>';
                     }
            ?>
            </table>
        
  
            </center>
    <?php }
    
    function pinglun(){
        $net=new net();
        $lianjie=$net->lianjie();
        $username=$_COOKIE['yonghuming'];
        $shangpinid=$_GET['shangpinid'];
        $id=$_GET['id'];
        
             echo '<form  method="post" action="yonghuzhongxin.php?action=pinglun&&shangpinid='.$shangpinid.''
                       . '&&id='.$id.'">'; ?>
                 <table>
                     <tr><td><textarea style="border:1px solid;" name="pinglun" type="text" cols="40" rows="5"></textarea></td></tr>
                     <tr><td><input type="submit" name="Submit" value="评论"></td></tr>
                 </table>
             </form>
             <?php
             if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
                 $pinglun=$_POST['pinglun'];
                 $time=date("Y-m-d H:i:s");
                 $stmt=$lianjie->prepare("INSERT INTO `pinglun`(`id`, `shangpinid`, `username`, `time`, `neirong`)"
                         . " VALUES (NULL,?,?,?,?)");
                 $stmt->bindParam(1, $shangpinid,PDO::PARAM_STR);
                 $stmt->bindParam(2, $username,PDO::PARAM_STR);
                 $stmt->bindParam(3, $time,PDO::PARAM_STR);
                 $stmt->bindParam(4, $pinglun,PDO::PARAM_STR);
                 $stmtt=$stmt->execute();
                 $select="UPDATE `dingdan` SET `pinglun`= 1 WHERE `dingdan`.`id` =".$id;
                 $stmt2=$lianjie->query($select);
                 if($stmtt){
                     ?><script language="javascript"> 
            alert("评论成功");
            window.location.href = "yonghuzhongxin.php?action=daipinglun";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("评论失败");
            window.location.href = "yonghuzhongxin.php?action=daipinglun";
             </script><?php }
                 
             }
    }
    
    
    
}