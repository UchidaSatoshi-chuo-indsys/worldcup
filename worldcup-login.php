<!DOCTYPE html>
 <html lang = "ja">

 <head>
 <meta charset = "UFT-8">
 <title>ガンバレ日本!!　2018ロシアW杯総合サイト</title>
 </head>

 <body>
 <center>

 <h1>ガンバレ日本!!　2018ロシアW杯総合サイト</h1>

 <h2>ログインフォーム</h2>

 <form action = "worldcup-login.php" method = "post">

 <p>ユーザーID:<input type = "text" name = "login_id" value = "" ></p>
 <p>ユーザーネーム:<input type = "text" name = "login_name" value = "" ></p>
 <p>ユーザーパスワード:<input type = "password" name = "login_pass" ></p>

 <p><input type = "submit" name = "login" value ="ログイン"></p>

 </form>


 <h2>新規ユーザー登録フォーム</h2>

 <form action = "worldcup-login.php" method = "post">

 <p>ユーザーネーム:<input type = "text" name = "user_name" value = "" ></p>
 <p>ユーザーパスワード:<input type = "password" name = "user_pass" value = "" ></p>
 <p>メールアドレス:<input type = "text" name = "user_address" ></p>

 <p><input type = "submit" name = "entry" value ="登録"></p>

 </form>

 </center>

 </body>

</html>

<?php

 $dsn = 'データベース名';//DBにMysql、データベース名を指定。

 $user = 'ユーザー名';//DBに接続するためのユーザー名を設定
 $ds_password = 'パスワード';//DBに接続するためのパスワードを設定

 /*****テーブル作成*****/

 $table = "userinfo";

 try{

          $pdo = new PDO($dsn, $ds_user, $ds_password);//データーベースに接続

          $result = $pdo->query("SET NAMES sjis"); //文字化け対策

          //SQLコマンド「CREATE TABLE」で新規テーブル"user"を作成する

          $sql = "CREATE TABLE wcuserinfo "
                ."("
                ."No INT AUTO_INCREMENT PRIMARY KEY," 
                ."user_id char(32) ," 
                ."user_name  char(32)," 
                ."user_pass char(32),"
                ."user_address char(32),"
                ."user_entry char(32)"
                .");" ;

          $result = $pdo->query($sql);

          $pdo = null;//接続終了

 }

 //接続に失敗した際のエラー処理
 catch (PDOException $e){

          print('エラーが発生しました。:'.$e->getMessage());

          die();

 }


