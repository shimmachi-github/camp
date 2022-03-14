<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //未ログインからのアクセスを飛ばす
    access_check_logout();

    $_SESSION['login']=0;
    $_SESSION['user_id']="";
    $_SESSION['user_name']="";
    
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

?> 


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログアウト完了</title>
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
        <div class="logoutdone">
            <div class="content">
                <h1>ログアウトしました</h1>
                <a href="top.php"><p class="back-btn">トップへ</p></a>
            </div>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>