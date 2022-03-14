<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //loginの初期値セット
    login_set();
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);


    //-----デバッグ-----
    //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>トップページ</title>
<link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
</head>

<!-----body始まり----->
<body id="index">    
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
            <div class="topcontent">
                <h1>キャンプ場を探しましょう！</h1>
                <p class="topbtn"><a href="search.php">検索</a></p>
            </div>
        </div>
        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    

    
<!-----body終わり----->

</html>