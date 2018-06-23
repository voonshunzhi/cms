<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php include "admin/includes/functions.php"; ?>
<?php include "include/navigation.php"; ?>


<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";


//    if(!isset($_GET['forgot']) || !ifItIsMethod('get')){
//        redirect('/cms/login');
//    }

    if(ifItIsMethod('post')){
       if(isset($_POST['email'])){
           
           $email = $_POST['email'];
           
           $length = 50;
           
           $token = bin2hex(openssl_random_pseudo_bytes($length));
           
           if(email_exists($email)){
               try{
                   $prepare = $pdo -> prepare("UPDATE users SET token = :token WHERE user_email = :user_email");
                   $prepare -> bindParam(':token',$token);
                   $prepare -> bindParam(':user_email',$email);
                   $prepare -> execute();
               }catch(Exception $e){
                   echo $e -> getMessage();
               }
               
               
               //Big purpose : To send email to email server,so you need to say which server to send to, what to be sent(just like the configuration of email client like Gmail and Yahoo)
               $mail = new PHPMailer(true);

               try {
                    //Server settings
                    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = Config::SMTP_USER;               // SMTP username
                    $mail->Password = Config::SMTP_PASSWORD;                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = Config::SMTP_PORT;                                   // TCP port to connect to
                    $mail->CharSet = 'UTF-8';
                    //Recipients
                    $mail->setFrom('voonshunzhi@gmial.com', 'Voon');
                    $mail->addAddress($email);     // Add a recipient
//                    $mail->addAddress('ellen@example.com');               // Name is optional
//                    $mail->addReplyTo('info@example.com', 'Information');
//                    $mail->addCC('cc@example.com');
//                    $mail->addBCC('bcc@example.com');

                    //Attachments
//                    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = "<h3>Click on the link to reset your email</h3>
                    <div><a href='http://localhost:80/cms/reset.php?email={$email}&token={$token}'>http://localhost:80/cms/reset.php?email={$email}&token={$token}</div>
                    ";
//                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if($mail->send()){
                        
                        $email_sent = true;
                        
                    }else{
                        
                        $email_sent = false;
                        
                    }
                   
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

               
               
               
           }
       } 
    }
    

?>





<!-- Page Content -->


<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset($email_sent)){?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                        <?php }else{?>
                              
                              <h3>Please check your email!</h3>
                              
                        <?php } ?>
                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "include/footer.php";?>

</div> <!-- /.container -->

