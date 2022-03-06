<?php

include('security.php');


// Registister PHP CODE

if(isset($_POST['registerbtn']))
{
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $fullname = mysqli_real_escape_string($connection,$_POST['fullname']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $cpassword = mysqli_real_escape_string($connection,$_POST['confirmpassword']);
    $usertype = mysqli_real_escape_string($connection,$_POST['usertype']);

    $username_query = "SELECT * FROM register WHERE username='$username' ";
    $username_query_run = mysqli_query($connection, $username_query);
    if(mysqli_num_rows($username_query_run) > 0)
    {
        $_SESSION['status'] = "Username Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: addregister.php');  
    }
    else
    {
    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {


        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,fullname,email,password,usertype) VALUES ('$username','$fullname','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION ['status_code'] = 'success';
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION ['status_code'] = "error";
                header('Location: addregister.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION ['status_code'] = "warning";
            header('Location: addregister.php');  
        }
         
    }
} 
}

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = mysqli_real_escape_string($connection,$_POST['edit_username']);
    $fullname = mysqli_real_escape_string($connection,$_POST['edit_fullname']);
    $email = mysqli_real_escape_string($connection,$_POST['edit_email']);
    $currentpassword = mysqli_real_escape_string($connection,$_POST['cu_password']);
    $password = mysqli_real_escape_string($connection,$_POST['edit_password']);
    $usertypeupdate = mysqli_real_escape_string($connection,$_POST['update_usertype']);

    if($currentpassword == $password)
    {
        $_SESSION['status'] = "Your Current password is match with your new password";
        $_SESSION['status_code'] = "warning";
        header('Location: register.php');
    }
    else 
    {
   
    $cpassword = "SELECT * FROM register where id = '$id'";
    $query_runn = mysqli_query($connection, $cpassword);
    $cpass = mysqli_fetch_array($query_runn);

    if($cpass['password'] == $currentpassword)
    {
    $query = "UPDATE register SET username='$username', fullname='$fullname',  email='$email', password='$password', usertype = '$usertypeupdate' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = 'success';
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    } 
  
}
else
{
    $_SESSION['status'] = "Password Not Match";
    $_SESSION['status_code'] = "error";
    header('Location: register.php'); 
}
    }

}

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

// LOGIN PHP CODE

if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Email or Password is Invalid";
        header('Location: login.php');
   }
    
}

// hOMEPAGE EDIT CODE

if (isset($_POST['homesave']))
{
    $title = mysqli_real_escape_string($connection,$_POST['title']);
    $subtitle = mysqli_real_escape_string($connection,$_POST['subtitle']);
    $descript = mysqli_real_escape_string($connection,$_POST['descript']);
    $links = mysqli_real_escape_string($connection,$_POST['links']);

    $query = "INSERT INTO home (title,subtitle,descript,links) VALUES ('$title','$subtitle','$descript', '$links')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['success'] = "Homepage infos are added";
    $_SESSION ['status_code'] = "success";
    header('Location: home.php');
    }
    else
    {
    $_SESSION['success'] = "Homepage infos are not added";
    $_SESSION ['status_code'] = "error";
    header('Location: home.php');
    }
    
}

if(isset($_POST['homeupdatebtn']))
{
    $id = $_POST['edit_id'];
    $title = mysqli_real_escape_string($connection, $_POST['edit_title']);
    $subtitle = mysqli_real_escape_string($connection, $_POST['edit_subtitle']);
    $descript = mysqli_real_escape_string($connection, $_POST['edit_descript']);
    $links = $_POST['edit_links'];

    $query = "UPDATE home SET title='$title', subtitle='$subtitle',  descript='$descript', links='$links' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: home.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: home.php'); 
    }
}


if(isset($_POST['homedelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM home WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: home.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: home.php'); 
    }    
}


// hOMEPAGE MORE EDIT CODE

