<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';
class shangpin{
    function addshangpin(){
         $net=new net();
       $lianjie=$net->lianjie();
       
        ?>
<form name="tianjia" method="post" action="admin.php?action=addshangpin" enctype="multipart/form-data">
    
            <table>
                <tr><td><p>商品名称：</p></td>
             <td><input name="mingcheng" type="text"></td></tr>
                
              <tr><td><p>商品介绍：</p></td>
             <td><textarea style="border:1px solid;" name="jieshao" type="text" cols="40" rows="5"></textarea></td></tr>
             
              <tr><td><p>商品价格：</p></td>
             <td><input name="jiage" type="number" step="0.01"></td></tr>
              <tr><td><p>商品分类：</p></td>
                  <td><select name="leibie">
                           <?php    
                            $select="SELECT * FROM `fenlei`";
        
                           $stmt2=$lianjie->query($select);
                           while(list($fid,$mingcheng)=$stmt2->fetch(PDO::FETCH_NUM)){
                               echo "<option value=".$fid.">".$mingcheng."</option>";
                           }
                                   
                                   ?>
                       </select></td></tr>
               <tr><td><p>商品图片：</p></td>
             <td><input type="file" name="tupian[]" multiple="multiple" /></td></tr>
                <tr><td><p>详细介绍：</p></td>
             <td><input type="file" name="xiangxi[]" multiple="multiple" /></td></tr>
               <tr><td><p>库存：</p></td>
             <td><input name="kucun" type="number" ></td></tr>
                </table>
            
        <input type="submit" name="Submit" value="提交"></form>
    <?php 
    if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
        
        $stmt=$lianjie->prepare("INSERT INTO `shangpin` (`id`, `mingcheng`, `jieshao`, `xiaoliang`, `jiage`, `image`,"
                . "`jieshaoimg`,`fenleiid`,`kucun`,`fashouzhuangtai`) "
                . "VALUES (NULL,?,?,?,?, ?,?,?,?,?)");
        
              $mingcheng=$_POST['mingcheng'];
              $jieshao=$_POST['jieshao'];
              $xiaoliang=0;
              $jiage=$_POST['jiage'];
              $image= upload('tupian');
              $jieshaoimage= upload('xiangxi');
              $leibie=$_POST['leibie'];
              $kucun=$_POST['kucun'];
              $fashouzhuangtai=0;    
             $stmt->bindParam(1,$mingcheng,PDO::PARAM_STR);
             $stmt->bindParam(2,$jieshao,PDO::PARAM_STR);
             $stmt->bindParam(3,$xiaoliang,PDO::PARAM_STR);
             $stmt->bindParam(4,$jiage,PDO::PARAM_STR);
            $stmt->bindParam(5,$image,PDO::PARAM_STR);  
            $stmt->bindParam(6,$jieshaoimage,PDO::PARAM_STR);
            $stmt->bindParam(7,$leibie,PDO::PARAM_STR);
            $stmt->bindParam(8,$kucun,PDO::PARAM_STR);
            $stmt->bindParam(9, $fashouzhuangtai, PDO::PARAM_STR);
             $stmtt=$stmt->execute();
             if($stmtt)
             { ?><script language="javascript"> 
            alert("提交成功");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("提交失败");
             window.location.href = "admin.php?action=addshangpin";
             </script> <?php }
             
             
        }
    }
    function show(){
         $net=new net();
       $lianjie=$net->lianjie();
        $select="SELECT * FROM `shangpin`,`fenlei` WHERE shangpin.fenleiid=fenlei.id";
        $stmt=$lianjie->query($select);
        $col=0;
        echo "<table>";
        echo "<th>名称</th><th>介绍</th><th>销量</th><th>价格</th><th>图</th><th>分类</th><th>库存</th><th>发售状态</th><th></th><th></th>";
        while(list($id,$mingcheng,$jieshao,$xiaoliang,$jiage,$image,$jiehaoimg,$fenleiid,$kucun,$fashouzhuangtai,$idd,$mingcheng2)=$stmt->fetch(PDO::FETCH_NUM)){
            if($col%2==0){
                echo '<tr bgcolor=#cccccc>';
            }
            else {echo '<tr>';}
            $img=explode("+",$image);
            
            echo '<td><a href="shangpinxiangqing.php?id='.$id.'">'.$mingcheng.'</a></td>';
            echo '<td>'.$jieshao.'</td>';
            echo '<td>'.$xiaoliang.'</td>';
            echo '<td>'.$jiage.'</td>';
            echo '<td><img width="50px" src="upload/'.$img[0].'"></td>';
            echo '<td>'.$mingcheng2.'</td>';
            echo '<td>'.$kucun.'</td>';
            echo '<td>'.fashouzhuangtai($fashouzhuangtai).'</td>';
            echo '<td><a href="admin.php?action=xiugaizhuangtai&&id='.$id.'&&fashou='.$fashouzhuangtai.'">'.fashou($fashouzhuangtai).'</a></td>';
            echo '<td><a href="admin.php?action=xiugaishangpin&&id='.$id.'">修改</a></td>';       
            echo '</tr>';
            $col++;
        }
        echo "</table>";
    }
    
    function fashouu(){
         $net=new net();
       $lianjie=$net->lianjie();
        $id=$_GET['id'];
        $fashouzhuangtai=$_GET['fashou'];
        if($fashouzhuangtai==0){
            $stmt=$lianjie->prepare("UPDATE `shangpin` SET `fashouzhuangtai` = '1' WHERE `shangpin`.`id` = ?");
        }else{
             $stmt=$lianjie->prepare("UPDATE `shangpin` SET `fashouzhuangtai` = '0' WHERE `shangpin`.`id` = ?");
        }
        $stmt->bindParam(1, $id,PDO::PARAM_STR);
        $stmtt=$stmt->execute();
        if($stmtt)
             { ?><script language="javascript"> 
            alert("操作成功");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("操作失败");
            window.location.href = "admin.php?action=showshangpin";
             </script><?php }

    }
    function xiugai(){
         $net=new net();
       $lianjie=$net->lianjie();
        $id=$_GET['id'];
        $select="SELECT * FROM `shangpin` WHERE id=".$id;
        $stmt=$lianjie->query($select);
        $stmtt=$stmt->fetch(PDO::FETCH_ASSOC);
       echo ' <form name="xiugai" method="post" action="admin.php?action=xiugaishangpin&&id='.$id.'" >
    
            <table>
            <tr><td><a href="admin.php?action=shanchushangpin&&id='.$id.'">删除</a></td></tr>
                <tr><td><p>商品名称：</p></td>
             <td><input name="mingcheng" type="text" value='.$stmtt['mingcheng'].'></td></tr>
                
              <tr><td><p>商品介绍：</p></td>
             <td><textarea style="border:1px solid;" name="jieshao" type="text" cols="40" rows="5">'.$stmtt['jieshao'].'</textarea></td></tr>
             
              <tr><td><p>商品价格：</p></td>
             <td><input name="jiage" type="number" step="0.01" value='.$stmtt['jiage'].'></td></tr>
              <tr><td><p>商品分类：</p></td>
                  <td><select name="leibie">';
                              
                            $select2="SELECT * FROM `fenlei`";
        
                           $stmt2=$lianjie->query($select2);
                           while(list($fid,$mingcheng)=$stmt2->fetch(PDO::FETCH_NUM)){
                               echo "<option value=".$fid.">".$mingcheng."</option>";
                           }
                                   
                                   
                      echo' </select></td></tr>
              
               <tr><td><p>库存：</p></td>
             <td><input name="kucun" type="number" value='.$stmtt['kucun'].'></td></tr>
                </table>
            
        <input type="submit" name="Submit" value="提交"></form>';
        if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
        
        $stmt2=$lianjie->prepare("UPDATE `shangpin` SET `mingcheng`=?,`jieshao`=?,`jiage`=?,`fenleiid`=?,`kucun`=? WHERE `id`=?");
        
              $mingcheng=$_POST['mingcheng'];
              $jieshao=$_POST['jieshao'];
              
              $jiage=$_POST['jiage'];
              
              $leibie=$_POST['leibie'];
              $kucun=$_POST['kucun'];
                 
             $stmt2->bindParam(1,$mingcheng,PDO::PARAM_STR);
             $stmt2->bindParam(2,$jieshao,PDO::PARAM_STR);
            
             $stmt2->bindParam(3,$jiage,PDO::PARAM_STR);
           
            $stmt2->bindParam(4,$leibie,PDO::PARAM_STR);
            $stmt2->bindParam(5,$kucun,PDO::PARAM_STR);
           $stmt2->bindParam(6,$id,PDO::PARAM_STR);
             $stmtt2=$stmt2->execute();
             if($stmtt2)
             { ?><script language="javascript"> 
            alert("提交成功");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("提交失败");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
             
             
        }
    }
    
    function shanchu(){
         $net=new net();
       $lianjie=$net->lianjie();
       $id=$_GET['id'];
       $select2="SELECT `image`, `jieshaoimg` FROM `shangpin` WHERE id=".$id;
       $stmt2=$lianjie->query($select2);
       $stmtt2=$stmt2->fetch(PDO::FETCH_ASSOC);
       $image= explode("+", $stmtt2['image']);
       $jieshaoimg= explode("+", $stmtt2['jieshaoimg']);
       for($i=0;$i<count($image);$i++){
           deletefile($image[$i]);
       }
       for($i=0;$i<count($jieshaoimg);$i++){
           deletefile($jieshaoimg[$i]);
       }
        
        $select="DELETE FROM `shangpin` WHERE id=".$id;
        $stmtt3=$stmt3=$lianjie->query($select);
        if($stmtt3)
             { ?><script language="javascript"> 
            alert("删除成功");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("删除失败");
            window.location.href = "admin.php?action=showshangpin";
             </script> <?php }
        
    }
    
    
}
function fashouzhuangtai($fashouzhuangtai){
    if($fashouzhuangtai==0){
        return "待发售";
    }else{
        return "已发售";
    }
}
function fashou($fashouzhuangtai){
    if($fashouzhuangtai==0){
        return "发售";
    }else{
        return "停售";
    }
}
 function deletefile($filename){
                 $path="./upload";
                 unlink($path.'/'.$filename);
             }
             
             function upload($myfile){
                 $filename1="";
                 $count1=count($_FILES[$myfile]['name']);
                 
                 for($i=0; $i<$count1; $i++)
                 {
                 
                
                $allowtype=array("gif","png","jpg");
                 $size=10000000;
                 $path="./upload";
                 if($_FILES[$myfile]['error'][$i]>0){
                     echo "上传错误";
                 
                  switch($_FILES[$myfile]['error'][$i]){
                     case 1: die('上传文件大小超出了PHP配置文件中的约定值： upload_max_filesize');
                     case 2: die('上传文件大小超出了表单中的约定值');
                     case 3: die('文件只被部分上载');
                     case 4: die('没有上传任何文件');
                     default :die('未知错误');
                     
                 }
                 
                 }
                 $hzz=explode(".", $_FILES[$myfile]['name'][$i]);
                 $hz= array_pop($hzz);
                 
                 if(!in_array($hz, $allowtype)){
                     die("这个后缀是<b>{$hz}</b>,不是允许的文件类型！");
                 }
                 if($_FILES[$myfile]['size'][$i]>$size){
                     die("超过了允许的<b>{$size}</b>字节大小");
                 }
                 //为了系统安全，也为了同名文件不会被覆盖，上传后将文件名使用系统定义
                 $filename=date("YmdHis").rand(100,999).".".$hz;
                 if($i==0){
                     $filename1=$filename;
                 }else{
                     $filename1=$filename1."+".$filename;
                 }
                 if(is_uploaded_file($_FILES[$myfile]['tmp_name'][$i])){
                     if(!move_uploaded_file($_FILES[$myfile]['tmp_name'][$i], $path.'/'.$filename)){
                         die ('问题：不能将文件移动到指定目录。');
                     }
                 }else{
                     die("问题：上传的文件不是一个合法文件");
                 }
                 }
                
                 return $filename1;
                 
             }

