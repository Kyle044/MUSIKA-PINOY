<?php
class myMusic
{
    private $server = "mysql:host=localhost; dbname=newmusicdb";
    private $user = 'webdataweb';
    private $pass = 'HXe4WRwFE497CmG';
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    protected $con;

    public function openConnection()
    {

        try
        {

            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
            return $this->con;

        }
        catch(PDOException $e)
        {
            echo "There is some error in connection : " . $e->getMessage();
        }

    }

    public function closeConnection()
    {
        $this->con = null;
    }

public function validate($data){
  $data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
public function check_user_exist($name){
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM users WHERE email=?");
  $stmt->execute([$name]);
  $total = $stmt->rowCount();
  return $total;

}


public function register(){

  if (isset($_POST['submit'])) {

    if ($_POST['confirm_password']!=$_POST['password']) {
      echo "alert('Password Doesnt Match'); window.location.replace('/index.php');";

    }
    else{
      $email = $_POST['email'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      if ($password=="admin123") {
        $access = "admin";
      }
      else {
        $access="user";
      }
      if ($this->check_user_exist($email)>0) {
        echo "alert('Email Already Exist'); window.location.replace('/index.php');";
      }
      else{
        $connection = $this->openConnection();
        $stmt = $connection->prepare("INSERT INTO users (email,name,password,access)VALUES(?,?,?,?)");
        $stmt->execute([$email,$name,md5($password),$access]);
          echo "alert('Registered Successfuly!'); window.location.replace('/index.php');";
      }

    }



  }

}
public function set_user_data($id,$name,$email,$access){

if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['userdata'] = array("id"=>$id,"name"=>$name,"email"=>$email,"access"=>$access);
return $_SESSION['userdata'];
}
public function get_user_data(){
  if (!isset($_SESSION)) {
    session_start();
  }
  return $_SESSION['userdata'];
}
public function login(){
    if (isset($_POST['log-sbm'])) {
      $email = $_POST['ems'];
      $password=$_POST['pass'];
      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM users WHERE email=? AND password=?");

      $stmt->execute([$email,md5($password)]);
      $total = $stmt->rowCount();
      if ($total==1) {
        $users = $stmt->fetch();

            $this->set_user_data($users['id'],$users['name'],$users['email'],$users['access']);
            if ($users['access']=="admin") {

                      header("Location:/adminIndex.php");
            }
            else {
                  header("Location:/userIndex.php");
            }



      }
      else {
          echo "<div class='alert alert-danger' role='alert'>
  Wrong UserName Or Password!
</div>";
      }

    }



}

public function logout(){
  if (!isset($_SESSION)) {
    session_start();
  }
  $_SESSION['userdata'] = null;
  unset($_SESSION['userdata']);
}
public function check_product_exists($name){
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT LOWER('fileName') FROM posttbl WHERE postName=?");
  $stmt->execute([strtolower($name)]);
  $total = $stmt->rowCount();
  return $total;

}

public function upload(){
  if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
          $fileType = $_FILES['file']['type'];
            $fileSize = $_FILES['file']['size'];
            $filename1 = $_FILES['thumb']['name'];
              $fileTmpName1 = $_FILES['thumb']['tmp_name'];
                $fileError1 = $_FILES['thumb']['error'];
                  $fileType1 = $_FILES['thumb']['type'];
                    $fileSize1 = $_FILES['thumb']['size'];
          $fileExt = explode('.',$filename);
          $fileExt1 = explode('.',$filename1);
          $fileActualExt = strtolower(end($fileExt));
            $fileActualExt1 = strtolower(end($fileExt1));
          $allowed = array('mp4','mov','avi','mpeg4','wmv');
          $allowed1 = array('png','jpeg','jpg');
          if (in_array($fileActualExt,$allowed)&&in_array(  $fileActualExt1,$allowed1)) {
            if ($fileError===0&&$fileError1==0) {
                if ($fileSize<1000000000&&$fileSize1<10000000) {
                  $fileNameNew = uniqid('',true).".".$fileActualExt;
                  $fileDestination = 'post/'.$fileNameNew;
                  move_uploaded_file($fileTmpName,$fileDestination);
                  $fileNameNew1 = uniqid('',true).".".$fileActualExt1;
                  $fileDestination1 = 'thumbnail/'.$fileNameNew1;
                  move_uploaded_file($fileTmpName1,$fileDestination1);
                  $productName = $_POST['product_name'];

                  $productType = $_POST['type'];
                  $name = $_POST['name'];
                  $uid = $_POST['id'];
                  $productDescription = $_POST['description'];
                  if ($this->check_product_exists($productName)==0) {
                    $connection = $this->openConnection();
                    $stmt = $connection->prepare("INSERT INTO posttbl(postName,fileName,category,description,thumbnail,name,uid)VALUES(?,?,?,?,?,?,?)");
                    $stmt->execute([$productName,$fileNameNew,$productType,$productDescription,$fileNameNew1,$name,$uid]);
                  }
                  else {
                    echo "<script>
              alert('Video Already Exists');

            </script>";
                  }
                  echo "<script>
            alert('Post Success! Wait for it to be Approved by the Admin!');
            window.location.replace(' /userIndex.php');
          </script>";

                }
                else {
                  echo "<script>
            alert('Your File is too Big.');
  window.location.replace(' /userIndex.php');
          </script>";
                }
            }
            else {
              echo "<script>
        alert('There was an error uploading your file.');
  window.location.replace('/userIndex.php');
      </script>";
            }
          }else {
            echo "<script>
      alert('This type of file is not allowed.');
  window.location.replace(' /userIndex.php');
    </script>";
          }

  }
}
public function generate_string($input, $strength = 5) {
$input_length = strlen($input);
$random_string = '';
for($i = 0; $i < $strength; $i++) {
  $random_character = $input[mt_rand(0, $input_length - 1)];
  $random_string .= $random_character;
}

return $random_string;
}
public function get_post(){
    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length=6;
    $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM posttbl");
    $stmt->execute();
    $posts = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($posts as $post) {
              $id =   $this->generate_string($permitted_chars,$length).$post['post_id'];
              echo "    <tr>
                  <th scope='row'>".$post['post_id']."</th>
                  <td>".$post['postName']."</td>
                  <td>".$post['name']."</td>
                  <td>".$post['uid']."</td>
                  <td>".$post['date_up']."</td>
                      <td>".$post['category']."</td>
                          <td>".$post['description']."</td>
                  <td> <p><button class='btn btn-light' type='button' data-bs-toggle='collapse' data-bs-target='#".$id."' aria-expanded='false' aria-controls='collapseExample'>
                        Video
                      </button>
                      </p>
                      <div class='collapse' id='".$id."'>
                         <div class='card card-body'>
                           <div class='video-frame'>
                             <video width='320' height='240' controls='' class='vidzx' style='
                                              width: 475px;
                                              height: 285px;
                                              '>
                               <source src='/post/".$post['fileName']."' type='video/mp4'>
                             </video>
                           </div>
                         </div>
             </div>
                      </td>

            <td><div class='boton'><form  action='' method='post' class='aps' id='".$post['post_id']."'>

          <button type='submit'  class='btn btn-success' style='margin-right:10px;'>Approve</button>
            </form><form  action='' method='post' class='dec' id='".$post['post_id']."'>

          <button type='submit' class='btn btn-danger' '>Decline</button>
            </form></div>

                </tr>";



      }
}
else {
  echo "0";
}
}
public function get_apost(){
    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length=6;
    $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM aposttbl");
    $stmt->execute();
    $posts = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($posts as $post) {
              $od =   $this->generate_string($permitted_chars,$length).$post['apost_id'];
              echo "    <tr>";
                echo " <th scope='row'>".$post['apost_id']."</th>";
                echo "  <td>".$post['postName']."</td>";
                echo "  <td>".$post['name']."</td> ";
              echo "    <td>".$post['uid']."</td>";
                echo "  <td>".$post['date_up']."</td>";
                echo "      <td>".$post['category']."</td>";
                    echo "      <td>".$post['description']."</td>";
                echo"  <td> <p><button class='btn btn-dark' type='button' data-bs-toggle='collapse' data-bs-target='#".$od."' aria-expanded='false' aria-controls='collapseExample'>";
              echo "         Video";
                      echo "</button>";
                    echo "  </p>  <div class='collapse' id='".$od."'>   <div class='card card-body'><div class='video-frame'><video width='320' height='240' controls='' class='vidzx' style='";




                                echo"              width: 475px;   height: 285px;   '> <source src='/post/".$post['fileName']."' type='video/mp4'>   </video>   </div></div> </div>  </td>  <td><div class='boton'><form  action='' method='post' class='del' id='".$post['apost_id']."'>    <button type='submit'  class='btn btn-danger' style='margin-right:10px;'>Delete</button></form></div></td>  </tr>";


















      }
}
else {
  echo "0";
}
}

