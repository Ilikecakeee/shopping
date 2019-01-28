<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'net.php';
class fenlei{
    function addfenlei(){
         $net=new net();
       $lianjie=$net->lianjie();
       ?>
<form name="tianjia" method="post" action="admin.php?action=addfenlei">
    
            <table>
                <tr><td><p>分类名称</p></td>
             <td><input name="fenlei" type="text"></td></tr>
                </table>
            
        <input style="margin-top: 20px;background-color: RGB(252,162,152);height:33px;width:100px;"type="submit" name="Submit" value="提交" ></form>
    <?php 
    if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
        $stmt=$lianjie->prepare("INSERT INTO `fenlei` (`id`,`mingcheng`) "
                . "VALUES (NULL,?)");
        
         $fenlei=$_POST['fenlei'];
            $stmt->bindParam(1,$fenlei,PDO::PARAM_STR);
             $stmtt=$stmt->execute();
            if($stmtt)
             {?>
            <script language="javascript"> 
            alert("提交成功");
            
             </script>
      <?php }
    }}
    function show(){
         $net=new net();
       $lianjie=$net->lianjie();
       ?>
       <center>
    <table border="1" align="center" width="80%" style="margin-top: 20px;">
           
            
           
            <tr >
                <th>分类名</th>
        <?php 
       
        $select="SELECT mingcheng FROM `fenlei`";
        $stmt=$lianjie->query($select);
        
        $col=0;
        while(list($mingcheng)=$stmt->fetch(PDO::FETCH_NUM)){
            if($col%2==0){
                echo '<tr bgcolor=#cccccc>';
            }
            else {echo '<tr>';}
            
            
            echo  '<td style="height:30px;"><p>'.$mingcheng.'</p></td>';
            
            echo '</tr>';
            $col++;
            
        }
            ?>
        
         </table></center>
           <?php
            
        
    
}
}

