
<?php

include_once 'class.php';


if (isset($_GET['id'])) {
$id=$_GET['id'];
if ($music->check_userz_exist($id)==1) {

}
else{
  header("Location:/Page404.php");
}



}


$user = "user";
if ($user=="user") {


}
else {
  header("Location:/accDash.php?id=$id");
}

 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/css.css">
    <style >
      .img-gallery{
        display: grid;
        grid-template-columns: repeat(auto-fill,minmax(300px,1fr));
        grid-column-gap:10px;
        grid-row-gap:10px;
            margin-left: 3%;
      }
      .img-gallery  img{
        width: 100%;
        height: 82%;
      }
      </style>
    <title>Musika Pinoy</title>
  </head>
  <body>
    <?php   $music->login(); ?>
    <nav class="navbar navbar-expand-lg navbar-light nab sticky-top" >
    <div class="container">
      <a class="navbar-brand" href="/index.php" style="margin-top:10px;"> MUSIKA PINOY</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <input type="checkbox" id="click" style="display:none;">
            <label for="click" class="button nav-link nab-links">Login</label>

            <div class="modalz">
              <div class="modalz_content">
                <h3>Login</h3>
                <form method="post" >
  <div class="form-group">
  <label for="exampleInputEmail1">Email address</label>
  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="ems">
  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
  <label for="exampleInputPassword1">Password</label>
  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
  </div>
  <div class="form-group">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
    <label class="form-check-label" for="invalidCheck2">
      Agree to terms and conditions
    </label>
  </div>
  </div>
    <button type="button" class="btn btn-primary">  <label for="click">Close</label></button>
  <button type="submit" class="btn btn-primary"name="log-sbm">Submit</button>


  </form>

              </div>
            </div>
            <div class="overlay">

            </div>
       </li>
       <li class="nav-item">
         <input type="checkbox" id="clicks" style="display:none;">
         <label for="clicks" class="button nav-link nab-links">Register</label>

         <div class="modalz">
           <div class="modalz_content">
             <h3>Register</h3>
             <form method="POST">
   <div class="form-row">
     <div class="form-group col-md-6">
       <label for="inputEmail4">Email</label>
       <input type="email" class="form-control" id="inputEmail4" name="email"placeholder="Email">
     </div>
     <div class="form-group col-md-6">
       <label for="text">Name</label>
       <input type="text" class="form-control" id="text" placeholder="Name" name="name">
     </div>
     <div class="form-group col-md-6">
       <label for="inputPassword4">Password</label>
       <input type="password" class="form-control" id="inputPassword4" name="password"placeholder="Password">
     </div>
     <div class="form-group col-md-6">
       <label for="inputPassword4">Confirm Password</label>
       <input type="password" class="form-control" id="inputPassword4" name="confirm_password"placeholder="Password">
     </div>
   </div>


   <div class="form-group">

   </div>
      <button type="button" class="btn btn-primary">  <label for="clicks">Close</label></button>
   <button type="submit" class="btn btn-primary" name="submit">Register</button>
  </form>

           </div>
         </div>
         <div class="overlay">

         </div>
       </li>
          <li class="nav-item">
            <form class="d-flex" style="width: 422px;" action="search.php" method="get">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="margin-top:10px;" name="search">
              <button class="btn btn-outline-success" type="submit" style="margin-top:10px;">Search</button>
            </form>
          </li>


        </ul>
      </div>
    </div>
    </nav>
    <div class="container-fluid">

	<div class="row">
		<div class="col-md-12 header">

      <div style="     height: 55%;
    display: flex;
    margin-top: 5%;
    align-content: center;
    justify-content: center;" >
<img src="/img/user.png" class="rounded float-start img-fluid align-middle" alt="..."><br/>

      </div>
      <div class="col-md-12 ">

        <div style="     height: 55%;
      display: flex;
      margin-top: 1%;
      align-content: center;
      justify-content: center; color:white;" >
    <h1><?php
    $connection=$music->openConnection();
    $stmt = $connection->prepare("SELECT * FROM aposttbl WHERE uid=?  ");
    $stmt->execute([$id]);
    $users = $stmt->fetch();
    $userCount = $stmt->rowCount();
    if ($userCount > 0)
    {
      echo $users['name'];
    }
    else
    {
        echo "User";
    }


     ?></h1>

        </div>

      </div>
		</div>

	</div>

</div>


<section class="second-section">
<h3 class="a">Uploads</h3>
<div class="img-gallery">

<?php

$connection=$music->openConnection();
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
  </div>
</div>"
    ;
  }
}
else
{
    return 0;
}


 ?>





</div>

</section>
<!-- NewsFeed -->

<section class="third-section">



</section>






<!-- Subscribe To our Update -->


<!-- Footer -->
<section class="footer">
  <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

      <div class="grid-container">
        <div class="footer1">
                <h3>Musika Pinoy</h3><br>
                <p>Inspire Others With Music</p><br>
                <p>© <span id="date"></span> MusikaPinoy, All Rights Reserved.</p>
        </div>
        <div class="footer2">
          <div class="row">
    <div class="fots  ">

      <div class="list-group " id="list-tab" role="tablist">
              <a class="list-group-item list-group-item-action bg-light text-dark" href="#"  aria-controls="home">Explore</a>
        <a class="list-group-item list-group-item-action bg-dark text-light" href="#"  aria-controls="home">Home</a>
        <a class="list-group-item list-group-item-action bg-dark text-light"  href="/about.php"  aria-controls="profile">Profile</a>
        <a class="list-group-item list-group-item-action bg-dark text-light"  href="/contact.php"  aria-controls="messages">Message</a>

      </div>
    </div>
        </div>





      </div>
      <div class="footer3">
        <div class="row">
  <div class="fots ">

    <div class="list-group " id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action bg-light text-dark" href="#"  aria-controls="home">Follow Us</a>
      <a class="list-group-item list-group-item-action bg-dark text-light" href="https://www.facebook.com/sejhhamatzu"  aria-controls="home">Facebook</a>
      <a class="list-group-item list-group-item-action bg-dark text-light"  href="https://www.instagram.com/"  aria-controls="profile">Instagram</a>
      <a class="list-group-item list-group-item-action bg-dark text-light"  href="https://twitter.com/home"  aria-controls="messages">Twitter</a>

    </div>
  </div>
      </div>
      </div>
      <div class="footer4">
        <div class="row">
  <div class="fots  ">

    <div class="list-group " id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action bg-light text-dark" href="#"  aria-controls="home">Legal</a>
      <a class="list-group-item list-group-item-action bg-dark text-light" href="/home.php"  aria-controls="home">Terms and Privacy</a>
      <a class="list-group-item list-group-item-action bg-dark text-light"  href="/about.php"  aria-controls="profile">Business</a>


    </div>
  </div>
      </div>
      </div>
		</div>
	</div>
</div>

</section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script>

$( document ).ready(function() {<?php $music->register();


?>
  var d = new Date();
  var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
  var n = strDate.search("/");
  var date = strDate.slice(0,n);
  $('#date').text(date);


});
</script>
  </body>
</html>
