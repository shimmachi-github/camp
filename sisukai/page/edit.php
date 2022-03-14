<?php 
    require_once("../common/dbconnect.php");
    require_once("../common/common.php");
    session_start();

    //loginがnullなら0をセット
    login_set();

    //未ログインのアクセスを飛ばす
    access_check_logout();

    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    //フォーム送信されると実行
    if (!empty($_POST)) {
        //エスケープ処理
        $post = sanitize($_POST);

        //未入力チェック
        if(!input_check_null($post)){
            $error = input_blank($post);
        }
        

        //パスワードが同じかチェック
        if(!isset($error)){
            if($post['pass'] !== $post['pass2']){
                $error['pass2'] = 'notsame'; //パスワードが合わない
            }
        }
        
        //メールアドレスの重複を検知
        if(!isset($error)){
            if(exist_check_email_update($_SESSION['user_id'], $post['email'], $db)){
                $error['email'] = 'duplicate'; //メールアドレスが既に存在
            }
        }

        

        /* エラーがなければ次のページへ */
        if (!isset($error)) {
            $_SESSION['editpost'] = $post;   // フォームの内容をセッションで保存
            header('Location: edit_check.php');   // check.phpへ移動
            exit();
        }


        
        //-----デバッグ-----
        //var_dump($error);
        //var_dump($post);

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>アカウント作成</title>
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

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
                <div class="regist-frame">
                        <div class="content">
                            <form action="" method="POST">
                                <h1>アカウント情報修正</h1>
                                <p>修正したい箇所を変更してください</p>
                                <br>

                                <div class="control">
                                    <label for="name">ユーザー名<span class="required">必須</span></label>
                                    <input id="name" type="text" name="name" value="<?php if(!empty($post['name'])){echo $post['name'];}else{echo $_SESSION['user_name'];}?>">

                                    <?php if (!empty($error["name"]) && $error['name'] === 'blank'): ?>
                                        <p class="error">＊ユーザー名を入力してください</p>
                                    <?php endif ?>
                                </div>


                                <div class="control">
                                    <label for="email">メールアドレス<span class="required">必須</span></label>
                                    <input id="email" type="email" name="email" value="<?php if(!empty($post['email'])){echo $post['email'];}else{echo $_SESSION['user_email'];} ?>">

                                    <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                                        <p class="error">＊メールアドレスを入力してください</p>

                                    <?php elseif (!empty($error["email"]) && $error['email'] === 'duplicate'): ?>
                                        <p class="error">＊このメールアドレスはすでに使用されています</p>
                                    <?php endif ?>
                                </div>


                                <div class="control">
                                    <label for="pass">パスワード<span class="required">必須</span></label>
                                    <input id="pass" type="password" name="pass">

                                    <?php if (!empty($error["pass"]) && $error['pass'] === 'blank'): ?>
                                        <p class="error">＊パスワードを入力してください</p>
                                    <?php endif ?>
                                </div>


                                <div class="control">
                                    <label for="pass">パスワード再入力<span class="required">必須</span></label>
                                    <input id="pass" type="password" name="pass2">

                                    <?php if (!empty($error["pass2"]) && $error['pass2'] === 'blank'): ?>
                                        <p class="error">＊パスワードを再入力してください</p>

                                    <?php elseif (!empty($error["pass2"]) && $error['pass2'] == 'notsame'): ?>
                                        <p class="error">＊パスワードが一致しません</p>
                                    <?php endif ?>
                                </div>


                                <div class="control">
                                    <button type="submit" class="btn">確認する</button>
                                </div>
                            </form>
                    </div>
                </div>        
            </div>
            <footer>
            <small>(C)2021 Camp.site</small>
            </footer>
    </div>
</body>
</html>