if (isset($_POST['home2save']))
{
    $announce = mysqli_real_escape_string($connection,$_POST['announce']);
    $description = mysqli_real_escape_string($connection,$_POST['description']);

    $query = "INSERT INTO home2 (announce,description) VALUES ('$announce','$description')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "Homepage infos are added";
    $_SESSION ['status_code'] = "success";
    header('Location: home2.php');
    }
    else
    {
    $_SESSION['status'] = "Homepage infos are not added";
    $_SESSION ['status_code'] = "error";
    header('Location: home2.php');
    }
    
}

if(isset($_POST['homeupdatebtn2']))
{
    $id = $_POST['edit_id'];
    $announce = mysqli_real_escape_string($connection,$_POST['edit_announce']);
    $description = mysqli_real_escape_string($connection,$_POST['edit_description']);

    $query = "UPDATE home2 SET announce='$announce',  description='$description' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: home2.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: home2.php'); 
    }
}


if(isset($_POST['homedelete2_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM home2 WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: home2.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: home2.php'); 
    }    
}

if(isset($_POST['donatorsupdatebtn']))
{
    $id = $_POST['edit_id'];
    $donators =  mysqli_real_escape_string($connection, $_POST['edit_donator']);
    $donation =  mysqli_real_escape_string($connection, $_POST['edit_donation']);
    $amount =  mysqli_real_escape_string($connection, $_POST['edit_amount']);

    $query = "UPDATE donators SET donators='$donators', donation='$donation', amount='$amount' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: donators.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: donators.php'); 
    }
}


// PET PROFILES

if(isset($_POST['petsave']))
{
    $name = mysqli_real_escape_string($connection, $_POST['petname']);
    $type = mysqli_real_escape_string($connection, $_POST['pettype']);
    $gender = mysqli_real_escape_string($connection, $_POST['petgender']);
    $age = mysqli_real_escape_string($connection, $_POST['petage']);
    $date = mysqli_real_escape_string($connection, $_POST['petdate']);
    $place = mysqli_real_escape_string($connection, $_POST['petplace']);
    $descript = mysqli_real_escape_string($connection, $_POST['petdescript']);
    $avail = mysqli_real_escape_string($connection, $_POST['petavail']);
    $file = mysqli_real_escape_string($connection, $_FILES["petfile"]['name']);

    $validate_img_extension = $_FILES["petfile"]["type"]=="image/jpg" ||
    $_FILES["petfile"]["type"]=="image/png" ||
    $_FILES["petfile"]["type"]=="image/jpeg";

    if($validate_img_extension)
    {
    if(file_exists("upload/" . $_FILES["petfile"]["name"]))
    {
        $store = $_FILES["petfile"]["name"];
        $_SESSION['status'] = "Image already Exists. '. $store.'";
        $_SESSION ['status_code'] = "warning";
        header('Location: petadopt.php');
    }
    else
    {
            $query = "INSERT INTO petadopt (name, type, gender, age, date, place, descript, avail, file) VALUES ('$name','$type','$gender','$age','$date','$place','$descript','$avail','$file')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["petfile"]["tmp_name"], "upload/".$_FILES["petfile"]["name"]);
                $_SESSION['status'] = "Pet Profile is Added";
                $_SESSION ['status_code'] = "success";
                header('Location: petadopt.php'); 
            }
            else
            {
                $_SESSION['status'] = "Pet  Profile is Not Added";
                $_SESSION ['status_code'] = "error";
                header('Location: petadopt.php'); 
        }
    }
}
else
{
    $_SESSION['status'] = "ONLY PNG, JPG AND JPEG IMAGES ARE ALLOWED";
    header('Location: petadopt.php');
}
}