public function approve(){

if (isset($_POST['apr'])) {
$post_id = $_POST['apr'];
$connection = $this->openConnection();
$connection = $this->openConnection();
$stmt = $connection->prepare("SELECT * FROM posttbl WHERE post_id=?  ");
$stmt->execute([$post_id]);
$users = $stmt->fetch();

$postname =$users['postName'];
$fileName=$users['fileName'];
$category=$users['category'];
$description=$users['description'];
$thumbnail=$users['thumbnail'];
$name=$users['name'];
$uid=$users['uid'];
$date=$users['date_up'];
$stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message,post_id)VALUES(?,?,?)");
$stmt4->execute([$uid,"Your Post $postname is Approved by the Admin!",$post_id]);
$stmt3 = $connection->prepare("INSERT INTO aposttbl (postName,fileName,category,description,thumbnail,name,uid,date_up,last_id)VALUES(?,?,?,?,?,?,?,?,?)");
$stmt3->execute([$postname,$fileName,$category,$description,$thumbnail,$name,$uid,$date,$post_id]);

$delete = $connection->prepare("DELETE FROM posttbl WHERE post_id=?");
$delete->execute([$post_id]);

echo $this->get_post();


}


}
public function decline(){

if (isset($_POST['decs'])) {
  $post_id = $_POST['decs'];
  $connection = $this->openConnection();
  $stmt1 = $connection->prepare("SELECT * FROM posttbl WHERE post_id=?  ");
  $stmt1->execute([$post_id]);
  $users = $stmt1->fetch();
  $uid=$users['uid'];
  $postname =$users['postName'];
  $stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message)VALUES(?,?)");
  $stmt4->execute([$uid,"Your Post $postname is Declined by the Admin!"]);
  $delete = $connection->prepare("DELETE FROM posttbl WHERE post_id=?");
  $stmt = $connection->prepare("SELECT * FROM posttbl WHERE post_id=?  ");
  $stmt->execute([$post_id]);
  $users = $stmt->fetch();
  $n = $users['fileName'];
    $a = $users['thumbnail'];
  $delete->execute([$post_id]);

  if (!unlink("post/$n")) {
echo "There was an Error";
  }
  else{
        unlink("thumbnail/$a");
      echo $this->get_post();
  }


}


}
public function delete(){

if (isset($_POST['del'])) {
  $post_id = $_POST['del'];
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
  $stmt->execute([$post_id]);
  $delete = $connection->prepare("DELETE FROM aposttbl WHERE apost_id=?");
  $delete->execute([$post_id]);

  $users = $stmt->fetch();
  $n = $users['fileName'];
    $a = $users['thumbnail'];
  $delete->execute([$post_id]);
  if (!unlink("post/$n")) {
echo "There was an Error";
  }
  else{
    unlink("thumbnail/$a");
  echo $this->get_apost();
  }



}


}
public function likes($args)
{
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
    $stmt->execute([$args]);
    $users = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount == 1)
    {
      foreach ($users as $user) {
          echo $user['likes'];
      }
    }
    else
    {
        return 0;
    }
}
public function views($args)
{
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
    $stmt->execute([$args]);
    $users = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount == 1)
    {
      foreach ($users as $user) {
          echo $user['views'];
      }
    }
    else
    {
        return 0;
    }
}
public function view($id,$uid){

    $post = $id;

      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
      $stmt->execute([$id]);
      $users = $stmt->fetch();
      $n = $users['views'];
      $update = $connection->prepare("UPDATE aposttbl SET views=? WHERE apost_id=? ");
      $update->execute([$n+1,$id]);
      $insert = $connection->prepare("INSERT INTO viewtbl(uid,vid) VALUE (?,?)");
      $insert->execute([$uid,$post]);





}
public function like(){
  if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];

      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
      $stmt->execute([$postid]);
      $users = $stmt->fetch();
      $n = $users['likes'];
      $postname = $users['postName'];
      $last = $users['last_id'];
      $update = $connection->prepare("UPDATE aposttbl SET likes=? WHERE apost_id=? ");
      $update->execute([$n+1,$postid]);
      $insert = $connection->prepare("INSERT INTO liketbl(uid,vid) VALUE (?,?)");

      $insert->execute([$_POST['user'],$postid]);
      $stmt2 = $connection->prepare("SELECT * FROM users WHERE id=?  ");
      $stmt2->execute([$_POST['user']]);
      $users2 = $stmt2->fetch();
      $liker = $users2['name'];
      $stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message,post_id)VALUES(?,?,?)");
      $stmt4->execute([$users['uid'],"Your Post $postname is liked by $liker",$last]);
      $this->likes($postid);



  }
  if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
      $stmt->execute([$postid]);
      $users = $stmt->fetch();
      $n =$users['likes'];

      $delete = $connection->prepare("DELETE FROM liketbl WHERE vid=? AND uid=?");
      $delete->execute([$postid,$_POST['user']]);
      $update = $connection->prepare("UPDATE aposttbl SET likes=? WHERE apost_id=? ");
      $update->execute([$n-1,$postid]);
          $this->likes($postid);





  }





}
public function getUsersComment($w)
{
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM comtbl WHERE CommentType=?  ORDER BY date DESC LIMIT 5");
    $stmt->execute([$w]);
    $users = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($users as $user) {
          echo "<hr style='color:white;'><div class='com-card'>
          <h5>  ".$user['uid']."</h5><p>".nl2br($user['Comment'])."</p><p class='date'>".$user['date']."</p>
          </div>";
      }
    }
    else
    {
        return 0;
    }
}



