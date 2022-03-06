<?php

include('security.php');

include('includes/header.php');
include('includes/navbar.php');
?>



<div class="container-fluid">
    <div class ="card-shadow-mb-4">
    <div class ="card-header-py-3">
    <h5 class ="m-0 font-weight-bold text-dark">Uploaded Documents</h5>
 <!-- <button type="button" class="btn btn-primary py-2" data-toggle="modal" data-target="#addhomepage">
       Edit Homepage Info
</button> -->

<div class="card-body">

<div class ="table-responsive">


    
<?php




?>


<?php
  if (isset($_POST['submit']) && isset($_FILES['filetoUpload'])){
    
    

    
 
    $fileName = $_FILES['filetoUpload']['name'];
    $fileTmpName = $_FILES['filetoUpload']['tmp_name'];
    $fileSize = $_FILES['filetoUpload']['size'];
    $fileError = $_FILES['filetoUpload']['error'];
    $fileType = $_FILES['filetoUpload']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
$allowed = array ('docx','pdf','html','xlsx','txt','csv','cvs','pptx','ppt','zip','xls');
if (in_array($fileActualExt, $allowed)){
  if ($fileError === 0){
    if ($fileSize < 100000000){
      $fileNameNew = uniqid("DICT-", true).".".$fileActualExt;
      $date = date('m-j-y');
      $fileDestination = 'aupload/'.$fileNameNew;
      move_uploaded_file( $fileTmpName,$fileDestination);
      $query = "INSERT * FROM docu_try";
$query_run = mysqli_query($connection, $query);

//insert database
$sql = "INSERT INTO docu_try(FileName , FileType , file_size , date , file_url) VALUES('$fileName','$fileType','$fileSize', '$date' , '$fileNameNew')";
mysqli_query($connection, $query);
				


    }else{
      echo "Your file is too big";
    }

  }else{
    echo "There was an error uploading your file";
    
  }


}else{
  echo "You cannot upload files of thid type";
}
  }
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
        <th>File Size</th>
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
        <td> <?php echo $row['file_size'];?> </td>

       

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

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>