if(isset($_POST['adoptupdatebtn']))
{
    $id = $_POST['edit_id'];
    $name =  mysqli_real_escape_string($connection, $_POST['edit_name']);
    $type =  mysqli_real_escape_string($connection, $_POST['edit_type']);
    $gender =  mysqli_real_escape_string($connection, $_POST['edit_gender']);
    $age =  mysqli_real_escape_string($connection, $_POST['edit_age']);
    $breed =  mysqli_real_escape_string($connection, $_POST['edit_breed']);
    $date =  mysqli_real_escape_string($connection, $_POST['edit_date']);
    $place =  mysqli_real_escape_string($connection, $_POST['edit_place']);
    $descript =  mysqli_real_escape_string($connection, $_POST['edit_descript']);
    $avail =  mysqli_real_escape_string($connection, $_POST['edit_avail']);


    $file = $_FILES["edit_petfile"]['name'];

    $adopt_query = "SELECT * FROM petadopt WHERE id ='$id' ";
    $adopt_query_run = mysqli_query($connection, $adopt_query);
    foreach($adopt_query_run as $rows)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $img_data = $rows['file'];
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
             if($img_path = "upload/".$rows['file'])
            {
                unlink($img_path);
                $img_data = $file;
            }
            
        }
    }


    $query = "UPDATE petadopt SET name='$name', type='$type', gender='$gender', age='$age', breed='$breed', date='$date', place='$place', descript='$descript', avail='$avail', file='$file' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $_SESSION['status'] = "Pet Profile is Updated Successfully";
        $_SESSION ['status_code'] = "success";
        header('Location: petadopt.php');
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
        move_uploaded_file($_FILES["edit_petfile"]["tmp_name"], "upload/".$_FILES["edit_petfile"]["name"]);
        $_SESSION['status'] = "Pet Profile is Updated Successfully";
        $_SESSION ['status_code'] = "success";
        header('Location: petadopt.php');
        
        }
    }
    else
    {
        $_SESSION['status'] = "Pet  Profile is Not Updated";
        $_SESSION ['status_code'] = "error";
        header('Location: petadopt.php');  
    }
}


if(isset($_POST['adoptdelete_btn']))
{
    $id = $_POST['delete_id'];

    $check_query = "SELECT * FROM petadopt WHERE id ='$id' ";
    $check_query_run = mysqli_query($connection, $check_query);
    foreach($check_query_run as $rows)
    {
       if($img_path = "upload/".$rows['file'])
       {
         $query = "DELETE FROM petadopt WHERE id='$id' ";
         $query_run = mysqli_query($connection, $query);

         if($query_run)
       {
         unlink($img_path);
         $_SESSION['status'] = "Your Pet Profile is Deleted";
         $_SESSION['status_code'] = "success";
         header('Location: petadopt.php'); 
        }
         else
        {
        $_SESSION['status'] = "Your Pet Profile is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: petadopt.php'); 
        }    
     }
    }

    
}

if(isset($_POST['adrequpdatebtn']))
{
    $id = $_POST['edit_id'];
    $petname =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_petname']));
    $fullname = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_name']));
    $email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_email']));
    $address = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_address']));
    $mobile = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_mobile']));
    $amobile = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_amobile']));
    $exp = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_exp']));
    $agree = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_agree']));
    $stat = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_status']));

    $query = "UPDATE adopt SET petname='$petname', fullname='$fullname', email='$email', addre='$address', mobile='$mobile',  amobile='$amobile',  expir='$exp', agree='$agree', stat='$stat' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: adrequest.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: adrequest.php'); 
    }
}


if(isset($_POST['adreqdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM adopt WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: adrequest.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: adrequest.php'); 
    }    
}

