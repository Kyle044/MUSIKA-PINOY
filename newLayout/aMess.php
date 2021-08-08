
<?php

include_once 'class.php';
$user = $music->get_user_data();
if (!isset($user)) {
  header("Location:/index.php");

}
if ($user['access']!="admin") {
    header("Location:/index.php");
}

$music->upload();
$music->deletez();
$music->reply();
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

    <title>Musika Pinoy</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light nab sticky-top" >
    <div class="container">
      <a class="navbar-brand" href="/adminIndex.php" style="margin-top:10px;"> MUSIKA PINOY</a>
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
                <h3>Post a Video</h3>
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
                  <option value="SongLesson">Song Lesson</option>
                <option value="MusicTheory">Music Theory</option>
                <option value="Performance">Performance</option>
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
        <a href="/practice.php" id="export" class=" nav-link nab-links">Export Database </a>




       </li>
       <li class="nav-item">
     <a href="/aMess.php" id="export" class=" nav-link nab-links">Messages</a>




    </li>
       <li class="nav-item">

    <a href="/logout.php" class=" nav-link nab-links" onclick="return confirm('Are you Sure You Want To Log Out?')">Log Out</a>


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
        <h1 class="align-middle">Welcome <?php echo$user['name']; ?></h1>
      </div>

		</div>
	</div>

</div>


<section class="second-section">
<!-- Categories -->
<h3 class="a">Table of Messages!</h3>
<div class="container ">

  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Message</th>
        <th scope="col">Date</th>

        <th scope="col">Options</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody id="target1">
      <?php
      $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      function generate_string($input, $strength = 5) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}
$length=6;
      $connection= $music->openConnection();

      $stmt = $connection->prepare("SELECT * FROM messtbl");
        $stmt->execute();
        $posts = $stmt->fetchAll();
        $userCount = $stmt->rowCount();
        if ($userCount > 0)
        {
          foreach ($posts as $post) {
          $id =   generate_string($permitted_chars,$length).$post['id'];
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

       ?>


    </tbody>
  </table>




</div>


</section>
<center><button  style="text-align:center;" type="button" onclick="window.print()" name="button" class="btn btn-success">Print</button></center>








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
  var d = new Date();
  var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
  var n = strDate.search("/");
  var date = strDate.slice(0,n);
  $('#date').text(date);

  $(document).on("submit", ".aps", function (e) {

    e.preventDefault();
    var post_id = $(this).attr('id');


  // Save it!
  $.ajax({
    type:'POST',

    url:'aMess.php',
    data:{apr:post_id},

    success:function(res){
      var lastindex = res.search("<!doctype");
      var data = res.slice(0,lastindex);
        $('#target1').html(data);







      }
  })




     });

     $(document).on("submit", ".rep", function (e) {

       e.preventDefault();
       var post_id = $(this).attr('id');
       var mess = $(this).find("textarea").val();


     // Save it!
     $.ajax({
       type:'POST',

       url:'aMess.php',
       data:{repz:post_id,mess:mess},

       success:function(res){
         var lastindex = res.search("<!doctype");
         var data = res.slice(0,lastindex);
         alert(data);







         }
     })




        });

     $(document).on("submit", ".dec", function (e) {

       e.preventDefault();
       var post_id = $(this).attr('id');

       if (confirm('Are you sure you want to Delete the Message?')) {
     // Save it!
     $.ajax({
       type:'POST',
       url:'aMess.php',
       data:{decs:post_id},
       success:function(res){
         var lastindex = res.search("<!doctype");
         var data = res.slice(0,lastindex);

    $('#target1').html(data);


         }
     })

   }
       else {
         // Do nothing!
         console.log('This thing was not declined.');
       }

        });



        $(document).on("submit", ".del", function (e) {

          e.preventDefault();
          var post_id = $(this).attr('id');

          if (confirm('Are you sure you want to delete this to the website?')) {
        // Save it!
        $.ajax({
          type:'POST',
          url:'aMess.php',
          data:{del:post_id},
          success:function(res){
            var lastindex = res.search("<!doctype");
            var datas = res.slice(0,lastindex);
              $('#fuck').html(datas);}
        })

        }
          else {
            // Do nothing!
            console.log('Nothing Happened.');
          }

           });





});

</script>
  </body>
</html>
