<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';

class shoucangjia{
    function tianjia(){
        $net=new net();
        $lianjie=$net->lianjie();
        $id=$_GET['id'];
        $username=$_COOKIE['yonghuming'];
        $stmt=$lianjie->prepare("INSERT INTO `shoucangjia`(`id`, `shangpinid`, `username`) VALUES (NULL,?,?)");
        $stmt->bindParam(1, $id,PDO::PARAM_STR);
        $stmt->bindParam(2, $username,PDO::PARAM_STR);
        $stmtt=$stmt->execute();
        if($stmtt)
             { ?><script language="javascript"> 
            alert("收藏成功");
            window.location.href = "yonghuzhongxin.php?action=showshoucang";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("收藏失败");
            
             </script> <?php }
    }
    
    function show(){
        $net=new net();
        $lianjie=$net->lianjie();
       
        $username=$_COOKIE['yonghuming'];
        $select="SELECT shoucangjia.id,shoucangjia.shangpinid,shangpin.image,mingcheng "
                . "FROM shoucangjia,shangpin WHERE shoucangjia.shangpinid=shangpin.id AND shoucangjia.username='".$username."'";
        $stmt=$lianjie->query($select);
        $col=0;
        echo "<table ><tr>";
        while(list($id,$shangpinid,$image,$mingcheng)=$stmt->fetch(PDO::FETCH_NUM)){
            $col++;
            $img=explode("+", $image);
            echo '<td><a href="shangpinxiangqing.php?id='.$shangpinid.'"><img width="250px" height="230px" src="upload/'.$img[0].'"><p align="left">'.$mingcheng.'</p></a>'
                    . '<a href="yonghuzhongxin.php?action=yichushoucang&&id='.$id.'">移除</a></td>';
            if($col%3==0){
                echo '</tr><tr>';
            }
            
        }
        echo "</table>";
    }
    function yichushoucang(){
        $net=new net();
        $lianjie=$net->lianjie();
        $id=$_GET['id'];
        $select="DELETE FROM `shoucangjia` WHERE id=".$id;
        $stmt=$lianjie->query($select);?>
        <script language="javascript"> 
           window.location.href = "yonghuzhongxin.php?action=showshoucang";
             </script>
             <?php
    }
}