if(isset($_POST['petlfsave']))
{
    $name = mysqli_real_escape_string($connection, $_POST['petname']);
    $type = mysqli_real_escape_string($connection, $_POST['pettype']);
    $date = mysqli_real_escape_string($connection, $_POST['petdate']);
    $place = mysqli_real_escape_string($connection, $_POST['petplace']);
    $gender = mysqli_real_escape_string($connection, $_POST['petgender']);
    $breed = mysqli_real_escape_string($connection, $_POST['petbreed']);
    $age = mysqli_real_escape_string($connection, $_POST['petage']);
    $descript = mysqli_real_escape_string($connection, $_POST['petdescript']);
    $collar = mysqli_real_escape_string($connection,  $_POST['petcollar']);
    $avail = mysqli_real_escape_string($connection,  $_POST['petavail']);
    $file = mysqli_real_escape_string($connection, $_FILES["petfile"]['name']);

    $validate_img_extension = $_FILES["petfile"]["type"]=="image/jpg" ||
    $_FILES["petfile"]["type"]=="image/png" ||
    $_FILES["petfile"]["type"]=="image/jpeg";

    if($validate_img_extension)
    {
    if(file_exists("lfupload/" . $_FILES["petfile"]["name"]))
    {
        $store = $_FILES["petfile"]["name"];
        $_SESSION['status'] = "Image already Exists. '. $store.'";
        $_SESSION ['status_code'] = "warning";
        header('Location: lostandfound.php');
    }
    else
    {
            $query = "INSERT INTO petlf (name, type, date, place, gender, breed, age, descript, collar, avail, file) VALUES ('$name', '$type', '$date','$place', '$gender', '$breed','$age', '$descript','$collar','$avail','$file')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["petfile"]["tmp_name"], "lfupload/".$_FILES["petfile"]["name"]);
                $_SESSION['status'] = "Pet Lost & Found Profile is Added";
                $_SESSION ['status_code'] = "success";
                header('Location: lostandfound.php'); 
            }
            else
            {
                $_SESSION['status'] = "Pet Lost & Found Profile is Not Added";
                $_SESSION ['status_code'] = "error";
                header('Location: lostandfound.php'); 
        }
    }
}
else
{
    $_SESSION['status'] = "ONLY PNG, JPG AND JPEG IMAGES ARE ALLOWED";
    $_SESSION ['status_code'] = "warning";
    header('Location: lostandfound.php');
}
}

if(isset($_POST['lfupdatebtn']))
{
    $id = $_POST['edit_id'];
    $name = mysqli_real_escape_string($connection, $_POST['edit_name']);
    $type = mysqli_real_escape_string($connection, $_POST['edit_type']);
    $date = mysqli_real_escape_string($connection,  $_POST['edit_date']);
    $place = mysqli_real_escape_string($connection, $_POST['edit_place']);
    $gender = mysqli_real_escape_string($connection, $_POST['edit_gender']);
    $breed = mysqli_real_escape_string($connection, $_POST['edit_breed']);
    $age = mysqli_real_escape_string($connection, $_POST['edit_age']);
    $descript = mysqli_real_escape_string($connection, $_POST['edit_descript']);
    $collar = mysqli_real_escape_string($connection, $_POST['edit_collar']);
    $avail = mysqli_real_escape_string($connection, $_POST['edit_avail']);


    $file = $_FILES["edit_petfile"]['name'];

    $adopt_query = "SELECT * FROM petlf WHERE id ='$id' ";
    $adopt_query_run = mysqli_query($connection, $adopt_query);
    foreach($adopt_query_run as $rows)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $img_data = $rows['file'];
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
             if($img_path = "lfupload/".$rows['file'])
            {
                unlink($img_path);
                $img_data = $file;
            }
            
        }
    }


    $query = "UPDATE petlf SET name='$name', type='$type', date='$date', place='$place', gender='$gender', breed='$breed', age='$age',  descript='$descript', collar='$collar', avail='$avail', file='$file' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $_SESSION['status'] = "Pet Profile is Updated Successfuly";
        $_SESSION ['status_code'] = "success";
        header('Location: lostandfound.php');
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
        move_uploaded_file($_FILES["edit_petfile"]["tmp_name"], "lfupload/".$_FILES["edit_petfile"]["name"]);
        $_SESSION['status'] = "Pet Profile Updated With New  Image And Delete the old image";
        $_SESSION ['status_code'] = "success";
        header('Location: lostandfound.php');
        
        }
    }
    else
    {
        $_SESSION['status'] = "Pet  Profile is Updated Successfully";
        $_SESSION ['status_code'] = "error";
        header('Location: lostandfound.php');  
    }
}


