
<?php

include_once 'class.php';

$user = $music->get_user_data();

if (!isset($user)) {
  header("Location:./index.php");

}
$music->upload();
$music->clear_notif();
$music->contact();
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
    <link rel="stylesheet" href="./css/css.css">
<style media="screen">
  .st{
    background: #222831;
    color: white;

    padding: 24px;
  height: 25rem;

  }
  .zeze{


  }
</style>
    <title>Musika Pinoy</title>
  </head>
  <body>


    </div>
    <nav class="navbar navbar-expand-lg navbar-light nab sticky-top" >
    <div class="container">
      <a class="navbar-brand" href="./userIndex.php" style="margin-top:10px;"> MUSIKA PINOY</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <input type="checkbox" id="click" style="display:none;">
            <label for="click" class="button nav-link nab-links">Post Video</label>

            <div class="modalz">
              <div class="modalz_content">
                <h3>Post a Video </h3>
                <div class="container">

                      <form method="post" action="" enctype="multipart/form-data">
                      <div class="mb-3">
                    <label for="formFile" class="form-label">Upload a Video!</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                  </div>
                  <div class="mb-3">
                <label for="formFile" class="form-label">Thumbnail!</label>
                <input class="form-control" type="file" name="thumb" id="formFile">
                </div>
                <input type="hidden" name="name" value="<?php echo$user['name']; ?>">
                <input type="hidden" name="id" value="<?php echo$user['id']; ?>">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="product_name"  placeholder="Name of Post">
                  </div>

                  <select class="form-select" name="type"aria-label="Default select example">
                  <option selected>Category</option>
                  <option value="Guitar">Guitar</option>
                  <option value="Piano">Piano</option>
                  <option value="Drums">Drums</option>
                    <option value="Bass">Bass</option>
                    <option value="performance">Performance</option>
                    <option value="theory">Music Theory</option>
                      <option value="songlesson">Video Song Lesson</option>
                </select>


                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                          <button type="button" class="btn  btn-dark">  <label for="click">Close</label></button>
                    </form>

                </div>







              </div>
            </div>
            <div class="overlay">

            </div>




       </li>
          <li class="nav-item">
        <a href="./userEdit.php?id=<?php echo$user['id']; ?>" class=" nav-link nab-links">Account </a>




       </li>

       <li class= 'nav-item dropdown'>
        <a class='nav-link dropdown-toggle zz' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           Notification
        </a>
        <ul class='dropdown-menu' aria-labelledby='navbarDropdown'id='trs'>


          <?php
            $connection=  $music->openConnection();
        $stmtz = $connection->prepare("SELECT * FROM notiftbl WHERE user_id = ?  ORDER BY date DESC LIMIT 7");
            $stmtz->execute([$user['id']]);
            $posts = $stmtz->fetchAll();


            $userCount = $stmtz->rowCount();
            if ($userCount > 0)
            {
              echo "<script>
            document.getElementsByClassName('zz')[0].textContent = '$userCount Notification';
              </script>";
              foreach ($posts as $post) {
                $wet=$music->get_notifA($post['post_id']);
                echo "<li><hr class='dropdown-divider'></li>
                <li><a class='dropdown-item' href='./videoTemp.php?id=$wet'>".$post['message']."  ".$post['date']."  </a></li>";



              }
              echo " <form  action='userIndex.php' class='notifclear' id='".$user['id']."'method='post' align='right'>
                 <button type='submit' class='btn btn-dark' style='        margin-right: 1vw;margin-top: 2vw; margin-bottom: 1vw;'>Clear</button>
               </form>";
        }
        else {
          echo "<script>
        document.getElementsByClassName('zz')[0].textContent = '0 Notification';
          </script>";
          echo "There is none";
        }

           ?>

        </ul>
      </li>
       <li class="nav-item">

    <a href="./logout.php" class=" nav-link nab-links" onclick="return confirm('Are you Sure You Want To Log Out?')">Log Out</a>


       </li>
          <li class="nav-item">
            <form class="d-flex" style="width: 422px;" action="searchUser.php" method="get">
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

      <div class="title">
        <h1 class="align-middle">CONTACT US</h1>
      </div>

		</div>
	</div>

</div>

<section class="second-section">
  <!-- Categories -->
  <div class="container">
    <div class="row">
      <div class="col-md-6 st">
        <br>
        <h3 align="center">Contact Us!</h3>
        <form class="" action="" method="post" id="wawa">
          <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name="button" class="btn btn-light">Submit</button>
        </form>


      </div>
      <div class="col-md-6 zeze">
<div class="mapouter"><div class="gmap_canvas"><iframe width="563" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Barangay%20Lantic%20Carmona%20Cavite&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://yt2.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:563px;}</style><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:563px;}</style></div></div>
      </div>
    </div>

  </div>


</section>
<!-- Learn Instruments -->




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
    <div class="fots ">

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
  <div class="fots  ">

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
  <div class="fots legal  ">

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

$( document ).ready(function() {

var d = new Date();
var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
var n = strDate.search("/");
var date = strDate.slice(0,n);
$('#date').text(date);

var em = $('#exampleFormControlInput1');
var txt = $('#exampleFormControlTextarea1');
$('#wawa').on('submit',function(e){
e.preventDefault();
$.ajax({

type:'post',
url:'contact.php',
data:{sub:1,ems:em.val(),mes:txt.val()},
success:function(res){
  var a = res.search("<!");
  var b = res.slice(0,a);
alert(b);

}




})






});
$('.notifclear').on('submit',function(e){
    e.preventDefault();
    var user_id=$(this).attr('id');
    $.ajax({
      type:'post',
      url:'userIndex.php',
      data:{idz:user_id},
      success:function(res){
        var str = res.search("<!");
        var sliced = res.slice(0,str);
        $('#trs').html(sliced);
          document.getElementsByClassName('zz')[0].textContent = '0 Notification';
      }

    })




});



});
</script>
  </body>
</html>
