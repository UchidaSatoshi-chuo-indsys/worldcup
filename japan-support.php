<?php

 $before_name = htmlspecialchars($_COOKIE["user_name"]);

 /***** $before_name, $before_comment �̎擾*****/

 $dsn = '�f�[�^�x�[�X��';//DB��Mysql�A�f�[�^�x�[�X�����w��B

 $user = '���[�U�[��';//DB�ɐڑ����邽�߂̃��[�U�[����ݒ�
 $ds_password = '�p�X���[�h';//DB�ɐڑ����邽�߂̃p�X���[�h��ݒ�

 $table = "jscomments";

 $edit_num = htmlspecialchars($_POST["edit_num"]);
 $edit_pass = htmlspecialchars($_POST["edit_pass"]);

 if ( (!empty($edit_num)) && (!empty($edit_pass)) ) {

          //�p�X���[�h�擾

          $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $result = $pdo->query('SET NAMES sjis'); //���������΍�

          $sql = "SELECT * FROM ".$table." where id=$edit_num";

          $result = $pdo->query($sql);//���s�E���ʎ擾

          foreach ($result as $row) {

                    $right_pass = htmlspecialchars($row['pass']);

          }

          if ( $edit_pass == $right_pass ) {

                    $result = $pdo->query($sql);//���s�E���ʎ擾

                    foreach ($result as $row) {

                              $before_name = htmlspecialchars($row['name']);

                              $before_comment = htmlspecialchars($row['comment']);

                    }

          }

          $pdo = null;//�ڑ��I��

 }