if(isset($_POST['lfdelete_btn']))
{
    $id = $_POST['delete_id'];

    $check_query = "SELECT * FROM petlf WHERE id ='$id' ";
    $check_query_run = mysqli_query($connection, $check_query);
    foreach($check_query_run as $rows)
    {
       if($img_path = "lfupload/".$rows['file'])
       {
         $query = "DELETE FROM petlf WHERE id='$id' ";
         $query_run = mysqli_query($connection, $query);

         if($query_run)
       {
         unlink($img_path);
         $_SESSION['status'] = "Your Pet Profile is Deleted";
         $_SESSION['status_code'] = "success";
         header('Location: lostandfound.php'); 
        }
         else
        {
        $_SESSION['status'] = "Your Pet Profile is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: lostandfound.php'); 
        }    
     }
    }

    
}

if(isset($_POST['lfreqdelete_btn']))
{
    $id = $_POST['delete_id'];

    $check_query = "SELECT * FROM lost WHERE id ='$id' ";
    $check_query_run = mysqli_query($connection, $check_query);
    foreach($check_query_run as $rows)
    {
       if($img_path = "lfrupload/".$rows['file'])
       {
         $query = "DELETE FROM lost WHERE id='$id' ";
         $query_run = mysqli_query($connection, $query);

         if($query_run)
       {
         unlink($img_path);
         $_SESSION['status'] = "Your Pet Profile is Deleted";
         $_SESSION['status_code'] = "success";
         header('Location: lfrequest.php'); 
        }
         else
        {
        $_SESSION['status'] = "Your Pet Profile is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: lfrequest.php'); 
        }    
     }
    }

    
}

if(isset($_POST['contactupdatebtn']))
{
    $id = $_POST['edit_id'];
    $mobile =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_mobile']));
    $email =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_email']));
    $fb =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_fb']));
    $twit =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_twit']));
    $insta =  htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_insta']));

    $query = "UPDATE cdetails SET mobile='$mobile', email='$email',  fb='$fb', twit='$twit', insta='$insta' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] ="success";
        header('Location: contact.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] ="error";
        header('Location: contact.php'); 
    }
}

if(isset($_POST['creqdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM contact WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: crequest.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: crequest.php'); 
    }    
}

if(isset($_POST['donationupdatebtn']))
{
    $id = $_POST['edit_id'];
    $gcash = mysqli_real_escape_string($connection, $_POST['edit_gcash']);
    $gcash2 = mysqli_real_escape_string($connection, $_POST['edit_gcash2']);
    $paymaya = mysqli_real_escape_string($connection, $_POST['edit_paymaya']);
    $bank1 = mysqli_real_escape_string($connection, $_POST['edit_bank1']);
    $bank2 = mysqli_real_escape_string($connection, $_POST['edit_bank2']);
    $email = mysqli_real_escape_string($connection, $_POST['edit_email']);
    $location = mysqli_real_escape_string($connection, $_POST['edit_location']);
    $phone = mysqli_real_escape_string($connection, $_POST['edit_phone']);

    $query = "UPDATE donation SET gcash='$gcash', gcash2='$gcash2', paymaya='$paymaya', bank1='$bank1',  bank2='$bank2', email='$email', location='$location', phone='$phone' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: donation.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: donation.php'); 
    }
}


if (isset($_POST['mastersave']))
{
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $reason = mysqli_real_escape_string($connection, $_POST['reason']);

    $query = "INSERT INTO mlist (fullname,email,address,mobile,reason) VALUES ('$fullname','$email','$address', '$mobile', '$reason')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "Master List are added";
    $_SESSION ['status_code'] = "success";
    header('Location: mlist.php');
    }
    else
    {
    $_SESSION['status'] = "Master List are not added";
    $_SESSION ['status_code'] = "error";
    header('Location: mlist.php');
    }
    
}

if(isset($_POST['mlistupdatebtn']))
{
    $id = $_POST['edit_id'];
    $fullname= mysqli_real_escape_string($connection, $_POST['edit_fullname']);
    $email = mysqli_real_escape_string($connection, $_POST['edit_email']);
    $address = mysqli_real_escape_string($connection, $_POST['edit_address']);
    $mobile = mysqli_real_escape_string($connection, $_POST['edit_mobile']);
    $reason = mysqli_real_escape_string($connection, $_POST['edit_reason']);

    $query = "UPDATE mlist SET fullname='$fullname', email='$email',  address='$address', mobile='$mobile', reason='$reason' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: mlist.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: mlist.php'); 
    }
}

