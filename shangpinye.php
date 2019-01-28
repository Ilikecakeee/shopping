<?php 
         require_once 'function.php';
        
         require_once 'function/net.php';
         $wangye=new wangye();
         $net=new net();
         $lianjie=$net->lianjie();
         
        ?>
<html>
    <head>
        <meta charset="UTF-8">
         
        <title></title>
      
         <style type="text/css">
        <?php 
        $wangye->css();
       
        ?>
        #chazhao{
            height: 30px;
             }
             
             
             
    </style>
</head>
<body>
    <div id="suoyou">
        <?php
        // put your code here
        $wangye->biaotou();?>
        <div id="nav"></div>
        <?php if(isset($_GET['fenlei'])){
            $fenleiid=$_GET['fenlei'];
            if(isset($_GET['action'])){
                if($_GET['action']=="xiaoliang"){
                    $select="SELECT id,mingcheng,jiage,image FROM `shangpin`WHERE fashouzhuangtai=1 AND fenleiid=".$fenleiid." ORDER BY xiaoliang DESC";
                }
            }
            else{$select="SELECT id,mingcheng,jiage,image FROM `shangpin` WHERE fashouzhuangtai=1 AND fenleiid=".$fenleiid;}
        }else if(isset($_GET['search'])){
            if(isset($_GET['action'])){
                if($_GET['action']=="xiaoliang"){
                    $select="SELECT id,mingcheng,jiage,image FROM `shangpin`WHERE fashouzhuangtai=1 AND mingcheng LIKE '%".$_GET['search']."%' ORDER BY xiaoliang DESC";
                }
            }else{
            $select="SELECT id,mingcheng,jiage,image FROM `shangpin` WHERE fashouzhuangtai=1 AND mingcheng LIKE '%".$_GET['search']."%'";}
        }else{
            if(isset($_GET['action'])){
                if($_GET['action']=="xiaoliang"){
                    $select="SELECT id,mingcheng,jiage,image FROM `shangpin`WHERE fashouzhuangtai=1 ORDER BY xiaoliang DESC";
                }
            }else{
        $select="SELECT id,mingcheng,jiage,image FROM `shangpin` WHERE fashouzhuangtai=1";
            }
            }
        $stmt=$lianjie->query($select);
        
       
    
    echo '<div id="chazhao">';
    if(isset($_GET['fenlei'])){
        $fenleiid=$_GET['fenlei'];
    echo ' <a href="shangpinye.php?fenlei='.$fenleiid.'">综合|</a><a href="shangpinye.php?action=xiaoliang&&fenlei='.$fenleiid.'">销量</a> ';}
    else if(isset ($_GET['search'])){
        $search=$_GET['search'];
        echo ' <a href="shangpinye.php?search='.$search.'">综合|</a><a href="shangpinye.php?action=xiaoliang&&search='.$search.'">销量</a> ';
    }
    else{
        echo ' <a href="shangpinye.php">综合|</a><a href="shangpinye.php?action=xiaoliang">销量</a> ';
    }
            ?>
    </div>
    <div id="liulan">
        <center>
            <form>
                <table cellspacing="10">
                    <?php  //cellspacing 单元格之间的距离
                    $num=1;
                    echo "<tr>";
                    while(list($id,$mingcheng,$jiage,$image)=$stmt->fetch(PDO::FETCH_NUM)){
                        $image1=explode("+",$image);
                        
                        echo '<td style="width:300px;height:330px;"><a href="shangpinxiangqing.php?id='.$id.'"><img width=90% height=80% src="upload/'.$image1[0].'">'
                                . '<p align="center">'.$mingcheng.'<br>￥'.$jiage.'</p></a></td>';
                       
                        if($num%4==0){
                            echo '</tr><tr>';
                        } $num++;
                    }echo "</tr>";
                        ?>
                    
                    
                    
                </table>
            </form></center>
    </div>
    </div>
    
    </body>
</html>