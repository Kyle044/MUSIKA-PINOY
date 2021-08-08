
<?php

include_once 'class.php';
$user = $music->get_user_data();
if (!isset($user)) {
  header("Location:/vidTemp.php?id=81");

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
$connection = $music->openConnection();
$stmt1 = $connection->prepare("SELECT * FROM viewtbl WHERE uid=? AND vid=?");
$stmt1->execute([$user['id'],$id]);
$total1 = $stmt1->rowCount();
if ($total1==1) {


}
else {

   $music->view($id,$user['id']);
}

}
$music->upload();
$music->like();
$music-> comment_part2();

$music->clear_notif();
$music->support();




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
    <nav class="navbar navbar-expand-lg navbar-light nab sticky-top" >
    <div class="container">
      <a class="navbar-brand" href="/userIndex.php" style="margin-top:10px;"> MUSIKA PINOY</a>
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
        <a href="/userEdit.php?id=<?php echo$user['id']; ?>" class=" nav-link nab-links">Account </a>




       </li>
       <li class= 'nav-item dropdown'>
        <a class='nav-link dropdown-toggle zz' href='#' id='navbarDropdown' data-bs-display="static" role='button' data-bs-toggle='dropdown' aria-expanded='false'>
           Notification
        </a>
        <ul class='dropdown-menu dropdown-menu-sm-end' aria-labelledby='navbarDropdown'id='trs'>


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
                <li><a class='dropdown-item' href='/videoTemp.php?id=$wet'>".$post['message']."  ".$post['date']."  </a></li>";



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
    <div class="container-fluid " style="background:#222831;">
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
              <pre style="color:white; padding:1%;"> <?php $music->views($id); ?> Views      <?php echo$users['date_up']; ?> Date Uploaded</pre>
            </div>
            <div class="col-2">
           <span style="color:white; padding:1%;" id="vid1-Likes"><?php echo$music->likes($id); ?></span>  <a class='hidden like' href=''  id ='<?php echo$id;?>' role='button'><img src="/img/hart.png" class="img-fluid"alt="" ></a><a class=' hidden shet unlike' href=''  id ='<?php echo$id; ?>' role='button' style=""><img src="/img/harted.png" class="img-fluid" alt="" ></a>


            </div>
          </div>
          <div class="row">


                  <pre style="color:white; padding:1%;">  Uploaded By <a href="/accDash.php?id=<?php echo$users['uid']; ?>" class="aref"><?php echo$users['name']; ?></a>  </pre>
                      <a href='' id="<?php echo$users['uid'] ?>" class='btn btn-light support hidden'>Support</a>
                          <a href='' id="<?php echo$users['uid'] ?>" class='btn btn-light unsupport hidden'>Unsupport</a>
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
                  <input type="hidden" id="comType" value="<?php echo $id; ?>">
                    <input type="hidden" id="uid" value="<?php echo $user['name']; ?>">
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
              <?php $music->getUsersComment($id); ?>
            </div>
          </div>
        </div>
  		</div>
  		<div class="col-md-4" style="padding:3%;">

<?php $music->getUsersPost($id); ?>


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
        <a class="list-group-item list-group-item-action bg-dark text-light"  href="/aboutUser.php"  aria-controls="profile">Profile</a>
        <a class="list-group-item list-group-item-action bg-dark text-light"  href="/contactUser.php"  aria-controls="messages">Message</a>


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
  <?php
  $connection = $music->openConnection();
  $stmt1 = $connection->prepare("SELECT * FROM liketbl WHERE uid=? AND vid=?");
  $stmt1->execute([$user['id'],$id]);
  $total1 = $stmt1->rowCount();
  if ($total1==1) {

    echo "$('.unlike').addClass('visible').removeClass('hidden');  console.log('$total1');";
  }
  else {

      echo "$('.like').addClass('visible').removeClass('hidden');
              console.log('$total1');";
  }

  $stmt2 = $connection->prepare("SELECT * FROM subtbl WHERE uid=? AND poster_id=?");
  $stmt2->execute([$user['id'],$users['uid']]);
  $total2 = $stmt2->rowCount();
  if ($user['id']!=$users['uid']) {
    if ($total2==1) {

      echo "$('.unsupport').addClass('visible').removeClass('hidden');  console.log('$total1');";
    }
    else {

        echo "$('.support').addClass('visible').removeClass('hidden');
                console.log('$total1');";
    }


  }
  else{
    //Do nothing
  }

   ?>
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

  $.ajax({
  url:'videoTemp.php',
  type:'post',
  async:false,
  data:{
    'user':<?php echo $user['id']; ?>,
    'liked':1,
    'postid':postid
  },
  success:function(res){
  var str = res.search("<html");
  var syntax = res.slice(0,str);
  if (parseInt(syntax)==null) {
    syntax=0;
  }
  $('#vid1-Likes').text(syntax);



  }

  })

  });
  $('.unlike').click(function(e){
    e.preventDefault();
var postid = $(this).attr('id');
$(this).addClass('hidden').removeClass('visible');
$('.like').addClass('visible').removeClass('hidden');
$.ajax({
type:'POST',
url:'videoTemp.php',

async:false,
data:{
    'user':<?php echo $user['id']; ?>,
    'unliked':1,
    'postid':postid
},
success:function(res){
  var str = res.search("<html");
  var syntax = res.slice(0,str);
  if (parseInt(syntax)==null) {
    syntax=0;
  }
  $('#vid1-Likes').text(syntax);
}

})


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

    $.ajax({
      type:'POST',
      url:'videoTemp.php',
      data:{type:cond.val(),name:nema.val(),comment:text.val()},
      success: function(res){
        var length = res.search("<html");
        var output = res.slice(0,length);

        $('#ewanko').html(output);
      }
    })});
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
    $('.support').click(function(e){
      e.preventDefault();
    var postid = $(this).attr('id');
    var name = "<?php echo $user['name']; ?>";
      var uid = "<?php echo $user['id']; ?>";
      var ud =  "<?php echo $id;?>";
    $(this).addClass('hidden').removeClass('visible');
    $('.unsupport').addClass('visible').removeClass('hidden');
$.ajax({
  type:'post',
  url:'videoTemp.php',
  data:{'postid':postid,'userName':name,
  'supported':1,'user':uid,'id':ud

                        },
  success: function(res){
    var str = res.search("<html");
    var sliced = res.slice(0,str);

  }
})


    });
    $('.unsupport').click(function(e){
      e.preventDefault();
  var postid = $(this).attr('id');
  var uid = "<?php echo $user['id']; ?>";
      var ud =  "<?php echo $id;?>";
          var name = "<?php echo $user['name']; ?>";
  $(this).addClass('hidden').removeClass('visible');
  $('.support').addClass('visible').removeClass('hidden');

    $.ajax({
      type:'post',
      url:'videoTemp.php',
      data:{'postid':postid,'unsupported':1,'user':uid,'id':ud,'userName':name

                            },
      success: function(res){
        var str = res.search("<html");
        var sliced = res.slice(0,str);

      }
    })


    });
});

</script>
  </body>
</html>