public function getUsersPost($w)
{
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id !=? ORDER BY RAND() LIMIT 10  ");
    $stmt->execute([$w]);
    $users = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($users as $user) {
          echo "  <a href='/videoTemp.php?id=".$user['apost_id']."' style='text-decoration:none; color:black;'>
            <div class='card mb-3' style='max-width: 540px;'>
      <div class='row g-0'>
        <div class='col-md-4' style='height:28vh;'>
          <img src='/thumbnail/".$user['thumbnail']."' alt='...' style='width: 100%;
  height:100%;
 object-fit:cover;'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
            <h5 class='card-title' >".$user['postName']."</h5>
            <p class='card-text'>".$user['description']."</p>
            <p class='card-text'><small class='text-muted'> ".$user['likes']." Heart  ".$user['views']." Views  </small></p>
          </div>
        </div>
      </div>
    </div>
    </a>";
      }
    }
    else
    {
        return 0;
    }
}
public function getUsersPosts($w)
{
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id !=? ORDER BY RAND() LIMIT 10");
    $stmt->execute([$w]);
    $users = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($users as $user) {
          echo "  <a href='/vidTemp.php?id=".$user['apost_id']."' style='text-decoration:none; color:black;'>
            <div class='card mb-3' style='max-width: 540px;'>
      <div class='row g-0'>
        <div class='col-md-4' style='height:28vh;'>
          <img src='/thumbnail/".$user['thumbnail']."' alt='...' style='width: 100%;
  height:100%;
 object-fit:cover;'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
            <h5 class='card-title' >".$user['postName']."</h5>
            <p class='card-text'>".$user['description']."</p>
            <p class='card-text'><small class='text-muted'> ".$user['likes']." Heart  ".$user['views']." Views  </small></p>
          </div>
        </div>
      </div>
    </div>
    </a>";
      }
    }
    else
    {
        return 0;
    }
}
public function comment_part2(){


if (isset($_POST['type'])) {
$type = $_POST['type'];

$name = $_POST['name'];
$comment = $_POST['comment'];
$connection = $this->openConnection();
$stmtz = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
$stmtz->execute([$type]);
$users = $stmtz->fetch();
$postname = $users['postName'];
$last = $users['last_id'];

$stmt = $connection->prepare("INSERT INTO comtbl (CommentType,Comment,uid)VALUES(?,?,?)");
$stmt->execute([$type,$comment,$name]);

$stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message,post_id)VALUES(?,?,?)");
$stmt4->execute([$users['uid'],"Your Post $postname is Commented by $name",$last]);
echo $this->getUsersComment($type);

}



}
public function check_page_exist($name){
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?");
  $stmt->execute([$name]);
  $total = $stmt->rowCount();
  return $total;

}
public function check_userz_exist($name){
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM users WHERE id=?");
  $stmt->execute([$name]);
  $total = $stmt->rowCount();
  return $total;

}