?>
<!DOCTYPE html>
 <html lang = "ja">

 <head>
 <meta charset = "UFT-8">
 <title>�K���o�����{!!�@2018���V�AW�t�����T�C�g</title>
 </head>

 <body>
 <h1>���{��\�����f���y�[�W</h1>

 <p>�E<a href = "http://co-412.it.99sv-coco.com/gameresult.php">�������ʃy�[�W</a></p>
 <p>�E<a href = "http://co-412.it.99sv-coco.com/worldcup.php">W�t�����f���y�[�W</a></p>

 <table border="1" width="350" > 
 <caption>�yGROUP-H�z</caption>
 <th>����</th> <th>����</th> <th>���_</th> <th>��</th> <th>��</th> <th>��</th> <th>�����_</th> 
 </tr> 
 <tr> 
 <th>1</th> <th>�|�[�����h</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>2</th> <th>�Z�l�K��</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>3</th> <th>�R�����r�A</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 <tr> 
 <th>4</th> <th>���{</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> <th>0</th> 
 </tr>
 </table>

 <h2>�R�����g�t�H�[��</h2>

 <?php 

 if (!empty($before_comment)) {

          echo "���e�ԍ�{ <font color='red' >".htmlspecialchars($_POST['edit_num'])."</font> }��ҏW���܂�"."<br>";

          echo "���O��R�����g��ҏW������A{<font color='red' >���e�{�^��</font>}�������Ă�������"."<br>";

 }

 ?>

 <form action = "japan-support.php" method = "post" enctype="multipart/form-data">

 <p>���O:<input type = "text" name = "name" value = "<?=$before_name;?>" >
 �p�X���[�h:<input type = "password" name = "pass" ></p>
 <p>�R�����g:</p>
 <p><textarea name="comment" cols="50" rows="5"><?=$before_comment;?></textarea>
 <p>�t�@�C��:<input type = "file" name = "upfile" ></p>

 <input type = "hidden" name = "edit_number" value = "<?=htmlspecialchars($_POST['edit_num']);?>" >

 <?php 

 if (empty($before_comment)) { echo "<input type = 'submit' name = 'submit' value ='���e'>"; }
 
 else { echo "<input type = 'submit' name = 'again_submit' value ='���e'>"; }

 ?>

 </p>

 </form>

 <h2>�폜�t�H�[��</h2>

 <form action = "japan-support.php" method = "post">

 <p>�폜�Ώ۔ԍ�:<input type = "text" name = "delete_num" size ="5" >
 �p�X���[�h:<input type = "password" name = "delete_pass">

 <input type = "submit" name = "delete" value ="�폜"></p>

 </form>

 <h2>�ҏW�t�H�[��</h2>

 <form action = "japan-support.php" method = "post">

 <p>�ҏW�Ώ۔ԍ�:<input type = "text" name = "edit_num" size ="5" >
 �p�X���[�h:<input type = "password" name = "edit_pass">

 <input type = "submit" name = "edit" value ="�ҏW"></p>

 </form>

 </body>

</html>

<?php

 $dsn = 'mysql:dbname=co_412_it_3919_com;host=localhost';//DB��Mysql�A�f�[�^�x�[�X�����w��B

 $user = 'co-412.it.3919.com';//DB�ɐڑ����邽�߂̃��[�U�[����ݒ�
 $ds_password = 'JhgVg6Cxy';//DB�ɐڑ����邽�߂̃p�X���[�h��ݒ�

 $table = "jscomments";

 /*****�e�[�u��"jscomments"�̍쐬*****/

 try{

          $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $result = $pdo->query("SET NAMES sjis"); //���������΍�

          //SQL�R�}���h�uCREATE TABLE�v�ŐV�K�e�[�u��"jscomments"���쐬����

          $sql = "CREATE TABLE ".$table
                ."("
                ."id INT AUTO_INCREMENT PRIMARY KEY," 
                ."name  char(32),"
                ."comment TEXT,"
                ."time DATETIME," 
                ."pass char(32),"
                ."edit_mode char(32),"
                ."ext char(10)," //�摜�E����p
                ."contents blob"  //�摜�E����p
                .");" ;

          $result = $pdo->query($sql);

          $pdo = null;//�ڑ��I��

 }

 //�ڑ��Ɏ��s�����ۂ̃G���[����
 catch (PDOException $e){

          print('�G���[���������܂����B:'.$e->getMessage());

          die();

 }


 /*****�R�����g�t�H�[���̃R�����g*****/

 $name = htmlspecialchars($_POST["name"]);
 $comment = htmlspecialchars($_POST["comment"]);
 $pass = htmlspecialchars($_POST["pass"]);
 $time = date("Y/m/d H:i:s");
 $file = $_FILES["upfile"];

 if(isset($_POST["submit"])){

          if(empty($name)){ echo "<font color='red' >���O������܂���</font>"."<br>"; }

          if(empty($comment)) { echo "<font color='red' >�R�����g������܂���</font>"."<br>"; }

          if(empty($pass)) { echo "<font color='red' >�p�X���[�h������܂���</font>"."<br>"; }

 }


 /*****"comments"�Ƀf�[�^��}��*****/

 if(isset($_POST["submit"])){

          if( (!empty($name)) && (!empty($comment)) && (!empty($pass))  && (empty($file)) ) {

                    $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                    $sql = $pdo->query('SET NAMES sjis'); //���������΍�

                    //INSERT�Ńf�[�^�}��

                    $sql = $pdo -> prepare("INSERT INTO ".$table."(name,comment,time,pass) "
                                          ."VALUES(:name, :comment, :time, :pass)");

                    $sql->bindParam(':name', $name, PDO::PARAM_STR);
                    $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $sql->bindParam(':time', $time, PDO::PARAM_STR);
                    $sql->bindParam(':pass', $pass, PDO::PARAM_STR);

                    $sql-> execute();

                    $pdo = null;//�ڑ��I��

          }

 }


/*****�폜�t�H�[���̃R�����g*****/

 $delete_num = htmlspecialchars($_POST["delete_num"]);
 $delete_pass = htmlspecialchars($_POST["delete_pass"]);

 if(isset($_POST["delete"])){

          if (empty($delete_num)) { echo "<font color='red' >�폜�Ώ۔ԍ�������܂���</font>"."<br>"; }

          if (empty($delete_pass)) { echo "<font color='red' >�p�X���[�h������܂���</font>"."<br>"; }

 }


 /*****�폜�@�\*****/

 if( (isset($_POST["delete"])) && (!empty($delete_num)) ){

          //�p�X���[�h�擾

          $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $result = $pdo->query('SET NAMES sjis'); //���������΍�

          $sql = "SELECT * FROM ".$table." where id=$delete_num";

          $result = $pdo->query($sql);//���s�E���ʎ擾

          foreach ($result as $row) {

                    $right_pass = htmlspecialchars($row['pass']);

          }

          if ( $delete_pass==$right_pass ) {

                    echo "<br>";

                    echo "<font color='red' >�{���ɍ폜���܂����H</font>"."<br>";

                    echo "<form action = 'japan-support.php' method = 'post'>";

                    echo "<input type = 'submit' name = 'yes' value ='Yes'>&nbsp&nbsp<input type = 'submit' name = 'no' value ='No'>";

                    echo "<input type = 'hidden' name = 'delete_num' value ='$delete_num'>";

                    echo "</form>";

                    echo "<br>";

          }

          else { echo "<font color='red' >�p�X���[�h���Ⴂ�܂�</font>"."<br>"; }

          $pdo = null;//�ڑ��I��

 }

 if(isset($_POST['yes'])){

          $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $result = $pdo->query('SET NAMES sjis'); //���������΍�

          $sql = "delete from ".$table." where id=$delete_num";

          $result = $pdo->query($sql);//���s�E���ʎ擾

          $pdo = null;//�ڑ��I��

 }


 /*****�ҏW�t�H�[���̃R�����g*****/

 $edit_num = htmlspecialchars($_POST["edit_num"]);
 $edit_pass = htmlspecialchars($_POST["edit_pass"]);

 if(isset($_POST["edit"])){

          if (empty($edit_num)) { echo "<font color='red' >�ҏW�Ώ۔ԍ�������܂���</font>"."<br>"; }

          if(empty($edit_pass)) { echo "<font color='red' >�p�X���[�h������܂���</font>"."<br>"; }

          else if(empty($before_comment)) { echo "<font color='red' >�p�X���[�h���Ⴂ�܂�</font>"."<br>"; }

 }


 /*****�ҏW�@�\*****/

 if(isset($_POST["again_submit"])){

          $edit_name = htmlspecialchars($_POST["name"]);
          $edit_comment = htmlspecialchars($_POST["comment"]);

          $edit_number = htmlspecialchars($_POST["edit_number"]);

          if ( (!empty($edit_name)) && (!empty($edit_comment)) ) {

                    $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                    $result = $pdo->query('SET NAMES sjis'); //���������΍�

                    $sql = "update ".$table." set name='$edit_name', comment='$edit_comment', time ='$time', edit_mode='(�ҏW�ς�)' where id=$edit_number ";

                    $result = $pdo->query($sql);//���s�E���ʎ擾

                    $pdo = null;//�ڑ��I��

          }

 }


/*****"comments38"�ɉ摜�f�[�^��}��*****/

 if(isset($_POST["submit"])){

          if( (!empty($name)) && (!empty($comment)) && (!empty($pass)) ) {

                    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {

                              if ( move_uploaded_file($_FILES["upfile"]["tmp_name"], "./jsfiles/". $_FILES["upfile"]["name"]) ) {

                                        $file_path = "./jsfiles/". $_FILES["upfile"]["name"];
                                        $contents = file_get_contents($file_path);
                                        $ext = $_FILES["upfile"]["type"];

                                        echo $ext."A";

try{

                                        $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                                        $sql = $pdo->query('SET NAMES sjis'); //���������΍�

                                        //INSERT�Ńf�[�^�}��

                                        $sql = $pdo -> prepare("INSERT INTO ".$table."(name, comment, time, pass, ext, contents)"
                                                              ."VALUES(:name, :comment, :time, :pass, :ext, :contents)");

                                        $sql->bindParam(':name', $name, PDO::PARAM_STR);
                                        $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
                                        $sql->bindParam(':time', $time, PDO::PARAM_STR);
                                        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);
                                        $sql->bindParam(':ext', $ext, PDO::PARAM_STR);
                                        $sql->bindParam(':contents', $file_path, PDO::PARAM_STR);

                                        $sql-> execute();

                                        $pdo = null;//�ڑ��I��

}

//�ڑ��Ɏ��s�����ۂ̃G���[����
 catch (PDOException $e){

          print('�G���[���������܂����B:'.$e->getMessage());

          die();

 }

                              } else {

                                        echo "�t�@�C�����A�b�v���[�h�ł��܂���B";

                              }

                    }

          }

 }


 /*****�e�[�u��"comments"�̕\��*****/

 echo "<br>";

 echo "********************�R�����g�ꗗ********************"."<br>"."<br>";

 $pdo = new PDO($dsn, $user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

 $result = $pdo->query('SET NAMES sjis'); //���������΍�

 $sql = "SELECT * FROM ".$table." ORDER BY id";//�N�G��

 $result = $pdo->query($sql);//���s�E���ʎ擾

 foreach ($result as $row) {

          echo htmlspecialchars($row['id']).": ";
          echo htmlspecialchars($row['name']).": ";
          echo htmlspecialchars($row['time'])."; ";
          echo htmlspecialchars($row['edit_mode'])."<br>";
          echo "<font color= 'Impact' >".nl2br(htmlspecialchars($row['comment']))."</font>"."<br>"."<br>";

          $id = $row['id'];
          $contents_path = $row['contents'];

          if ( isset($row['ext']) ) {

                    //�摜�E����̕\��
                    echo "<img src='$contents_path' width=200>"."<br>"."<br>";//img.php?id=$id&table=$table

          }

 }

 $pdo = null;//�ڑ��I��

?>