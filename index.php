<?php include('include/header.php');?>

<?php include('include/navbar.php');?>

<!-- Full Page Intro -->


<!--Main layout-->
<body>
  
<main>
<div class="container mt-5 pt-5">

  <!--Section: Main info-->
  <section class="mt-5 wow fadeIn">

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-md-6 mb-4">
      <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM ambassadog";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
        <h5 class="text-primary ms-3"><?php echo nl2br($row['title']);?>  <strong><?php echo nl2br($row['petname']);?></strong> </h5> 
        <img src="admin/aupload/<?php echo $row['file'];  ?>" class="img-fluid justify-content-center" width = "440" height = "300" alt="img">
        <?php
        }
      }
      else
      {
        echo "NO RECORD FOUND";
      }
      ?> 
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-6 mb-4">
      <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM home";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>   
        <!-- Main heading -->
        <h4 class = "card-title" > <?php echo nl2br($row['title']);?> </h4>
        <hr>
         <p class = "card-subtitle" > <?php echo nl2br($row['subtitle']);?> <p>
           <p> <?php echo $row['descript'];?> </p>
           <p class = "card-text" > <?php echo $row['links'];?> </p>
        <!-- Main heading -->
       
           <?php
        }
      }
      else
      {
        echo "NO RECORD FOUND";
      }
      ?> 
        <!-- CTA -->
        <a target="_blank" href="https://web.facebook.com/aspinacademy"  target="_blank" rel="noopener noreferrer" class="btn btn-indigo btn-md">Facebook Page
          <i class="fa fa-facebook-square fa-1x"></i>
        </a>
        <a target="_blank" href="https://www.youtube.com/c/ASPINACADEMY"  target="_blank" rel="noopener noreferrer" class="btn btn-indigo btn-md">Youtube Channel
          <i class="fa fa-youtube fa-1x"></i>
        </a>
        <a target="_blank" href="https://www.instagram.com/aspinacademy/"  target="_blank" rel="noopener noreferrer" class="btn btn-indigo btn-md">Instagram Page
          <i class="fa fa-instagram fa-1x"></i>
        </a>
      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </section>
  <!--Section: Main info-->

  <section>
<div class="container py-5">
  <h3 class="h3 text-center mb-4">Journey of Aspin Academy <img src="https://img.icons8.com/office/40/000000/dog-park.png"/></h3> 
    <div class="main-timeline-2">
      <div class="timeline-2 left-2">
        <div class="card">
          <img src="img/tl1.PNG" class="card-img-top d-block w-100 h-300" alt="Responsive image"> 
<!-- Carousel wrapper -->
          <div class="card-body p-4">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM timeline WHERE id='1'";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
            <h4 class="fw-bold mb-4"><?php echo nl2br($row['title']);?> </h4>
            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2019</p>
            <p class="mb-0"><?php echo nl2br($row['descript']);?> </p>
          </div>
        </div>
      </div>

      <?php
    }
  }
  else
  {
    echo "NO RECORD FOUND";
  }
  ?> 
      <div class="timeline-2 right-2">
      <div class="card">
          <img src="img/tl5.PNG" class="card-img-top d-block w-100 h-300" alt="Responsive image">
    <div class="card-body p-4">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM timeline WHERE id='2'";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
            <h4 class="fw-bold mb-4"><?php echo nl2br($row['title']);?> </h4>
            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2020</p>
            <p class="mb-0"><?php echo nl2br($row['descript']);?> </p>
          </div>
        </div>
      </div>

      <?php
    }
  }
  else
  {
    echo "NO RECORD FOUND";
  }
  ?> 
      <div class="timeline-2 left-2">
      <div class="card">
      <img src="img/tl12.PNG" class="card-img-top d-block w-100 h-300" alt="Responsive image">
<div class="card-body p-4">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM timeline WHERE id='3'";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
            <h4 class="fw-bold mb-4"><?php echo nl2br($row['title']);?> </h4>
            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2020</p>
            <p class="mb-0"><?php echo nl2br($row['descript']);?> </p>
          </div>
        </div>
      </div>

      <?php
    }
  }
  else
  {
    echo "NO RECORD FOUND";
  }
  ?> 

      <div class="timeline-2 right-2">
        <div class="card">
        <img src="img/newtl5.PNG" class="card-img-top d-block w-100 h-300" alt="Responsive image">
       <div class="card-body p-4">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM timeline WHERE id='4'";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
            <h4 class="fw-bold mb-4"><?php echo nl2br($row['title']);?> </h4>
            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2021</p>
            <p class="mb-0"><?php echo nl2br($row['descript']);?> </p>
          </div>
        </div>
      </div>

      <?php
    }
  }
  else
  {
    echo "NO RECORD FOUND";
  }
  ?> 
      <div class="timeline-2 left-2">
        <div class="card">
        <img src="img/tlf3.PNG" class="card-img-top d-block w-100 h-300" alt="Responsive image">
