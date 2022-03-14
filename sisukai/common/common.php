<?php 

    //POST[]の中身をすべてエスケープ処理
    //引数 : POST[]
    //戻り値 : 処理後のPOST[]
    function sanitize($before){
        foreach($before as $key=>$value){
            $after[$key]=htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $after;
    }

    //POST[]の中身に空白があればfalseを返す
    //引数 : POST[]
    //戻り値 : bool
    function input_check_null($post){
        foreach($post as $key => $value){
            if($post[$key] === ""){
                return false;
            }
        }
        return true;
    }

    //POST[]の中身に空白があればerrorに"blank"を代入
    //引数 : POST[]
    //戻り値 : $error[]
    function input_blank($post){
        foreach($post as $key => $value){
            if($post[$key] === ""){
                $error[$key] = "blank";
            }
        }
       
        return $error;
    }

    //ログイン状況によってnav要素を変える
    //引数 : $SESSION['login']
    //戻り値 : navに表示する文字列2つ
    function nav_value_set($session_login){
        if($session_login){
            //ログイン済み value=1
            $nav_user = '<li><a href="mypage.php">マイページ</a></li>';
            $nav_login = '<li><a href="logout.php">ログアウト</a></li>';
            return array($nav_user, $nav_login);
        }else{
            //未ログイン value=0
            $nav_user = '<li><a href="regist.php">会員登録</a></li>';
            $nav_login = '<li><a href="login.php">ログイン</a></li>';
            return array($nav_user, $nav_login);
        }
    }

    //メールアドレス存在チェック
    //引数 : メールアドレス、DB情報
    //戻り値 : 結果レコード
    function exist_check_email($email, $db){
        $stmt = $db->prepare('SELECT * FROM oi31_users WHERE email = ?');
        $data[] = $email;
        $stmt->execute($data);
        $rec=$stmt->fetch();
        return $rec;
    }

    //メールアドレス存在チェック2(引数のid以外でメールアドレスが重複してないか)
    //引数 : ユーザーID、メールアドレス、DB情報
    //戻り値 : 結果レコード
    function exist_check_email_update($id, $email, $db){
        $stmt = $db->prepare('SELECT * from oi31_users WHERE id<>? AND email = ?');
        $stmt->execute(array(
            $id,
            $email,
        ));
        $rec=$stmt->fetch();
        return $rec;
    }

    //ユーザー情報取得
    //引数 : ユーザーID、DB情報
    //戻り値 : 結果レコード
    function get_record($user_id, $db){
        $stmt = $db->prepare('SELECT * FROM oi31_users WHERE id = ?');
        $data[] = $user_id;
        $stmt->execute($data);
        $rec=$stmt->fetch();
        return $rec;
    }

    //サイトのタグ情報取得
    //引数 : siteid、DB情報
    //戻り値 : 結果レコード
    function get_tags($siteid, $db){
        $sql = "SELECT tagname FROM oi31_tags ta
                INNER JOIN oi31_sitetag ca
                ON ca.tagid = ta.tagid
                WHERE ca.siteid = $siteid";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rec;
    }

    //タグの名前を取得
    //引数 : tagid、DB情報
    //戻り値 : 結果レコード
    function get_tagname($tagid, $db){
        $sql = "SELECT * FROM oi31_tags
                WHERE tagid in($tagid)";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        return $rec;
    }

    //お気に入りされてるか確認
    //引数　: siteid、userid、db情報
    //戻り値 : bool
    function get_favorite($siteid, $userid, $db){
        $sql = "SELECT count(*) as cnt FROM oi31_favorite 
                WHERE userid = $userid and siteid=$siteid ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if($rec[0] < 1){
            //var_dump($rec);
            return false;
        }else{
            //var_dump($rec);
            return true;
        }
    }





    //loginの初期値セット
    function login_set(){
        if(!isset($_SESSION['login'])){
            $_SESSION['login']=0;
        }
        
    }
    

    //会員登録の手続き以外のアクセスを飛ばす
    function access_check_regist(){
        if (!isset($_SESSION['regipost'])) {
            header('Location: regist.php');
            exit();
        }
    }

    //会員情報修正以外のアクセスを飛ばす
    function access_check_edit(){
        if (!isset($_SESSION['editpost'])) {
            header('Location: top.php');
            exit();
        }
    }

    //ログイン済みのアクセスを飛ばす
    function access_check_login(){
        if($_SESSION['login']){
            header('Location: top.php');
        }
    }
    
    //未ログインのアクセスを飛ばす
    function access_check_logout(){
        if(!$_SESSION['login']){
            header('Location: top.php');
        }
    }


    //キャンプ場html生成
    //function

?>