public function delete_post($id){
  if (isset($_POST['postid'])) {
    $post_id=$_POST['postid'];

    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
    $stmt->execute([$post_id]);
    $delete = $connection->prepare("DELETE FROM aposttbl WHERE apost_id=?");
    $delete->execute([$post_id]);

    $users = $stmt->fetch();
    $n = $users['fileName'];
      $a = $users['thumbnail'];
    $delete->execute([$post_id]);
    if (!unlink("post/$n")) {
  echo "There was an Error";
    }
    else{
      $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE uid=?  ");
      $stmt->execute([$id]);
      $users = $stmt->fetchAll();
      $userCount = $stmt->rowCount();
      if ($userCount > 0)
      {
        foreach ($users as $user) {
          echo "  <div class='card text-white bg-dark' style='width: 18rem;'>
        <img src='/thumbnail/".$user['thumbnail']."' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>".$user['postName']."</h5>
          <p class='card-text'>".$user['description']."</p>
          <a href='/videoTemp.php?id=".$user['apost_id']."' class='btn btn-light'>Watch</a>
          <form action='' method='post' id='".$user['apost_id']."' class='watwat'>

              <button type='submit' class='btn btn-light'  >Delete Post</button>
          </form>

        </div>
      </div>"
          ;
        }
      }
      else
      {
          return 0;
      }

      unlink("thumbnail/$a");

    }
  }


}