if(isset($_POST['mlistdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM mlist WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: mlist.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: mlist.php'); 
    }    
}

if (isset($_POST['expsave']))
{
    $expenses = mysqli_real_escape_string($connection, $_POST['expenses']);
    $reason = mysqli_real_escape_string($connection, $_POST['reason']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    $query = "INSERT INTO expenses (totalexp,reason,date) VALUES ('$expenses','$reason','$date')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "Expenses are added";
    $_SESSION ['status_code'] = "success";
    header('Location: expense.php');
    }
    else
    {
    $_SESSION['status'] = "Expenses are added";
    $_SESSION ['status_code'] = "error";
    header('Location: expense.php');
    }
    
}

if(isset($_POST['expupdatebtn']))
{
    $id = $_POST['edit_id'];
    $expenses = mysqli_real_escape_string($connection, $_POST['edit_exp']);
    $reason = mysqli_real_escape_string($connection, $_POST['edit_reason']);
    $date = mysqli_real_escape_string($connection, $_POST['edit_date']);
    
    $query = "UPDATE expenses SET totalexp='$expenses', reason='$reason', date='$date'  WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: expense.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: expense.php'); 
    }
}

if(isset($_POST['expdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM expenses WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: expense.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: expense.php'); 
    }    
}

if(isset($_POST['contactviewupdatebtn']))
{
    $id = $_POST['edit_id'];
    $fullname = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_fname']));
    $email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_email']));
    $mobile = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_mobile']));
    $inq = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_inq']));
    $sbj = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_subj']));
    $msg = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_msg']));
    $stat = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['edit_status']));
    
    $query = "UPDATE contact SET fullname='$fullname', email='$email', mobile='$mobile', inqtype='$inq', subj='$sbj', msg='$msg', stat='$stat' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: crequest.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: crequest.php'); 
    }
}



if(isset($_POST['viewlfupdatebtn']))
{
   
    $id = $_POST['edit_id'];
    $stat = mysqli_real_escape_string($connection, $_POST['edit_status']);

    $query = "UPDATE lost SET stat='$stat' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $_SESSION['status'] = "Pet Profile is Updated Successfuly";
        $_SESSION ['status_code'] = "success";
        header('Location: lfrequest.php');
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
        $_SESSION['status'] = "Pet Profile Updated With New  Image And Delete the old image";
        $_SESSION ['status_code'] = "success";
        header('Location: lfrequest.php');
        
        }
    }
    else
    {
        $_SESSION['status'] = "Error Occured.";
        $_SESSION ['status_code'] = "error";
        header('Location: lfrequest.php');  
    }
}

if (isset($_POST['donators-save']))
{
    $donators = mysqli_real_escape_string($connection, $_POST['donators']);
    $donation = mysqli_real_escape_string($connection, $_POST['donation']);
    $amount = $_POST['amount'];

    $query = "INSERT INTO donators (donators,donation,amount) VALUES ('$donators','$donation','$amount')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "Donator added in the list.";
    $_SESSION ['status_code'] = "success";
    header('Location: donators.php');
    }
    else
    {
    $_SESSION['status'] = "Donator not added in the list.";
    $_SESSION ['status_code'] = "error";
    header('Location: donators.php');
    }
    
}

if (isset($_POST['anouns-save']))
{
    $announce = mysqli_real_escape_string($connection, $_POST['announce']);
    $descript = mysqli_real_escape_string($connection, $_POST['description']);

    $query = "INSERT INTO home2 (announce,description) VALUES ('$announce','$descript')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "Announcement added in the list.";
    $_SESSION ['status_code'] = "success";
    header('Location: home2.php');
    }
    else
    {
    $_SESSION['status'] = "Announcement not added in the list.";
    $_SESSION ['status_code'] = "error";
    header('Location: home2.php');
    }
    
}

