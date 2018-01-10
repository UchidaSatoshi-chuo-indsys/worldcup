<?php

 $before_name = htmlspecialchars($_COOKIE["user_name"]);

 /***** $before_name, $before_comment の取得*****/

 $dsn = 'データベース名';//DBにMysql、データベース名を指定。

 $user = 'ユーザー名';//DBに接続するためのユーザー名を設定
 $ds_password = 'パスワード';//DBに接続するためのパスワードを設定

 $table = "jscomments";

 $edit_num = htmlspecialchars($_POST["edit_num"]);
 $edit_pass = htmlspecialchars($_POST["edit_pass"]);

 if ( (!empty($edit_num)) && (!empty($edit_pass)) ) {

          //パスワード取得

          $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

          $result = $pdo->query('SET NAMES sjis'); //文字化け対策

          $sql = "SELECT * FROM ".$table." where id=$edit_num";

          $result = $pdo->query($sql);//実行・結果取得

          foreach ($result as $row) {

                    $right_pass = htmlspecialchars($row['pass']);

          }

          if ( $edit_pass == $right_pass ) {

                    $result = $pdo->query($sql);//実行・結果取得

                    foreach ($result as $row) {

                              $before_name = htmlspecialchars($row['name']);

                              $before_comment = htmlspecialchars($row['comment']);

                    }

          }

          $pdo = null;//接続終了

 }

?>
<!DOCTYPE html>
 <html lang = "ja">

 <head>
 <meta charset = "UFT-8">
 <title>ガンバレ日本!!　2018ロシアW杯総合サイト</title>
 </head>

 <body>
 <h1>日本代表応援掲示板ページ</h1>

 <p>・<a href = "http://co-412.it.99sv-coco.com/gameresult.php">試合結果ページ</a></p>
 <p>・<a href = "http://co-412.it.99sv-coco.com/worldcup.php">W杯総合掲示板ページ</a></p>

 <table border="1" width="350" > 
 <caption>【GROUP-H】</caption>
 <th>順位</th> <th>国名</th> <th>勝点</th> <th>勝</th> <th>引</th> <th>負</th> <th>得失点</th> 
 </tr> 
 <tr> 
 <th>1</th> <th>ポーランド</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>2</th> <th>セネガル</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>3</th> <th>コロンビア</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>4</th> <th>日本</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 </table>

 <h2>コメントフォーム</h2>

 <?php 

 if (!empty($before_comment)) {

          echo "投稿番号{ <font color='red' >".htmlspecialchars($_POST['edit_num'])."</font> }を編集します"."<br>";

          echo "名前やコメントを編集した後、{<font color='red' >投稿ボタン</font>}を押してください"."<br>";

 }

 ?>

 <form action = "japan-support.php" method = "post" enctype="multipart/form-data">

 <p>名前:<input type = "text" name = "name" value = "<?=$before_name;?>" >
 パスワード:<input type = "password" name = "pass" ></p>
 <p>コメント:</p>
 <p><textarea name="comment" cols="50" rows="5"><?=$before_comment;?></textarea>
 <p>ファイル:<input type = "file" name = "upfile" ></p>

 <input type = "hidden" name = "edit_number" value = "<?=htmlspecialchars($_POST['edit_num']);?>" >

 <?php 

 if (empty($before_comment)) { echo "<input type = 'submit' name = 'submit' value ='投稿'>"; }
 
 else { echo "<input type = 'submit' name = 'again_submit' value ='投稿'>"; }

 ?>

 </p>

 </form>

 <h2>削除フォーム</h2>

 <form action = "japan-support.php" method = "post">

 <p>削除対象番号:<input type = "text" name = "delete_num" size ="5" >
 パスワード:<input type = "password" name = "delete_pass">

 <input type = "submit" name = "delete" value ="削除"></p>

 </form>

 <h2>編集フォーム</h2>

 <form action = "japan-support.php" method = "post">

 <p>編集対象番号:<input type = "text" name = "edit_num" size ="5" >
 パスワード:<input type = "password" name = "edit_pass">

 <input type = "submit" name = "edit" value ="編集"></p>

 </form>

 </body>

</html>