public function get_notifA($last){
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE last_id=?");
  $stmt->execute([$last]);
  $posts = $stmt->fetch();
  return $posts['apost_id'];

}




public function clear_notif(){
  if (isset($_POST['idz'])) {

    $connection = $this->openConnection();
    $stmt = $connection->prepare("DELETE FROM notiftbl WHERE user_id=?");
    $stmt->execute([$_POST['idz']]);
    $this->display_notif($_POST['idz']);
  }


}



public function display_notif($id){
  $connection=  $this->openConnection();
    $stmtz = $connection->prepare("SELECT * FROM notiftbl WHERE user_id = ?");
  $stmtz->execute([$id]);
  $posts = $stmtz->fetchAll();


  $userCount = $stmtz->rowCount();
  if ($userCount > 0)
  {

    foreach ($posts as $post) {
      $wet=$this->get_notifA($post['post_id']);
      echo "<li><hr class='dropdown-divider'></li>
      <li><a class='dropdown-item' href='/videoTemp.php?id=$wet'>".$post['message']."  ".$post['date']."  </a></li>";



    }
}
else {
echo "There is none";
}

}

public function support(){
  if (isset($_POST['supported'])) {
    $postid = $_POST['postid'];
    $name = $_POST['userName'];


      //


      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM users WHERE id=?  ");
      $stmt->execute([$postid]);
      $users = $stmt->fetch();
      $n = $users['supporter'];
      $stmt5 = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
      $stmt5->execute([$_POST['id']]);
      $users5 = $stmt5->fetch();
      $last = $users5['last_id'];
      $postname = $users5['postName'];
      // $postname = $users['postName'];
      // $last = $users['last_id'];
      $update = $connection->prepare("UPDATE users SET supporter=? WHERE id=? ");
      $update->execute([$n+1,$postid]);
      $insert = $connection->prepare("INSERT INTO subtbl(uid,poster_id) VALUE (?,?)");

      $insert->execute([$_POST['user'],$postid]);

      $stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message,post_id)VALUES(?,?,?)");
      $stmt4->execute([$postid,"You are supported By ".$_POST['userName']."",$last]);




  }


  if (isset($_POST['unsupported'])) {
      $connection = $this->openConnection();
    $postid = $_POST['postid'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE id=?  ");
    $stmt->execute([$postid]);
    $users = $stmt->fetch();
    $n = $users['supporter'];
    $stmt5 = $connection->prepare("SELECT * FROM aposttbl WHERE apost_id=?  ");
    $stmt5->execute([$_POST['id']]);
    $users5 = $stmt5->fetch();
    $last = $users5['last_id'];
    $postname = $users5['postName'];
    //
      $delete = $connection->prepare("DELETE FROM subtbl WHERE poster_id=? AND uid=?");
      $delete->execute([$postid,$_POST['user']]);
      $update = $connection->prepare("UPDATE users SET supporter=? WHERE id=? ");
      $update->execute([$n-1,$postid]);
      $stmt4 = $connection->prepare("INSERT INTO notiftbl (user_id,message,post_id)VALUES(?,?,?)");
      $stmt4->execute([$postid,"You're Unsupported By ".$_POST['userName']."",$last]);





  }




}