if (isset($_POST['faq-save']))
{
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $answer = mysqli_real_escape_string($connection, $_POST['answer']);

    $query = "INSERT INTO faq (title,answer) VALUES ('$title','$answer')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
    $_SESSION['status'] = "FAQ added in the list.";
    $_SESSION ['status_code'] = "success";
    header('Location: faq.php');
    }
    else
    {
    $_SESSION['status'] = "FAQ not added in the list.";
    $_SESSION ['status_code'] = "error";
    header('Location: faq.php');
    }
    
}

if(isset($_POST['faqupdatebtn']))
{
    $id = $_POST['edit_id'];
    $title = mysqli_real_escape_string($connection,$_POST['edit_title']);
    $answer = mysqli_real_escape_string($connection,$_POST['edit_answer']);

    $query = "UPDATE faq SET title='$title', answer='$answer' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: faq.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: faq.php'); 
    }
}


if(isset($_POST['faqdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faq WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: faq.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: faq.php'); 
    }    
}


if(isset($_POST['infoupdatebtn']))
{
    $id = $_POST['edit_id'];
    $title = mysqli_real_escape_string($connection,$_POST['edit_title']);
    $details = mysqli_real_escape_string($connection,$_POST['edit_details']);

    $query = "UPDATE info SET title='$title', details='$details' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: more-info.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: more-info.php'); 
    }
}

if(isset($_POST['timelineupdatebtn2']))
{
    $id = $_POST['edit_id'];
    $title = mysqli_real_escape_string($connection, $_POST['edit_title']);
    $descript = mysqli_real_escape_string($connection, $_POST['edit_descript']);

    $query = "UPDATE timeline SET title='$title', descript='$descript' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: timeline.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] ="error";
        header('Location: timeline.php'); 
    }
}

if(isset($_POST['needsupdatebtn']))
{
    $id = $_POST['edit_id'];
    $title = mysqli_real_escape_string($connection,$_POST['edit_title']);
    $details = mysqli_real_escape_string($connection,$_POST['edit_details']);

    $query = "UPDATE needs SET title='$title', details='$details' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION ['status_code'] = "success";
        header('Location: needs.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: needs.php'); 
    }
}

if(isset($_POST['donatorsdelete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM donators WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: donators.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: donators.php'); 
    }    
}


if(isset($_POST['ambassupdatebtn']))
{
    $id = $_POST['edit_id'];
    $title =  mysqli_real_escape_string($connection, $_POST['edit_title']);
    $petname =  mysqli_real_escape_string($connection, $_POST['edit_petname']);

    $file = $_FILES["edit_petfile"]['name'];

    $adopt_query = "SELECT * FROM ambassadog WHERE id ='$id' ";
    $adopt_query_run = mysqli_query($connection, $adopt_query);
    foreach($adopt_query_run as $rows)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $img_data = $rows['file'];
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
             if($img_path = "aupload/".$rows['file'])
            {
                unlink($img_path);
                $img_data = $file;
            }
            
        }
    }

    $query = "UPDATE ambassadog SET title='$title', petname='$petname',  file='$file' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        if($file == NULL)
        {
        // UPDATE WITH EXISTING IMAGE
        $_SESSION['status'] = "Ambassadog of the Month is Updated Successfully";
        $_SESSION ['status_code'] = "success";
        header('Location: ambassadog.php');
        }
        else
        {
        // UPDATE WITH NEW IMAGE AND DELETE WITH OLD IMAGE
        move_uploaded_file($_FILES["edit_petfile"]["tmp_name"], "aupload/".$_FILES["edit_petfile"]["name"]);
        $_SESSION['status'] = "Ambassadog of the Month is Updated Successfully";
        $_SESSION ['status_code'] = "success";
        header('Location: ambassadog.php');
        
        }
    }
    else
    {
        $_SESSION['status'] = "Pet  Profile is Not Updated";
        $_SESSION ['status_code'] = "error";
        header('Location: ambassadog.php');  
    }
}


?>