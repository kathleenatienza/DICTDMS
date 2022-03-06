
<?php

include('security.php');

include('includes/header.php');
include('includes/navbar.php');
?>

<?php
// archive--
$connection = mysqli_connect($server_name,$db_username,$db_password);
$dbconfig = mysqli_select_db($connection,$db_name);
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $submit = $_POST['submit'];
    $ID = $_POST['ID'];
    $query = " UPDATE docu_try set status='$submit' where id=".$ID;
    $query_run = mysqli_query($connection, $query);
}
?>


<div class="container-fluid">
    <div class ="card-shadow-mb-4">
    <div class ="card-header-py-3">
        <h5 class ="m-0 font-weight-bold text-dark">Manage Documents</h5>

<div class="card-body">


<div class ="table-responsive">
    
<?php

$query = "SELECT * FROM docu_try where status='display'ORDER BY id DESC";
$query_run = mysqli_query($connection, $query);

?>
<table  id="DataTableMli" class = "table table-boardered text-dark" width="100%" cellspacing="0">
 <thead>
    <tr>
        <th>ID </th>
        <th>File Name</th>
        <th>File Type</th>
        <th>Date Uploaded</th>
        <th>File Size</th>
        <th>VIEW</th>
        <th>Download</th>
        <th>Archive</th>
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
        <td> <?php echo $row['ID']; ?> </td>
        <td> <?php echo $row['FileName']; ?> </td>
        <td> <?php echo $row['FileType'];?> </td>
        <td> <?php echo $row['date'];?> </td>
        <td> <?php echo $row['file_size'];?> </td>

       
        <td>
        <form action="#" method= "post">
        <input type="hidden" name = "edit_id" value = "<?php echo $row['ID']; ?>" >
        <button type ="submit" name="edit_btn" class = "btn btn-success" >VIEW</button>
        </form>
        </td>

        <td>
        <form action="#" method= "post">
        <input type="hidden" name = "edit_id" value = "<?php echo $row['ID']; ?>" >
        <button type ="submit" name="edit_btn" class = "btn btn-success">Download</button>
        </form>
        </td>

        <td>
        <form action="" method="post">
        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" />
        <button type ="submit" class = "btn btn-warning archive" name="submit" value="archive">Archive</button>
        </form>
          
		</td>

        <td>
        <form action="#" method="post" value = "<?php echo $row['ID']; ?>" >
        <input type="hidden" name="delete_id">
        <button type="submit" name="mlistdelete_btn" class="btn btn-danger"> DELETE</button>
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
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
