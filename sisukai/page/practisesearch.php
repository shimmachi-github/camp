<?php
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");

    if(!empty($_POST)){
        $item=$_POST['check'];
        //var_dump($item);
        

        $tagcnt = count($item);
        $sqlitem = implode(',', $item);

        $sql = "SELECT si.sitename, si.siteurl, si.siteaddress  FROM oi31_sitetag ca
                
                INNER JOIN oi31_campsite si
                ON ca.siteid = si.siteid
                INNER JOIN oi31_tags tg
                ON ca.tagid = tg.tagid

                WHERE ca.tagid in($sqlitem)
                GROUP BY si.siteid
                HAVING count(si.siteid) = $tagcnt";
                

        print("実行SQL > $sql");
                
        $stmt = $db->prepare($sql); 
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rec as $key => $value){
            echo '<p>' .$key. ':' .$value['sitename']. '<a href="' .$value['siteurl']. '">' .$value['siteurl']. '</a>' .$value['siteaddress']. '</p>';
        }

    }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
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
            
            <form method="POST">
                <label for="checkbox"><input type="checkbox" name="check[]" value="1">北海道</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="2">東北地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="3">関東地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="4">中部地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="5">近畿地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="6">四国地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="7">中国地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="8">九州地方</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="9">食べ物</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="10">観光地</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="11">地味</label>
                <label for="checkbox"><input type="checkbox" name="check[]" value="12">熱い</label>

                <button type="submit" class="btn">検索する</button>



            </form>
        </div>

        <footer>
            <small>(C)2021 Camp.site</small>
        </footer>
    </div>
</body>    
<!-----body終わり----->

</html>