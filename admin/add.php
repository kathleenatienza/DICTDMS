
<?php

include('security.php');

include('includes/header.php');
include('includes/navbar.php');
?>

<?php
// upload
$connection = mysqli_connect($server_name,$db_username,$db_password);
$dbconfig = mysqli_select_db($connection,$db_name);
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $submit = $_POST['submit'];
    $ID = $_POST['ID'];
    $query = " UPDATE docu_try set upload='$submit' where id=".$filetoUpload;
    $query_run = mysqli_query($connection, $query);
    
}
?>

<?php 
          
          $query = "SELECT * FROM docu_try ORDER BY id DESC";
          $query_run = mysqli_query($connection, $query);

          if (mysqli_num_rows($query_run) > 0) {
          	while ($filetoUpload = mysqli_fetch_assoc($query_run)) {  ?>
             
             <div class="alb">
             	<file src="aupload/<?=$filetoUpload['file_url']?>">
             </div>
          		
    <?php } }?>

<!-- Button trigger modal -->

<!-- Modal -->

<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
<div class="container-fluid">
    <div class ="card-shadow-mb-4">
    <div class ="card-header-py-3">
    <h5 class ="m-0 font-weight-bold text-dark">Add Documents</h5>

 <form  action="upload.php"method="post" enctype="multipart/form-data">
 <input type="file" name="filetoUpload" id="filetoUpload">
 <button type="submit" name = "submit" class = "btn btn-success" value = "Upload">Upload</button>
</form>

<div class="card-body">


<div class ="table-responsive">

<?php

$query = "SELECT * FROM docu_try where upload='display'ORDER BY id DESC";
$query_run = mysqli_query($connection, $query);

?>

 
    
<?php

$query = "SELECT * FROM docu_try ORDER BY id DESC";
$query_run = mysqli_query($connection, $query);

?>
<table  id="DataTableMli" class = "table table-boardered text-dark" width="100%" cellspacing="0">
 <thead>
    <tr>
        <th>ID </th>
        <th>File Name</th>
        <th>File Type</th>
        <th>Date Uploaded</th>
        <th>Download</th>
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
    
}
    <tr>
        
        <td> <?php echo $row['ID']; ?> </td>
        <td> <?php echo $row['FileName']; ?> </td>
        <td> <?php echo $row['FileType'];?> </td>
        <td> <?php echo $row['date'];?> </td>

       
        <td>
        <form action="#" method= "post">
        <input type="hidden" name = "edit_id" value = "<?php echo $row['id']; ?>">
        <button type ="submit" name="edit_btn" class = "btn btn-success">Download</button>
        </form>
        </td>

        <td>
                <form action="#" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
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
