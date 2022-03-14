<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //会員登録ページ以外からのアクセスを飛ばす
    access_check_edit();

    //セッションを破棄
    unset($_SESSION['editpost']); 
    
    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>アカウント情報変更完了</title>
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
        <div class="content">
            <h1>アカウント情報をしました。</h1>
            <br><br>
            <a href="mypage.php"><button class="btn">マイページに移動する</button></a>
        </div>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>