public function get_posters($id){
  $connection=$this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM users WHERE id=? LIMIT 20");
  $stmt->execute([$id]);
  $user = $stmt->fetch();
  $userCount = $stmt->rowCount();
  if ($userCount > 0)
  {
    echo "  <div class='card text-white bg-dark' style='width: 18rem;'>
  <img src='/img/user.png' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>".$user['name']."</h5>
    <p class='card-text'>Supporters ".$user['supporter']."</p>
    <a href='/accDash.php?id=".$user['id']."' class='btn btn-light'>Visit The Account</a>
  </div>
</div>"
    ;
  }
  else
  {
      return 0;
  }

}
public function exportDB(){

    $connection=$this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    $user = $stmt->fetchAll();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      foreach ($user as $key) {
        echo "<tr>
          <td>".$key['id']."</td>
          <td>".$key['email']."</td>
          <td>".$key['name']."</td>
          <td>".$key['password']."</td>
          <td>".$key['date']."</td>
          <td>".$key['access']."</td>
          <td>".$key['supporter']."</td>
        </tr>";
      }
  }

}



public function contact(){
  if (isset($_POST['sub'])) {
    $email = $_POST['ems'];
    $message = $_POST['mes'];
    $connection = $this->openConnection();
    $stmt = $connection->prepare("INSERT INTO messtbl (name,message)VALUES(?,?)");
    $stmt->execute([$email,$message]);
    echo "Message Sent Successfully!";
  }
}


public function deletez(){
  if (isset($_POST['decs'])) {
    $post_id = $_POST['decs'];
    $connection = $this->openConnection();
    $delete = $connection->prepare("DELETE FROM messtbl WHERE id=?");


    $delete->execute([$post_id]);
    $this->get_mess();
  }


}

public function reply(){

  if (isset($_POST['repz'])) {


    $id = $_POST['repz'];
    $message = $_POST['mess'];
    $connection=$this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM messtbl WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    $userCount = $stmt->rowCount();
    if ($userCount>0) {
      $email = $user['name'];
      $subject = "Musika Pinoy";
      $body = $message;
      $name = "NoyMus!";
      require_once 'PHPMailer/PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/PHPMailer/src/SMTP.php';
          require_once 'PHPMailer/PHPMailer/src/Exception.php';
          $mail = new PHPMailer\PHPMailer\PHPMailer();
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com ";
          $mail->SMTPAuth= true;
          $mail->Username ="pinoymusika27@gmail.com";
          $mail->Password = "musika123";
          $mail->Port = 465;
          $mail->SMTPSecure = "ssl";
          $mail->isHTML(true);
          $mail->setFrom("pinoymusika27@gmail.com",$name);
          $mail->addAddress($email);
          $mail->Subject = ("$email ($subject)");
          $mail->Body = $body;
    if ($mail->send()) {
      $status = "success";
      echo "Email Successfully Sent!";
    }
    else {
      $status = "failed";
      echo "Something is Wrong : <br>". $mail->ErrorInfo;
    }
    }

  }


}

public function get_mess(){
  $length=6;
  $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $connection= $this->openConnection();

        $stmt = $connection->prepare("SELECT * FROM messtbl");
          $stmt->execute();
          $posts = $stmt->fetchAll();
          $userCount = $stmt->rowCount();
          if ($userCount > 0)
          {
            foreach ($posts as $post) {
            $id =   $this->generate_string($permitted_chars,$length).$post['id'];
                echo "    <tr>
                    <th scope='row'>".$post['id']."</th>
                    <td>".$post['name']."</td>
                    <td>".$post['message']."</td>
                    <td>".$post['date']."</td>


                    <td> <p><button class='btn btn-light' type='button' data-bs-toggle='collapse' data-bs-target='#".$id."' aria-expanded='false' aria-controls='collapseExample'>
                          Reply
                        </button>
                        </p>
                        <div class='collapse' id='".$id."'>
                           <div class='card card-body'>
                           <form action=''method='post' id = '".$post['id']."' class='rep'>
                             <div class='mb-3'>
                               <label for='exampleFormControlTextarea1' class='form-label'>TYPE SOME REPLY</label>
                               <textarea class='form-control' class='value' rows='3'></textarea>
                             </div>
                             <button type='submit'  class='btn btn-dark'> Reply </button>
                           </form>
                           </div>
               </div></td>


              <td><form  action='' method='post' class='dec' id='".$post['id']."'>

            <button type='submit' class='btn btn-danger' '>Delete</button>
              </form>

                  </tr>";
            }
          }
}


}
$music = new myMusic();




  ?>