<?php

 $dsn = 'mysql:dbname=co_412_it_3919_com;host=localhost';//DBにMysql、データベース名を指定。

 $user = 'co-412.it.3919.com';//DBに接続するためのユーザー名を設定
 $ds_password = 'JhgVg6Cxy';//DBに接続するためのパスワードを設定

 $table = "jscomments";

 /*****テーブル"jscomments"の作成*****/

 try{

          $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

          $result = $pdo->query("SET NAMES sjis"); //文字化け対策

          //SQLコマンド「CREATE TABLE」で新規テーブル"jscomments"を作成する

          $sql = "CREATE TABLE ".$table
                ."("
                ."id INT AUTO_INCREMENT PRIMARY KEY," 
                ."name  char(32),"
                ."comment TEXT,"
                ."time DATETIME," 
                ."pass char(32),"
                ."edit_mode char(32),"
                ."ext char(10)," //画像・動画用
                ."contents blob"  //画像・動画用
                .");" ;

          $result = $pdo->query($sql);

          $pdo = null;//接続終了

 }

 //接続に失敗した際のエラー処理
 catch (PDOException $e){

          print('エラーが発生しました。:'.$e->getMessage());

          die();

 }


 /*****コメントフォームのコメント*****/

 $name = htmlspecialchars($_POST["name"]);
 $comment = htmlspecialchars($_POST["comment"]);
 $pass = htmlspecialchars($_POST["pass"]);
 $time = date("Y/m/d H:i:s");
 $file = $_FILES["upfile"];

 if(isset($_POST["submit"])){

          if(empty($name)){ echo "<font color='red' >名前がありません</font>"."<br>"; }

          if(empty($comment)) { echo "<font color='red' >コメントがありません</font>"."<br>"; }

          if(empty($pass)) { echo "<font color='red' >パスワードがありません</font>"."<br>"; }

 }


 /*****"comments"にデータを挿入*****/

 if(isset($_POST["submit"])){

          if( (!empty($name)) && (!empty($comment)) && (!empty($pass))  && (empty($file)) ) {

                    $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

                    $sql = $pdo->query('SET NAMES sjis'); //文字化け対策

                    //INSERTでデータ挿入

                    $sql = $pdo -> prepare("INSERT INTO ".$table."(name,comment,time,pass) "
                                          ."VALUES(:name, :comment, :time, :pass)");

                    $sql->bindParam(':name', $name, PDO::PARAM_STR);
                    $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $sql->bindParam(':time', $time, PDO::PARAM_STR);
                    $sql->bindParam(':pass', $pass, PDO::PARAM_STR);

                    $sql-> execute();

                    $pdo = null;//接続終了

          }

 }


/*****削除フォームのコメント*****/

 $delete_num = htmlspecialchars($_POST["delete_num"]);
 $delete_pass = htmlspecialchars($_POST["delete_pass"]);

 if(isset($_POST["delete"])){

          if (empty($delete_num)) { echo "<font color='red' >削除対象番号がありません</font>"."<br>"; }

          if (empty($delete_pass)) { echo "<font color='red' >パスワードがありません</font>"."<br>"; }

 }


 /*****削除機能*****/

 if( (isset($_POST["delete"])) && (!empty($delete_num)) ){

          //パスワード取得

          $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

          $result = $pdo->query('SET NAMES sjis'); //文字化け対策

          $sql = "SELECT * FROM ".$table." where id=$delete_num";

          $result = $pdo->query($sql);//実行・結果取得

          foreach ($result as $row) {

                    $right_pass = htmlspecialchars($row['pass']);

          }

          if ( $delete_pass==$right_pass ) {

                    echo "<br>";

                    echo "<font color='red' >本当に削除しますか？</font>"."<br>";

                    echo "<form action = 'japan-support.php' method = 'post'>";

                    echo "<input type = 'submit' name = 'yes' value ='Yes'>&nbsp&nbsp<input type = 'submit' name = 'no' value ='No'>";

                    echo "<input type = 'hidden' name = 'delete_num' value ='$delete_num'>";

                    echo "</form>";

                    echo "<br>";

          }

          else { echo "<font color='red' >パスワードが違います</font>"."<br>"; }

          $pdo = null;//接続終了

 }

 if(isset($_POST['yes'])){

          $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

          $result = $pdo->query('SET NAMES sjis'); //文字化け対策

          $sql = "delete from ".$table." where id=$delete_num";

          $result = $pdo->query($sql);//実行・結果取得

          $pdo = null;//接続終了

 }


 /*****編集フォームのコメント*****/

 $edit_num = htmlspecialchars($_POST["edit_num"]);
 $edit_pass = htmlspecialchars($_POST["edit_pass"]);

 if(isset($_POST["edit"])){

          if (empty($edit_num)) { echo "<font color='red' >編集対象番号がありません</font>"."<br>"; }

          if(empty($edit_pass)) { echo "<font color='red' >パスワードがありません</font>"."<br>"; }

          else if(empty($before_comment)) { echo "<font color='red' >パスワードが違います</font>"."<br>"; }

 }


 /*****編集機能*****/

 if(isset($_POST["again_submit"])){

          $edit_name = htmlspecialchars($_POST["name"]);
          $edit_comment = htmlspecialchars($_POST["comment"]);

          $edit_number = htmlspecialchars($_POST["edit_number"]);

          if ( (!empty($edit_name)) && (!empty($edit_comment)) ) {

                    $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

                    $result = $pdo->query('SET NAMES sjis'); //文字化け対策

                    $sql = "update ".$table." set name='$edit_name', comment='$edit_comment', time ='$time', edit_mode='(編集済み)' where id=$edit_number ";

                    $result = $pdo->query($sql);//実行・結果取得

                    $pdo = null;//接続終了

          }

 }


