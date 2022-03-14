<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //未ログインのアクセスを飛ばす
    access_check_logout();
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    $user_name = $_SESSION['user_name'];
    $user_email = $_SESSION['user_email'];
    $user_id = $_SESSION['user_id'];

    //var_dump($_SESSION);

            $sql = "SELECT *  FROM oi31_favorite fa
                    
                    INNER JOIN oi31_campsite si
                    ON fa.siteid = si.siteid
                    INNER JOIN oi31_users us
                    ON us.id = fa.userid

                    WHERE fa.userid = $user_id";
                                        
            $stmt = $db->prepare($sql); 
            $stmt->execute();
            $rec_search = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //取り出したキャンプ場を出力
    $searchlist = '';
    foreach($rec_search as $key => $value){
        
        //取り出したキャンプ場のタグを全て取り出す
        $rec_tags = get_tags($value['siteid'], $db);
        $taglist = "";
        foreach($rec_tags as $key => $tagvalue){
            $taglist .= '<span class="list-tag">'. $tagvalue['tagname'] .'</span>';
        }

        //お気に入り表示切り替え
        if(get_favorite($value['siteid'], $user_id, $db)){
            $favoitem = <<< EOD
            <input type="hidden" name="siteid" value="{$value['siteid']}">
            <input type="hidden" name="defavo" value="1">
            <button type="submit" class="btn defavo">お気に入り解除</button>
EOD;
        }else{
            $favoitem = <<< EOD
            <input type="hidden" name="siteid" value="{$value['siteid']}">
            <input type="hidden" name="favo" value="1">
            <button type="submit" class="btn favo">お気に入り</button>
                
EOD;
        }
       
        //HTML生成
        $searchlist .= <<< EOD
            <li class="result-list">
                <a href="{$value['siteurl']}" target="_blank">
                    <b>{$value['sitename']}</b>
                    <div class="list-img"><img src="../images/campsite.jpg"></div>
                    <span class="list-date">
                        場所 : {$value['siteaddress']}<br>
                        タグ : {$taglist}
                    </span>
                </a>
                <form action="" method="POST">
                    <div class="favo">
                        {$favoitem}
                    </div>
                 </form>
            </li>
EOD;
    }

    //お気に入り処理
    if(isset($_POST['favo']) or isset($_POST['defavo'])){
        $post = $_POST;
        if(isset($post['favo'])){
            $sql = "INSERT INTO oi31_favorite SET userid=?, siteid=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(
                $user_id,
                $post['siteid']
            ));
            header('Location: mypage.php');
        }
        if(isset($post['defavo'])){
            $sql = "DELETE FROM oi31_favorite WHERE userid=? and siteid=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(
                $user_id,
                $post['siteid']
            ));
            header('Location: mypage.php');
        }
    }
    //お気に入り処理
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>マイページ</title>
<link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
</head>

    
<!-----body始まり----->
<body id="">    
    <div class="container">
        <header>
            <div class="header-nav">
                <div class="logo">
                    <a href="top.php"><img src="../images/logo.png" alt="logo"></a>
                </div>
                <nav>
                    <ul class="global-nav">
                        <?php echo "{$nav_user}"; ?>
                        <?php echo "{$nav_login}"; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <div id="wrap">
            <div class="mypage">
                <div class="">
                    <h1>アカウント情報</h1>
                    <ul>
                        <li>ニックネーム : <?php echo "{$user_name}" ?></li>
                        <li>メールアドレス : <?php echo "{$user_email}" ?></li>
                    </ul>
                    <a href="edit.php">登録情報変更</a><br>
                    <a href="delete.php">アカウント削除</a>
                    <?php 
                        if(isset($searchlist)){
                            echo $searchlist;
                        }
                    ?>
                </div>
            </div>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>