<div class="card-body p-4">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT * FROM timeline WHERE id='5'";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>
            <h4 class="fw-bold mb-4"><?php echo nl2br($row['title']);?> </h4>
            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2021</p>
            <p class="mb-0"><?php echo nl2br($row['descript']);?> </p>
          </div>
        </div>
      </div>

      <?php
    }
  }
  else
  {
    echo "NO RECORD FOUND";
  }
  ?> 
    </div>
  </div>
  </div>
  </div>
</section>



  <!--Section: Main features & Quick Start-->
  <section class="container-fluid">

    <h3 class="h3 text-center fs-2 mb-4 ">More About the Aspin Academy <img src="https://img.icons8.com/office/40/000000/about.png"/></h3>

    <!--Grid row-->
    <div class="container">
    <div class="row wow fadeIn">

      <!--Grid column-->
      <div class="col-lg-6 col-md-12 px-4 mt-4">
      
      <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT title,details FROM info WHERE id='1' ";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>  
          <div class="row">
          <div class="col-1 mx-3">
          <img src="https://img.icons8.com/officel/40/000000/dog-footprint.png"/>
          </div>
     
          <div class="col-10">
            <h5 class="feature-title"><?php echo $row['title'];?></h5>
            <p class="grey-text"><?php echo $row['details'];?> </p>
          </div>
        </div>
           <?php
        }
      }
      else
      {
        echo "NO RECORD FOUND";
      }
      ?> 
        <!--First row-->

        <!--/First row-->

        <div style="height:30px"></div>

        <!--Second row-->
        <div class="row">
        <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT title,details FROM info WHERE id='2' ";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>  
          <div class="row">
          
          <div class="col-1 mx-3">
          <img src="https://img.icons8.com/officel/40/000000/worldwide-location.png"/>
          </div>
     
          <div class="col-10">
            <h5 class="feature-title"><?php echo $row['title'];?></h5>
            <p class="grey-text"><?php echo $row['details'];?> </p>
          </div>
        </div>
        </div>
           <?php
        }
      }
      else
      {
        echo "NO RECORD FOUND";
      }
      ?>
         
        <!--/Second row-->

        <div style="height:30px"></div>

        <!--Third row-->
        <div class="row">
          <?php
      require ('admin/database/dbconfig.php');

      $query = "SELECT title,details FROM info WHERE id='3' ";
      $query_run = mysqli_query($connection, $query);

      if(mysqli_num_rows($query_run) > 0)
      {
        foreach($query_run as $row)
        {
          ?>  
          <div class="row">
          
          <div class="col-1 mx-3">
          <img src="https://img.icons8.com/officel/40/000000/user-group-man-woman.png"/>
          </div>
      
          <div class="col-10">
            <h5 class="feature-title"><?php echo $row['title'];?></h5>
            <p class="grey-text"><?php echo $row['details'];?> </p>
          </div>
        </div>
           <?php
        }
      }
      else
      {
        echo "NO RECORD FOUND";
      }
      ?>
        </div>
        <!--/Third row-->

      </div>
      <!--/Grid column-->

      <!--Grid column-->
      <div class="col-lg-6 col-md-12">

        <p class="h5 text-center mb-4">Watch and Visit Our Youtube Channel</p>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://youtube.com/embed/x2G6nHqRZkU" allowfullscreen></iframe>
        </div>
      </div>
      <!--/Grid column-->
      </div>
      </div>      
    </div>
    <!--/Grid row-->

  </section>
  <!--Section: Main features & Quick Start-->

  <hr class="my-3">

  <!--Section: Not enough-->

  <!--Section: Not enough-->


  <!--Section: More-->
 


</section>



    <!-- Single item -->
    

      </div>
      <!--Grid column-->

      <!--Grid column-->
     
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </section>
</main>

<hr class="my-5">
<!--Main layout-->

</body>


<?php include('include/footer.php');?>