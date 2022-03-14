<?php
    require_once("../common/dbconnect.php");
    require_once("../common/common.php");
    session_cache_limiter('none');
    session_start();


    //loginの初期値セット
    login_set();

    //ナビゲーションの分岐表示
    list($nav_user, $nav_login) = nav_value_set($_SESSION['login']);

    //ユーザーID取得
    if(!empty($_SESSION['login'])){
        $user_id=$_SESSION['user_id'];
    }else{
        $user_id=0;
    }

    //検索フォーム処理
    if(isset($_POST['check']) or isset($_SESSION['item'])){
        if(isset($_POST['check'])){
            //リロード時対策でsessionに保存
            $item=$_POST['check'];
            $_SESSION['item']=$item;
        }else{
            $item = $_SESSION['item'];
        }
        
        //場所・地域の---を消す
        if($item[0] == 0){
            unset($item[0]);
            $item = array_values($item);
        }

        //タグが入力されてたら処理開始
        if(!empty($item)){
            $tagcnt = count($item);
            $sqlitem = implode(',', $item);

            $sql = "SELECT *  FROM oi31_sitetag ca
                    
                    INNER JOIN oi31_campsite si
                    ON ca.siteid = si.siteid
                    INNER JOIN oi31_tags tg
                    ON ca.tagid = tg.tagid

                    WHERE ca.tagid in($sqlitem)
                    GROUP BY si.siteid
                    HAVING count(si.siteid) = $tagcnt";
                                        
            $stmt = $db->prepare($sql); 
            $stmt->execute();
            $rec_search = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //件数出力
            $searchcount = '<h1 class="count">'.count($rec_search).'件見つかりました。</h1>';

            //検索タグ出力
            $searchtag = "検索タグ<br />";
            $rec_tagname = get_tagname($sqlitem, $db);
            foreach($rec_tagname as $key => $value){
                $searchtag .= '<span class="searchtag">・'.$value.'  </span>';
            }

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
        }
    }//検索フォーム処理
    

    //検索フォーム表示
    $sql = "SELECT * FROM oi31_tags" ;
    $stmt = $db->prepare($sql); 
    $stmt->execute();
    $rec_html = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    list($tag_1, $tag_2, $tag_3, $tag_4) = 0;
    foreach($rec_html as $key => $value_select){
        $checked="";
        if($key < 48){
            if(isset($item)){
                if(in_array($key, $item)){
                    $checked="selected";
                }
            }
            $tag_1 .= '<option value="'.$key.'" '.$checked.'/>'.$value_select.'</option>';
        }else if($key < 52){
            if(isset($item)){
                if(in_array($key, $item)){
                    $checked="checked";
                }
            }
            $tag_2 .= '<label><input type="checkbox" name="check[]" value="'.$key.'" '.$checked.'/>'.$value_select.'</label>';
        }else if($key < 57){
            if(isset($item)){
                if(in_array($key, $item)){
                    $checked="checked";
                }
            }
            $tag_3 .= '<label><input type="checkbox" name="check[]" value="'.$key.'" '.$checked.'/>'.$value_select.'</label>';
        }else{
            if(isset($item)){
                if(in_array($key, $item)){
                    $checked="checked";
                }
            }
            $tag_4 .= '<label><input type="checkbox" name="check[]" value="'.$key.'" '.$checked.'/>'.$value_select.'</label>';
        }
    }//検索フォーム表示

    //お気に入り処理
    if( isset($_POST['favo']) || isset($_POST['defavo']) ){
        $post = $_POST;
        if($user_id === 0){
            header('Location: regist.php');
            exit();
        }
        if(isset($post['favo'])){
            $sql = "INSERT INTO oi31_favorite SET userid=?, siteid=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(
                $user_id,
                $post['siteid']
            ));
            header('Location: search.php');
        }
        if(isset($post['defavo'])){
            $sql = "DELETE FROM oi31_favorite WHERE userid=? and siteid=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(
                $user_id,
                $post['siteid']
            ));
            header('Location: search.php');
        }
    }
    //お気に入り処理
    
    //var_dump($_POST);
//<?php if(in_array('.$key.', '.$item.')){echo '. 'checked="checked"' .';}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="../js/script.js"></script>
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
                <div class="search-frame">
                    <ul class="result fade">
                        <?php 
                            if(isset($searchlist)){
                                echo $searchcount;
                                echo $searchtag;
                                echo $searchlist;
                            }
                        ?>

                    </ul>
                    
                    <div class="detailed">
                        <form method="POST">
                            <button type="submit" class="btn">検索</button>
                            <span class="clear"><input type="button" onclick="checkclear()" class="btn" value="クリア"></button></span>
                            <dl>
                                <dt>場所・地域</dt>
                                <dd>
                                    <select name="check[]" id="select">
                                        <option value="0">---</option>
                                        <?php echo "$tag_1"; ?>
                                    </select>
                                </dd>
                                <hr>
                                <dt>サイトタイプ</dt>
                                <p class="site">
                                    <?php echo "$tag_2"; ?>
                                </p>
                                <hr>
                                <dt>ロケーション</dt>
                                <p class="location">
                                    <?php echo "$tag_3"; ?>
                                </p>
                                <hr>
                                <dt>その他</dt>
                                <p class="other">
                                    <?php echo "$tag_4"; ?>
                                </p>
                            </dl>

                            
                        </form>
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