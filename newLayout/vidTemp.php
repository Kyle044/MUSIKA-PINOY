
<?php

include_once 'class.php';
$user = "user";
if ($user=="user") {


}
else {
  header("Location:/videoTemp.php?id=81");
}
if (isset($_GET['id'])) {
$id=$_GET['id'];
if ($music->check_page_exist($id)==1) {

}
else{
  header("Location:/Page404.php");
}
$connection = $music->openConnection();
$stmt = $connection->prepare("SELECT * FROM aposttbl  WHERE apost_id=? ");
$stmt->execute([$id]);
$users = $stmt->fetch();
$userCount = $stmt->rowCount();


}

$music->like();
$music-> comment_part2();







 ?>





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

    <title>Musika Pinoy</title>
    <style >
      .aref{
        text-decoration:none; color:white;

      }
      .aref:hover{
         color:rgb(0,173,181);
      }
      .shet{
        position: relative;
        left:-33%;
      }
      .hidden{
        visibility: hidden;
      }
      .visible{
        visibility: visible;
      }
      .com-card{
        width: 100%;
color: white;


      }
      .com-card h5 {
          margin-top: 3%;
          margin-bottom: 2%;
      }
      .date {

      float: right;
      margin-top: -10%;

    }
    .footer {
    height: 50%;
    background-color: #393e46;
    padding: 30px;
}
    </style>
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
    </nav><div class="container-fluid " style="background:#222831;">
  	<div class="row">
  		<div class="col-md-8" style="padding:3%; height: 100%;">
        <div class="video-frame"  >
          <video  controls=""style="width:100%;     height: 26rem;"  controlsList="nodownload">
            <source src="/post/<?php echo$users['fileName']; ?>" type="video/mp4">
          </video>
        </div>
        <div class="col-12" >
          <div class="row">
            <div class="col-12">
              <h3 style="color:white; padding:1%; "><?php echo$users['postName']; ?></h3>

            </div>
          </div>
          <div class="row">
            <div class="col-10">
              <pre style="color:white; padding:1%;"> <?php $music->views($id); ?> Views      <?php echo$users['date_up']; ?> Date Uploaded

 Uploaded By <a href="/accDash.php?id=<?php echo$users['uid']; ?>" class="aref"><?php echo$users['name']; ?></a> </pre>

            </div>
            <div class="col-2">
           <span style="color:white; padding:1%;" id="vid1-Likes"><?php echo$music->likes($id); ?></span>  <a class='visible like' href=''  id ='<?php echo$id;?>' role='button'><img src="/img/hart.png" alt="" ></a><a class=' hidden shet unlike' href=''  id ='<?php echo$id; ?>' role='button' style=""><img src="/img/harted.png" alt="" ></a>


            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <hr style="color:white;">
              <h5 style="color:white; padding:1%;">Description</h5>
              <p style="color:white; padding:1%;"><?php echo$users['description']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <hr style="color:white;">
              <h5 style="color:white; padding:1%;">Comments</h5>
              <form action="" method="post" id="Video1">
                <textarea class="form-control" id="text-area" rows="3"></textarea>
                  <input type="hidden" id="comType" value="">
                    <input type="hidden" id="uid" value="">
                    <button class="btn btn-dark com-sub" type="submit" id="com-btn">
                      Comment
                    </button>
                    <button class="btn btn-dark cancel" type="button" id="can-btn">
                      Cancel
                    </button>
                      </form>












            </div>
          </div>
          <div class="row ">
            <div class="col-12 " id="ewanko">

            </div>
          </div>
        </div>
  		</div>
  		<div class="col-md-4" style="padding:3%;">


      <?php $music->getUsersPosts($id); ?>



  		</div>
  	</div>
  </div>
	</div>

</div>


<section class="">



</section>
<!-- NewsFeed -->

<section class="">


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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>


$( document ).ready(function() {
  <?php $music->register();?>

  var d = new Date();
  var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
  var n = strDate.search("/");
  var date = strDate.slice(0,n);
  $('#date').text(date);


  $('.like').click(function(e){
    e.preventDefault();
  var postid = $(this).attr('id');
  $(this).addClass('hidden').removeClass('visible');
  $('.unlike').addClass('visible').removeClass('hidden');

alert("Sign in to Access!");

  });
  $('.unlike').click(function(e){
    e.preventDefault();
var postid = $(this).attr('id');
$(this).addClass('hidden').removeClass('visible');
$('.like').addClass('visible').removeClass('hidden');

alert("Sign in to Access!");

  });
  $('#com-btn').hide();
  $('#can-btn').hide();
  $('#text-area').on('click',function(){
    $('#com-btn').show();
    $('#can-btn').show();
  });
  $('#can-btn').on('click',function(){
    $('#com-btn').hide();
    $('#can-btn').hide();

  });
  var cond = $('#comType');
  var nema =$('#uid');
  var text = $('#text-area');
  //
  $('#Video1').on('submit',function(e){
    e.preventDefault();
alert("You must be Signed in to Comment!");
    });
});

</script>
  </body>
</html>
