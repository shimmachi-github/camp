<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();
    
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    //削除するを押すと実行
    if(!empty($_POST['check'])){
        
        //削除開始
        $_SESSION['delepost']=1;
        
        //データベースから削除
        $statement = $db->prepare("DELETE FROM oi31_users WHERE id=?");
        $statement->execute(array(
            $_SESSION['user_id']
        ));

        header('Location: delete_done.php'); //delete_done.phpへ移動
        exit();
    }


?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>アカウント削除</title>
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
        <div id="">
            <div class="content">
            <form action="" method="POST">
                <input type="hidden" name="check" value="checked">
                <h1>アカウントを削除しますか？</h1>
                <p>アカウントを削除しない場合キャンセルボタンを押してください</p>
    
                <div class="control">
                    <p>ニックネーム</p>
                    <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo $_SESSION['user_name']; ?></span></p>
                </div>
    
                <div class="control">
                    <p>メールアドレス</p>
                    <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo $_SESSION['user_email']; ?></span></p>
                </div>
            
                
                <br>
                <a href="mypage.php" class="back-btn">キャンセル</a>
                <button type="submit" class="btn next-btn deletebtn">削除する</button>
                <div class="clear"></div>
            </form>
        </div>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>