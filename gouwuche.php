<?php 
         require_once 'function.php';
         require_once 'function/net.php';
         $wangye=new wangye();
         $net=new net();
         $lianjie=$net->lianjie();
         if(isset($_GET['action'])){
             if($_GET['action']=='yichu'){
                 yichu();
             }
         }
        ?>
<html>
    <head>
        <meta charset="UTF-8">
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <script type="text/javascript" src="scripts/num-alignment.js"></script>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
        <title></title>
      
         <style type="text/css">
        <?php 
        $wangye->css();
       
        ?>
       
        td{
            border-bottom: dashed 1px RGB(252,162,152);
            height:100px;
        }
    </style>
</head>
<body>
    <div id="suoyou">
       
        
        <?php
        // put your code here
        $wangye->biaotou(); ?>
         <div id="nav"></div>
    <div id="shangpin">
       <?php  $select="SELECT * FROM `gouwuche` WHERE `username`='".$_COOKIE['yonghuming']."'" ;
        $stmt=$lianjie->query($select);
        
        $zongjia=0;
       
        echo '<form method="post" action="gouwuche.php">
         <center>       
        <table >';
         while(list($id,$username,$shangpinid,$shuliang)=$stmt->fetch(PDO::FETCH_NUM)){
           
             $select2="SELECT mingcheng,jiage,image FROM `shangpin` WHERE id=".$shangpinid;
             $stmt2=$lianjie->query($select2);
             $stmtt2=$stmt2->fetch(PDO::FETCH_ASSOC);
             $img=explode("+", $stmtt2['image']);
                     //echo '<tr><td style="width:50px;"><input type="checkbox" >';
             echo '</td><td style="width:200px;"><img width="90px" src="upload/'.$img[0].'"></td>';
                echo '<td style="width:250px;"><p>'.$stmtt2['mingcheng'].'</p></td>';
                echo '<td style="width:150px;"><p>'.$stmtt2['jiage'].'</p> </td> ';
                echo ' <td style="width:150px;"><p>'.$shuliang.'</p> </td>';
                echo '<td style="width:130px;"><a href="gouwuche.php?action=yichu&&id='.$id.'">移除</a></td>';
                
            echo '</tr>';
                $zongjia+=$shuliang*$stmtt2['jiage'];
         }
        
         
        ?>
    
            
            
           
        </table>
        <?php echo '<p align="right">总金额：￥'.$zongjia.'</p>'; ?>
           <input style="width:100px;height:30px;float: right;margin-top:50px;background-color:RGB(252,162,152);" name="Submit" type="submit" value="结算">
    </form>
            </center>
    <hr>
    
    </div>
         
    </div>
    
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
    <?php 
    if(isset($_POST['Submit'])&&$_POST['Submit']!==""){
        $net=new net();
         $lianjie=$net->lianjie();
         $yonghuming=$_COOKIE['yonghuming'];
         $select3="SELECT * FROM `gouwuche` WHERE username='".$yonghuming."'";
        $stmt4=$lianjie->query($select3);
        $str="QWERTYUIOPASDFGHJKLZXCVBNM123456789qwertyuiopasdfghjklzxcvbnm";
        $str= substr(str_shuffle($str),26,10);
        
        while($stmtt4=$stmt4->fetch(PDO::FETCH_ASSOC)){
            
           $shangpinid=$stmtt4['shangpinid'];
         $shuliang=$stmtt4['shuliang'];
         $pinglunzhuangtai=0;
         
         $stmt3=$lianjie->prepare("INSERT INTO `dingdan`(`id`, `username`, `shangpinid`, `shuliang`, `pinglun`,`dingdanhao`) VALUES (NULL,?,?,?,?,?)");
         $stmt3->bindParam(1, $yonghuming,PDO::PARAM_STR);
         $stmt3->bindParam(2, $shangpinid,PDO::PARAM_STR);
         $stmt3->bindParam(3, $shuliang,PDO::PARAM_STR);
         $stmt3->bindParam(4, $pinglunzhuangtai,PDO::PARAM_STR);
         $stmt3->bindParam(5, $str,PDO::PARAM_STR);
         $stmtt3=$stmt3->execute();
         $select4="DELETE FROM `gouwuche` WHERE id=".$stmtt4['id'];
         $stmt5=$lianjie->query($select4);
         $select5="SELECT `xiaoliang`,`kucun` FROM `shangpin` WHERE id=".$shangpinid;
         $stmt8=$lianjie->query($select5);
         $stmtt8=$stmt8->fetch(PDO::FETCH_NUM);
         $xiaoliang=$stmtt8[0];
         $kucun=$stmtt8[1];
        $xiaoliang+=$shuliang;
        $kucun-=$shuliang;
        
         $stmt7=$lianjie->prepare("UPDATE `shangpin` SET `xiaoliang`=?,`kucun`=? WHERE id=?");
         $stmt7->bindParam(1,$xiaoliang,PDO::PARAM_STR);
          $stmt7->bindParam(2,$kucun,PDO::PARAM_STR);
         $stmt7->bindParam(3,$shangpinid,PDO::PARAM_STR);
         $stmtt7=$stmt7->execute();
                 
        }
        $fahuozhuangtai=0;
        $shouhuozhuangtai=0;
        //$datetime=new DateTime();
        //$datetimee=$datetime->format('Y-m-d H:i:s');
        $datetimee=date("Y-m-d H:i:s");
        $stmt6=$lianjie->prepare("INSERT INTO `dadingdan`(`id`, `fahuozhuangtai`, `shouhuozhuangtai`, `username`, "
                . "`time`) VALUES (?,?,?,?,?)");
        $stmt6->bindParam(1, $str,PDO::PARAM_STR);
        $stmt6->bindParam(2, $fahuozhuangtai,PDO::PARAM_STR);
        $stmt6->bindParam(3, $shouhuozhuangtai,PDO::PARAM_STR);
        $stmt6->bindParam(4, $yonghuming,PDO::PARAM_STR);
        $stmt6->bindParam(5, $datetimee,PDO::PARAM_STR);
        $stmtt6=$stmt6->execute();
        
        if(/*$stmtt3&&$stmt5&&$stmtt6&&*/$stmtt7)
             { ?><script language="javascript"> 
            alert("提交成功");
             window.location.href = "gouwuche.php";
          </script> <?php }
             else {?><script language="javascript"> 
            alert("提交失败");
           </script> <?php }
         
         
    }
    function yichu(){
        $id=$_GET['id'];
         $net=new net();
         $lianjie=$net->lianjie();
        $stmt3=$lianjie->prepare("DELETE FROM `gouwuche` WHERE id=?");
        $stmt3->bindParam(1, $id,PDO::PARAM_STR);
        $stmtt3=$stmt3->execute();
        if($stmtt3){
            ?><script language="javascript"> 
            alert("移除成功");
            window.location.href = "gouwuche.php";
             </script> <?php }
             else {?><script language="javascript"> 
            alert("移除失败");
            window.location.href = "gouwuche.php";
             </script> <?php 
        }
    }
    ?>
    </body>
</html>