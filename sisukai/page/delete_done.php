<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    

    //セッションを破棄
    //未ログインに
    $_SESSION = array();
    $_SESSION['login'] = 0;
    //var_dump($_SESSION);
    
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>アカウント削除完了</title>
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
            <h1>アカウントを削除しました。</h1>
            <br><br>
            <a href="top.php"><button class="btn">トップページ</button></a>
        </div>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>