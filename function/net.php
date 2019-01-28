<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 
 * 
 */
class net{
    function lianjie(){
        $host="127.0.0.1";
        $userName="root";
        $password="";
        $dsn='mysql:dbname=shop;host=127.0.0.1';
        
         try {
            $dbh=new PDO($dsn,$userName,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
            
        } catch (Exception $ex) {
            echo '数据连接失败！';
        }
        return $dbh;
    }
}
