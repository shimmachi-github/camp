<?php 
    try{
        //dbに接続
        $dsn = 'mysql:dbname=tima_oi31;host=mysql1.php.xdomain.ne.jp';
        $user = 'tima_1';
        $password = 'password';
        $db = new PDO($dsn, $user, $password);
        //$db = new PDO('mysql:dbname=oi31;localhost;charset=utf8;', 'root', '');
    }catch(PDOException $e){
        echo "データベース接続エラー :".$e->getMessage();
    }
    
?>