/*****"comments38"に画像データを挿入*****/

 if(isset($_POST["submit"])){

          if( (!empty($name)) && (!empty($comment)) && (!empty($pass)) ) {

                    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {

                              if ( move_uploaded_file($_FILES["upfile"]["tmp_name"], "./jsfiles/". $_FILES["upfile"]["name"]) ) {

                                        $file_path = "./jsfiles/". $_FILES["upfile"]["name"];
                                        $contents = file_get_contents($file_path);
                                        $ext = $_FILES["upfile"]["type"];

                                        echo $ext."A";

try{

                                        $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

                                        $sql = $pdo->query('SET NAMES sjis'); //文字化け対策

                                        //INSERTでデータ挿入

                                        $sql = $pdo -> prepare("INSERT INTO ".$table."(name, comment, time, pass, ext, contents)"
                                                              ."VALUES(:name, :comment, :time, :pass, :ext, :contents)");

                                        $sql->bindParam(':name', $name, PDO::PARAM_STR);
                                        $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
                                        $sql->bindParam(':time', $time, PDO::PARAM_STR);
                                        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);
                                        $sql->bindParam(':ext', $ext, PDO::PARAM_STR);
                                        $sql->bindParam(':contents', $file_path, PDO::PARAM_STR);

                                        $sql-> execute();

                                        $pdo = null;//接続終了

}

//接続に失敗した際のエラー処理
 catch (PDOException $e){

          print('エラーが発生しました。:'.$e->getMessage());

          die();

 }

                              } else {

                                        echo "ファイルをアップロードできません。";

                              }

                    }

          }

 }


 /*****テーブル"comments"の表示*****/

 echo "<br>";

 echo "********************コメント一覧********************"."<br>"."<br>";

 $pdo = new PDO($dsn, $user, $ds_password);//データーベースに接続

 $result = $pdo->query('SET NAMES sjis'); //文字化け対策

 $sql = "SELECT * FROM ".$table." ORDER BY id";//クエリ

 $result = $pdo->query($sql);//実行・結果取得

 foreach ($result as $row) {

          echo htmlspecialchars($row['id']).": ";
          echo htmlspecialchars($row['name']).": ";
          echo htmlspecialchars($row['time'])."; ";
          echo htmlspecialchars($row['edit_mode'])."<br>";
          echo "<font color= 'Impact' >".nl2br(htmlspecialchars($row['comment']))."</font>"."<br>"."<br>";

          $id = $row['id'];
          $contents_path = $row['contents'];

          if ( isset($row['ext']) ) {

                    //画像・動画の表示
                    echo "<img src='$contents_path' width=200>"."<br>"."<br>";//img.php?id=$id&table=$table

          }

 }

 $pdo = null;//接続終了

?>