/*****ユーザー登録機能*****/

 $user_name = htmlspecialchars($_POST["user_name"]); 
 $user_pass = htmlspecialchars($_POST["user_pass"]);
 $user_address = htmlspecialchars($_POST["user_address"]);


 //新規ユーザー登録フォームのコメント

 if(isset($_POST["entry"])){

          if(empty($user_name)){ echo "<center><font color='red' >名前がありません</font></center>"."<br>"; }

          if(empty($user_pass)) { echo "<center><font color='red' >パスワードがありません</font></center>"."<br>"; }

          if(empty($user_address)) { echo "<center><font color='red' >メールアドレスがありません</font></center>"."<br>"; }

 }

 $user_entry = "仮登録";

 //"user"テーブルにデータを挿入
 if(isset($_POST["entry"])){

          if( (!empty($user_name)) && (!empty($user_pass)) && (!empty($user_address)) ) {

                    $user_id = uniqid("WC_");

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//データーベースに接続

                    $sql = $pdo->query("SET NAMES sjis"); //文字化け対策

                    //INSERTでデータ挿入

                    $sql = $pdo -> prepare("INSERT INTO wcuserinfo(user_id, user_name, user_pass, user_address, user_entry)" 
                                            ."VALUES(:user_id, :user_name, :user_pass, :user_address, :user_entry)");

                    $sql->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                    $sql->bindParam(':user_name', $user_name, PDO::PARAM_STR);
                    $sql->bindParam(':user_pass', $user_pass, PDO::PARAM_STR);
                    $sql->bindParam(':user_address', $user_address, PDO::PARAM_STR);
                    $sql->bindParam(':user_entry', $user_entry, PDO::PARAM_STR);
                    $sql-> execute();

                    $pdo = null;//接続終了

                    echo "<br>";


                    //保存したユーザー情報の表示

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//データーベースに接続

                    $result = $pdo->query('SET NAMES sjis'); //文字化け対策

                    $sql = "SELECT * FROM wcuserinfo order by No desc limit 1";//SELECTで一番新しいデータを選択

                    $result = $pdo->query($sql);//実行・結果取得

                    //出力

                    foreach ($result as $row) {

                              echo "<center>ユーザー登録情報</center><br>";
                              echo "<center>ユーザーID：".$row['user_id']."</center><br>";
                              echo "<center>ユーザーネーム：".$row['user_name']."</center><br>";
                              echo "<center>ユーザーパスワード：".$row['user_pass']."</center><br>";
                              echo "<center>ユーザーアドレス：".$row['user_address']."</center><br>";
                              echo "<center>登録状態：".$row['user_entry']."</center><br>";

                              $No = $row['No'];
                              $entry_id = $row['user_id'];
                              $entry_pass = $row['user_pass'];

                    }

                    $pdo = null;//接続終了

          }

 }


 /*****メール送信機能*****/

 if(isset($_POST["entry"])){

          if( (!empty($user_name)) && (!empty($user_pass)) && (!empty($user_address)) ) {

                    $mail_text = "本登録するには、以下のURLをクリックしてください。"."\n"."\n"
                                ."http://co-412.it.99sv-coco.com/worldcup-login.php"."?No=$No"."&"."entry_id=$entry_id"."\n"."\n"
                                ."あなたのユーザーID：".$entry_id."\n"
                                ."あなたのパスワード：".$entry_pass."\n";

                    if (mail("$user_address", "", "$mail_text", "")) {

                              echo "<center>".$user_address."にメールが送信されました。</center><br>";

                    } else {

                              echo "<center>メールの送信に失敗しました。</center><br>";

                    }

          }

 }


 /*****本登録*****/

 $url = $_SERVER['QUERY_STRING'];

 parse_str($url,$entry);

 $NO = $entry["No"];

 if (!empty($entry["No"]) ) {

          $pdo = new PDO($dsn, $ds_user, $ds_password);//データーベースに接続

          $sql = $pdo->query("SET NAMES sjis"); //文字化け対策

          $sql = "select * from wcuserinfo where No=$NO";

          $result = $pdo->query($sql);//実行・結果取得

          foreach ($result as $row) { $user_id=$row['user_id']; }

          if ( $entry['entry_id']==$user_id ) {

                    $sql = $pdo->query("SET NAMES sjis"); //文字化け対策

                    $sql = "update wcuserinfo set user_entry='本登録'  where No=$NO ";

                    $result = $pdo->query($sql);//実行・結果取得

          }

          $pdo = null;//接続終了

 }


 /*****ユーザーログイン機能*****/

 $login_id = htmlspecialchars($_POST["login_id"]); 
 $login_name = htmlspecialchars($_POST["login_name"]);
 $login_pass = htmlspecialchars($_POST["login_pass"]);

 //ログインフォームのコメント

 if(isset($_POST["login"])){

          if(empty($login_id)){ echo "<center><font color='red' >IDがありません</font></center>"."<br>"; }

          if(empty($login_name)) { echo "<center><font color='red' >名前がありません</font></center>"."<br>"; }

          if(empty($login_pass)) { echo "<center><font color='red' >パスワードがありません</font></center>"."<br>"; }

 }

 //ログイン機能

 if(isset($_POST["login"])){

          if( (!empty($login_id)) && (!empty($login_name)) && (!empty($login_pass)) ) {

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//データーベースに接続

                    $result = $pdo->query('SET NAMES sjis'); //文字化け対策

                    $sql = "SELECT * FROM wcuserinfo where user_id='$login_id' ";//SELECTでデータを選択

                    $result = $pdo->query($sql);//実行・結果取得

                    foreach ($result as $row) { //パスワード取得

                              $user_id = $row['user_id'];

                              $right_pass = $row['user_pass']; 

                              $user_entry = $row['user_entry'];

                    } 

                    if ( ($right_pass==$login_pass) ) {

                              if ($user_entry=="本登録" ) {

                                        setcookie("user_name",$login_name);

                                        header("Location:http://co-412.it.99sv-coco.com/gameresult.php");

                              }

                              else { echo "<center><font color='red' >".$user_entry."なので、ログインできません。</font></center>"."<br>"; }

                    }

                    else { echo "<center><font color='red' >パスワードが違います。</font></center>"."<br>"; }

                    $pdo = null;//接続終了

          }

 }

?>