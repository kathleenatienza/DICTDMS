<?php
session_start();
$con = mysqli_connect("localhost","root","","adminpanel");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function  send_email_arequest($fullname,$email,$petname)
{
    require 'admin/PHPMailer/src/Exception.php';
    require 'admin/PHPMailer/src/PHPMailer.php';
    require 'admin/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();

    $mail->SMTPDebug = 2;                               // Enable verbose debug output
    
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'email.aspinacademy@gmail.com';                 // SMTP username
    $mail->Password = 'Aspinacademy.pass2021';                           // SMTP password
    $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('angeloasensi2017@gmail.com',$fullname);
    $mail->addAddress($email);               // Name is optional
    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aspin Academy Adoption Request';

    $email_template ="           
    <h2 style ='color:#333'>Hello! $fullname </h2>
    <h3 style ='color:#333'>Thank you for sending Adoption Request of $petname Aspin Academy will evaluate your request
    and check if you have the right and ability to adopt $petname. Please wait for the reply on your request.
    Thank you for supporting Aspin Academy.</h3>
    <p style ='color:#333'>-Aspin Academy</p>
    <hr/>
    <p style= text-align:center;>
    <img src='https://i.ibb.co/g3qzJ8s/donation.jpg' height=450; width=550; alt='email'> 
    </p>                                               
    ";

    $mail->Body = $email_template;
    $mail->send();
    
}

 if(isset($_POST['arequest']))
{
    $petname = $_POST['petname'];
    $fullname = $_POST['fname'];
    $email =  $_POST['email'];
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $mobile = $_POST['mobile'];
    $amobile = $_POST['amobile'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $exp = mysqli_real_escape_string($con, $_POST['exp']);
    $agree = $_POST['agree'];
    $stat = $_POST['stat'];

    $token  = $_POST['token'];
    $action = $_POST['action'];

    $curlData = array(
        'secret' => '6LdlP_QcAAAAAKR57tKhHvYw72M4D2IQZ2V5-D8K',
        'response' => $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($ch);

    $captchaResponse = json_decode($curlResponse, true);

    if ($captchaResponse['success'] == '1' && $captchaResponse['action'] == $action && $captchaResponse['score'] >= 0.5 && $captchaResponse['hostname'] == $_SERVER['SERVER_NAME']) {

    $query = "INSERT INTO adopt (`petname`, `fullname`, `email`, `addre`, `mobile`, `amobile`, `q1`, `q2`, `q3`, `expir`, `agree`,`stat`) VALUES ('$petname', '$fullname', '$email', '$address', '$mobile', '$amobile', '$q1', '$q2', '$q3', '$exp', '$agree', '$stat')";
    $query_run = mysqli_query($con, $query);

        if($query_run)
        {
        send_email_arequest($fullname,$email,$petname);
        $_SESSION['status'] = "Your Adoption Request is sent.";
        $_SESSION['status_code'] = "success";
        header('Location: adoption.php');
        }
        else
        {
        $_SESSION['status'] = "Your Adoption Request is failed to sent. Please Try Again Later";
        $_SESSION['status_code'] = "error";
        header('Location: adoption.php');
        }
}
}


function  send_email($fullname,$email)
{
    require 'admin/PHPMailer/src/Exception.php';
    require 'admin/PHPMailer/src/PHPMailer.php';
    require 'admin/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();

    $mail->SMTPDebug = 2;                               // Enable verbose debug output
    
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'email.aspinacademy@gmail.com';                 // SMTP username
    $mail->Password = 'Aspinacademy.pass2021';                          // SMTP password
    $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('angeloasensi2017@gmail.com',$fullname);
    $mail->addAddress($email);               // Name is optional
    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aspin Academy Contact Request';

    $email_template ="           
    <h2 style ='color:#333'>Hello! $fullname </h2>
    <h3 style ='color:#333'>Thank you for contacting Aspin Academy. Please wait for the reply on your request. Thank you for 
    supporting Aspin Academy.</h3>
    <br/>
    <p style ='color:#333'>-Aspin Academy</p>
    <hr/>
    <p style= text-align:center;>
    <img src='https://i.ibb.co/p1wxNQh/email.png' height=450; width=550; alt='email'> 
    </p>                                               
    ";

    $mail->Body = $email_template;
    $mail->send();
    
}

if(isset($_POST['contact']))

{
    $fullname = $_POST['fullname'];
    $email = $_POST['mail'];
    $mobile = $_POST['mobil'];
    $inqtype = $_POST['inqtype'];
    $subj = mysqli_real_escape_string($con,$_POST['subj']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    $status = $_POST['status'];

    $token  = $_POST['token'];
    $action = $_POST['action'];

    $curlData = array(
        'secret' => '6LdlP_QcAAAAAKR57tKhHvYw72M4D2IQZ2V5-D8K',
        'response' => $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($ch);

    $captchaResponse = json_decode($curlResponse, true);

    if ($captchaResponse['success'] == '1' && $captchaResponse['action'] == $action && $captchaResponse['score'] >= 0.5 && $captchaResponse['hostname'] == $_SERVER['SERVER_NAME']) {

    $query = "INSERT INTO contact (fullname,email,mobile,inqtype,subj,msg,stat) VALUES ('$fullname', '$email', '$mobile', '$inqtype', '$subj', '$msg', '$status')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
    send_email($fullname,$email);
    $_SESSION['status'] = "Your Message Request is been sent.";
    $_SESSION['status_code'] = "success";
    header('Location: contact.php');
    }
    else
    {
    $_SESSION['status'] = "Your Message Request is failed to sent";
    $_SESSION['status_code'] = "error";
    header('Location: contact.php');
    }
} 
}

function  send_email_lfrequest($fullname,$email,$petname)
{
    require 'admin/PHPMailer/src/Exception.php';
    require 'admin/PHPMailer/src/PHPMailer.php';
    require 'admin/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();

    $mail->SMTPDebug = 2;                               // Enable verbose debug output
    
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->IsSMTP();
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'email.aspinacademy@gmail.com';                 // SMTP username
    $mail->Password = 'Aspinacademy.pass2021';                           // SMTP password
    $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('angeloasensi2017@gmail.com',$fullname);
    $mail->addAddress($email);               // Name is optional
    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aspin Academy Lost & Found Request';

    $email_template ="           
    <h2 style ='color:#333'>Hello! $fullname </h2>
    <h3 style ='color:#333'>Thank you for sending Lost & Found Request of $petname.
    Aspin Academy will evaluate your sent details and photo. Please wait for the reply as we evaluate your
    evidences that $petname is your lost pet. Thank you for supporting Aspin Academy.</h3>
    <br/>
    <p style ='color:#333'>-Aspin Academy</p>
    <hr/>
    <p style= text-align:center;>
    <img src='https://i.ibb.co/p1wxNQh/email.png' height=450; width=550; alt='email'> 
    </p>                                               
    ";

    $mail->Body = $email_template;
    $mail->send();
    
}

if(isset($_POST['lfrequest']))
{
    $petname = $_POST['petname'];
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $mobile = $_POST['mobile'];
    $amobile = $_POST['amobile'];
    $q1 = $_POST['q1'];
    $details = mysqli_real_escape_string($con, $_POST['details']);
    $file = $_FILES["petfile"]['name'];
    $agree = $_POST['agree'];
    $stat = $_POST['stat'];

    $token  = $_POST['token'];
    $action = $_POST['action'];

    $curlData = array(
        'secret' => '6LdlP_QcAAAAAKR57tKhHvYw72M4D2IQZ2V5-D8K',
        'response' => $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($ch);

    $captchaResponse = json_decode($curlResponse, true);

    $validate_img_extension = $_FILES["petfile"]["type"]=="image/jpg" ||
    $_FILES["petfile"]["type"]=="image/png" ||
    $_FILES["petfile"]["type"]=="image/jpeg";

    if($validate_img_extension)
    {
    if(file_exists("admin/lfrupload/" . $_FILES["petfile"]["name"]))
    {
        $store = $_FILES["petfile"]["name"];
        $_SESSION['status'] = "Image already Exists. '. $store.'";
        header('Location: lost.php');
    }

    if ($captchaResponse['success'] == '1' && $captchaResponse['action'] == $action && $captchaResponse['score'] >= 0.5 && $captchaResponse['hostname'] == $_SERVER['SERVER_NAME']) {
        $query = "INSERT INTO lost (`petname`, `fullname`, `email`, `addre`, `mobile`, `amobile`, `q1`, `details`, `file`, `agree`, `stat`) VALUES ('$petname', '$fullname', '$email', '$address', '$mobile', '$amobile', '$q1', '$details', '$file', '$agree', '$stat')";
        $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["petfile"]["tmp_name"], "admin/lfrupload/".$_FILES["petfile"]["name"]);
                send_email_lfrequest($fullname,$email,$petname);
                $_SESSION['status'] = "Your Lost & Found Request is sent";
                $_SESSION['status_code'] = "success";
                header('Location: lost.php'); 
            }
            else
            {
                $_SESSION['status'] = "Your Lost & Found Request is failed to sent";
                $_SESSION['status_code'] = "error";
                header('Location: lost.php'); 
        }
    }

}
else
{
    $_SESSION['status'] = "ONLY PNG, JPG AND JPEG IMAGES ARE ALLOWED";
    $_SESSION['status_code'] = "error";
    header('Location: lost.php');
}
}



?>