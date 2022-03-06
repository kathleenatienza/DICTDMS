<?php

include('security.php');

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class ="card-shadow-mb-4">
    <div class ="card-header-py-3">
        <h5 class ="m-0 font-weight-bold text-dark"> Admin Accounts
<a class="btn btn-primary float-right mb-4" href = "addregister.php" role="button"> Add Admin Accounts</a> 

<div class="card-body">


<div class ="table-responsive">


<?php


$query = "SELECT * FROM register";
$query_run = mysqli_query($connection, $query);

?>
<table class = "table table-boardered text-dark" id= "DataTable" width="100%" cellspacing="0">
<thead>
    <tr>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>EDIT</th>
        <th>DELETE</th>
    </tr>
</thead>
<tbody>
  
<?php
if(mysqli_num_rows($query_run) > 0)

{
  while ($row = mysqli_fetch_assoc($query_run))
   {

    ?>



    <tr>
        <td> <?php echo $row['username']; ?> </td>
        <td> <?php echo $row['fullname'];?> </td>
        <td> <?php echo $row['email']; ?> </td>
        <td>
        <form action="register-edit.php" method= "post">
        <input type="hidden" name = "edit_id" value = "<?php echo $row['id']; ?>">
        <button type ="submit" name="edit_btn" class = "btn btn-success">EDIT</button>
        </form>
        </td>

        <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
        </td>
    </tr>

    <?php
  }


}
else{
  echo "NO RECORD FOUND";
}
?>

</tbody>
</table>

</div>
</div>
</div>

</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
