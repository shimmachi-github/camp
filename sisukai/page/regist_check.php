<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //会員登録ページ以外からのアクセスを飛ばす
    access_check_regist();
    
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    //POSTをエスケープ処理
    $post = sanitize($_SESSION['regipost']);

    //登録するを押すと実行
    if(!empty($_POST['check'])){
        
        //パスワードを暗号化
        $hpass = password_hash($post['pass'], PASSWORD_BCRYPT);

        //入力情報をデータベースに登録
        $statement = $db->prepare("INSERT INTO oi31_users SET name=?, email=?, password=?");
        $statement->execute(array(
            $post['name'],
            $post['email'],
            $hpass
        ));

        
        header('Location: regist_done.php'); //regist_done.phpへ移動
        exit();
    }


?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>アカウント情報確認</title>
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
                <h1>入力情報の確認</h1>
                <p>ご入力情報に変更が必要な場合、下のボタンを押し、変更を行ってください。</p>
                <p>登録情報はあとから変更することもできます。</p>
                <?php if (!empty($error) && $error === "error"): ?>
                    <p class="error">＊会員登録に失敗しました。</p>
                <?php endif ?>
                <hr>
    
                <div class="control">
                    <p>ニックネーム</p>
                    <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo $post['name']; ?></span></p>
                </div>
    
                <div class="control">
                    <p>メールアドレス</p>
                    <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo $post['email']; ?></span></p>
                </div>
            
                
                <br>
                <a href="regist.php" class="back-btn">変更する</a>
                <button type="submit" class="btn next-btn">登録する</button>
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