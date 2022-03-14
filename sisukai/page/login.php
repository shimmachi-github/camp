<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    session_start();

    //ログイン済みのアクセスを飛ばす
    access_check_login();

    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    if(!empty($_POST)){
        //エスケープ処理
        $post = sanitize($_POST);

        //未入力チェック
        if(!input_check_null($post)){
            $error = input_blank($post);
        }

        if(!isset($error)){
            //メールアドレス存在チェック
            if(!$rec = exist_check_email($post['email'], $db)){
                $error['email']='none';
            }
        }

        //パスワードチェック
        if(!isset($error)){
            if(password_verify($post['pass'], $rec['password'])){
                
                $_SESSION['login']=1; //ログイン中
                $_SESSION['user_id']=$rec['id']; //テーブルのID
                $_SESSION['user_name']=$rec['name']; //ユーザーネーム
                $_SESSION['user_email']=$rec['email'];
                //$_SESSION['pageflg']=1 //ページ遷移フラグ
                header('Location: login_done.php');
                exit();
            }else{
                $error['pass']='diff';
            }
        }
    }



    //デバッグ
    //var_dump($error);
    //var_dump($post);
    //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
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
        <div class="content login">
            <form method="POST" autocomplete="off">
                <h1>ログイン</h1>
                <p>アカウント情報をご記入ください。</p>
                <br>

                <div class="control">
                    <label for="mail">メールアドレス<span class="required">必須</span></label>
                    <input id="mail" type="email" name="email" value="<?php if(!empty($post['email'])){echo $post['email'];}else{echo " ";} ?>">

                    <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                        <p class="error">＊メールアドレスを入力してください</p>

                    <?php elseif (!empty($error["email"]) && $error['email'] === 'none'): ?>
                        <p class="error">＊このメールアドレスは登録されていません</p>
                    <?php endif ?>
                </div>

                <div class="control">
                    <label for="password">パスワード<span class="required">必須</span></label>
                    <input id="password" type="password" name="pass">

                    <?php if (!empty($error["pass"]) && $error['pass'] === 'blank'): ?>
                        <p class="error">＊パスワードを入力してください</p>

                    <?php elseif (!empty($error["pass"]) && $error['pass'] === 'diff'): ?>
                        <p class="error">＊パスワードが一致しません</p>
                    <?php endif ?>
                </div>

                <div class="control">
                    <button type="submit" class="btn">ログイン</button>
                </div>
            </form>
            <h2>会員登録済がまだの方は<a href="regist.php">こちら</a></h2>
        </div>
        </div>
        
        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
    <!-----body終わり----->
    
</html>