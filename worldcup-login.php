<!DOCTYPE html>
 <html lang = "ja">

 <head>
 <meta charset = "UFT-8">
 <title>�K���o�����{!!�@2018���V�AW�t�����T�C�g</title>
 </head>

 <body>
 <center>

 <h1>�K���o�����{!!�@2018���V�AW�t�����T�C�g</h1>

 <h2>���O�C���t�H�[��</h2>

 <form action = "worldcup-login.php" method = "post">

 <p>���[�U�[ID:<input type = "text" name = "login_id" value = "" ></p>
 <p>���[�U�[�l�[��:<input type = "text" name = "login_name" value = "" ></p>
 <p>���[�U�[�p�X���[�h:<input type = "password" name = "login_pass" ></p>

 <p><input type = "submit" name = "login" value ="���O�C��"></p>

 </form>


 <h2>�V�K���[�U�[�o�^�t�H�[��</h2>

 <form action = "worldcup-login.php" method = "post">

 <p>���[�U�[�l�[��:<input type = "text" name = "user_name" value = "" ></p>
 <p>���[�U�[�p�X���[�h:<input type = "password" name = "user_pass" value = "" ></p>
 <p>���[���A�h���X:<input type = "text" name = "user_address" ></p>

 <p><input type = "submit" name = "entry" value ="�o�^"></p>

 </form>

 </center>

 </body>

</html>

<?php

 $dsn = '�f�[�^�x�[�X��';//DB��Mysql�A�f�[�^�x�[�X�����w��B

 $user = '���[�U�[��';//DB�ɐڑ����邽�߂̃��[�U�[����ݒ�
 $ds_password = '�p�X���[�h';//DB�ɐڑ����邽�߂̃p�X���[�h��ݒ�

 /*****�e�[�u���쐬*****/

 $table = "userinfo";

 try{

          $pdo = new PDO($dsn, $ds_user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $result = $pdo->query("SET NAMES sjis"); //���������΍�

          //SQL�R�}���h�uCREATE TABLE�v�ŐV�K�e�[�u��"user"���쐬����

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

          $pdo = null;//�ڑ��I��

 }

 //�ڑ��Ɏ��s�����ۂ̃G���[����
 catch (PDOException $e){

          print('�G���[���������܂����B:'.$e->getMessage());

          die();

 }


/*****���[�U�[�o�^�@�\*****/

 $user_name = htmlspecialchars($_POST["user_name"]); 
 $user_pass = htmlspecialchars($_POST["user_pass"]);
 $user_address = htmlspecialchars($_POST["user_address"]);


 //�V�K���[�U�[�o�^�t�H�[���̃R�����g

 if(isset($_POST["entry"])){

          if(empty($user_name)){ echo "<center><font color='red' >���O������܂���</font></center>"."<br>"; }

          if(empty($user_pass)) { echo "<center><font color='red' >�p�X���[�h������܂���</font></center>"."<br>"; }

          if(empty($user_address)) { echo "<center><font color='red' >���[���A�h���X������܂���</font></center>"."<br>"; }

 }

 $user_entry = "���o�^";

 //"user"�e�[�u���Ƀf�[�^��}��
 if(isset($_POST["entry"])){

          if( (!empty($user_name)) && (!empty($user_pass)) && (!empty($user_address)) ) {

                    $user_id = uniqid("WC_");

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                    $sql = $pdo->query("SET NAMES sjis"); //���������΍�

                    //INSERT�Ńf�[�^�}��

                    $sql = $pdo -> prepare("INSERT INTO wcuserinfo(user_id, user_name, user_pass, user_address, user_entry)" 
                                            ."VALUES(:user_id, :user_name, :user_pass, :user_address, :user_entry)");

                    $sql->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                    $sql->bindParam(':user_name', $user_name, PDO::PARAM_STR);
                    $sql->bindParam(':user_pass', $user_pass, PDO::PARAM_STR);
                    $sql->bindParam(':user_address', $user_address, PDO::PARAM_STR);
                    $sql->bindParam(':user_entry', $user_entry, PDO::PARAM_STR);
                    $sql-> execute();

                    $pdo = null;//�ڑ��I��

                    echo "<br>";


                    //�ۑ��������[�U�[���̕\��

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                    $result = $pdo->query('SET NAMES sjis'); //���������΍�

                    $sql = "SELECT * FROM wcuserinfo order by No desc limit 1";//SELECT�ň�ԐV�����f�[�^��I��

                    $result = $pdo->query($sql);//���s�E���ʎ擾

                    //�o��

                    foreach ($result as $row) {

                              echo "<center>���[�U�[�o�^���</center><br>";
                              echo "<center>���[�U�[ID�F".$row['user_id']."</center><br>";
                              echo "<center>���[�U�[�l�[���F".$row['user_name']."</center><br>";
                              echo "<center>���[�U�[�p�X���[�h�F".$row['user_pass']."</center><br>";
                              echo "<center>���[�U�[�A�h���X�F".$row['user_address']."</center><br>";
                              echo "<center>�o�^��ԁF".$row['user_entry']."</center><br>";

                              $No = $row['No'];
                              $entry_id = $row['user_id'];
                              $entry_pass = $row['user_pass'];

                    }

                    $pdo = null;//�ڑ��I��

          }

 }


 /*****���[�����M�@�\*****/

 if(isset($_POST["entry"])){

          if( (!empty($user_name)) && (!empty($user_pass)) && (!empty($user_address)) ) {

                    $mail_text = "�{�o�^����ɂ́A�ȉ���URL���N���b�N���Ă��������B"."\n"."\n"
                                ."http://co-412.it.99sv-coco.com/worldcup-login.php"."?No=$No"."&"."entry_id=$entry_id"."\n"."\n"
                                ."���Ȃ��̃��[�U�[ID�F".$entry_id."\n"
                                ."���Ȃ��̃p�X���[�h�F".$entry_pass."\n";

                    if (mail("$user_address", "", "$mail_text", "")) {

                              echo "<center>".$user_address."�Ƀ��[�������M����܂����B</center><br>";

                    } else {

                              echo "<center>���[���̑��M�Ɏ��s���܂����B</center><br>";

                    }

          }

 }


 /*****�{�o�^*****/

 $url = $_SERVER['QUERY_STRING'];

 parse_str($url,$entry);

 $NO = $entry["No"];

 if (!empty($entry["No"]) ) {

          $pdo = new PDO($dsn, $ds_user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

          $sql = $pdo->query("SET NAMES sjis"); //���������΍�

          $sql = "select * from wcuserinfo where No=$NO";

          $result = $pdo->query($sql);//���s�E���ʎ擾

          foreach ($result as $row) { $user_id=$row['user_id']; }

          if ( $entry['entry_id']==$user_id ) {

                    $sql = $pdo->query("SET NAMES sjis"); //���������΍�

                    $sql = "update wcuserinfo set user_entry='�{�o�^'  where No=$NO ";

                    $result = $pdo->query($sql);//���s�E���ʎ擾

          }

          $pdo = null;//�ڑ��I��

 }


 /*****���[�U�[���O�C���@�\*****/

 $login_id = htmlspecialchars($_POST["login_id"]); 
 $login_name = htmlspecialchars($_POST["login_name"]);
 $login_pass = htmlspecialchars($_POST["login_pass"]);

 //���O�C���t�H�[���̃R�����g

 if(isset($_POST["login"])){

          if(empty($login_id)){ echo "<center><font color='red' >ID������܂���</font></center>"."<br>"; }

          if(empty($login_name)) { echo "<center><font color='red' >���O������܂���</font></center>"."<br>"; }

          if(empty($login_pass)) { echo "<center><font color='red' >�p�X���[�h������܂���</font></center>"."<br>"; }

 }

 //���O�C���@�\

 if(isset($_POST["login"])){

          if( (!empty($login_id)) && (!empty($login_name)) && (!empty($login_pass)) ) {

                    $pdo = new PDO($dsn, $ds_user, $ds_password);//�f�[�^�[�x�[�X�ɐڑ�

                    $result = $pdo->query('SET NAMES sjis'); //���������΍�

                    $sql = "SELECT * FROM wcuserinfo where user_id='$login_id' ";//SELECT�Ńf�[�^��I��

                    $result = $pdo->query($sql);//���s�E���ʎ擾

                    foreach ($result as $row) { //�p�X���[�h�擾

                              $user_id = $row['user_id'];

                              $right_pass = $row['user_pass']; 

                              $user_entry = $row['user_entry'];

                    } 

                    if ( ($right_pass==$login_pass) ) {

                              if ($user_entry=="�{�o�^" ) {

                                        setcookie("user_name",$login_name);

                                        header("Location:http://co-412.it.99sv-coco.com/gameresult.php");

                              }

                              else { echo "<center><font color='red' >".$user_entry."�Ȃ̂ŁA���O�C���ł��܂���B</font></center>"."<br>"; }

                    }

                    else { echo "<center><font color='red' >�p�X���[�h���Ⴂ�܂��B</font></center>"."<br>"; }

                    $pdo = null;//�ڑ��I��

          }

 }

?>