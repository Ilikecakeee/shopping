<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';

class guanggao{
    function addguanggao(){ ?>
       <form method="post" action=admin.php?action=addguanggao enctype="multipart/form-data">
                   <table><tr>
                           <td><input type="file" name="img"></td> </tr>
                       <tr><td><input type="url" placeholder="链接" name="url"></td></tr>
              
                       <tr><td><input type="submit" name="Submit" value="提交"></td></tr>
                  
        
       </table>
       </form>
<?php
$net=new net();
$lianjie=$net->lianjie();
if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
    $url=$_POST['url'];
    $img=upload2('img');
    
    $stmt=$lianjie->prepare("INSERT INTO `guanggao`(`id`, `img`, `url`) VALUES (NULL,?,?)");
    $stmt->bindParam(1,$img,PDO::PARAM_STR);
    $stmt->bindParam(2,$url,PDO::PARAM_STR);
   $stmtt=$stmt->execute();
   if($stmtt)
             { ?><script language="javascript"> 
            alert("提交成功");
           window.location.href = "admin.php?action=chakanguanggao";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("提交失败");
             window.location.href = "admin.php?action=chakanguanggao";
             </script> <?php }
}
    }
    function show(){
        $net=new net();
$lianjie=$net->lianjie();
        $select="SELECT * FROM `guanggao`";
        $stmt2=$lianjie->query($select);
        echo "<table width='100%'>";
        
        while(list($id,$img,$url)=$stmt2->fetch(PDO::FETCH_NUM)){
            
           echo '<tr>';
           
            echo '<td ><img width="250px" src="upload/guanggao/'.$img.'"></td>';
            echo '<td style="border-bottom: dashed 1px RGB(252,162,152);">'.$url.'</td>';
           echo '<td style="border-bottom: dashed 1px RGB(252,162,152);"><a href="admin.php?action=shanchuguanggao&&id='.$id.'">删除</a></td>';
        }
        echo "</table>";
    }
    
    function shanchu(){
        $net=new net();
       $lianjie=$net->lianjie();
        $id=$_GET['id'];
        $select2="SELECT `img` FROM `guanggao` WHERE id=".$id;
        $stmt=$lianjie->query($select2);
        $stmtt=$stmt->fetch(PDO::FETCH_NUM);
        print_r($stmtt);
        unlink('./upload/guanggao/'.$stmtt[0]);
       $select="DELETE FROM `guanggao`WHERE id=".$id;
       $stmt3=$lianjie->query($select);
      
             if($stmt3)
             { ?><script language="javascript"> 
            alert("删除成功");
            window.location.href = "admin.php?action=chakanguanggao";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("删除失败");
            window.location.href = "admin.php?action=chakanguanggao";
             </script> <?php }
             
             
        
    }
}

function upload2($myfile){
                 $allowtype=array("gif","png","jpg");
                 $size=10000000;
                 $path="./upload/guanggao";
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
?>
