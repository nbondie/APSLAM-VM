<?php
$data=yaml_parse_file('donnée.yaml');
$res="Envoyer un Mail";
$captcha="Fail" ;
?>


<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<body>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
require 'reCaptcha/autoload.php';
if(isset($_POST['OK'])){
    $recaptcha = new \ReCaptcha\ReCaptcha("6Ld-9zcpAAAAAAm0DXEl56Z_mwrFL2srdSnuAq3J");

    $gRecaptchaResponse = $_POST['g-recaptcha-response'];

    $resp = $recaptcha->setExpectedHostname('srv1-vm-1126.sts-sio-caen.info')
             ->verify($gRecaptchaResponse, $remoteIp);

    if ($resp->isSuccess()) {
        $captcha = "Succes";
    } else {
        $errors = $resp->getErrorCodes();
        $captcha = "Fail";
    }
}
?>



<?php
include_once '/usr/share/php/Symfony/Contracts/Service/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "/var/www/vendor/phpmailer/phpmailer/src/Exception.php";
require "/var/www/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/var/www/vendor/phpmailer/phpmailer/src/SMTP.php";



if(!empty($_POST)) {
 
    $mail = new PHPMailer(true);
 
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'noe.bondiehouette@sts-sio-caen.info';             //SMTP username
        $mail->Password = 'link51511*';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 
        //Recipients
        $mail->setFrom('noe.bondiehouette@sts-sio-caen.info', $_POST['from']);
        $mail->addAddress($_POST['to']??'noe.bondiehouette@sts-sio-caen.info');     //Add a recipient
 
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $_POST['subject']??'Subject';
        $mail->Body = $_POST['body']??'This is the HTML message body <b>in bold!</b>';
        $res= "Le message a bien été envoyer";
        if ($captcha=="Succes"){
            $mail->send();
        } else{
            $res= "Captchat non validé !";
        }
    } catch (Exception $e) {
        $res= "Le message ne sait pas envoyer: {$mail->ErrorInfo} <br>Réessayer";
    }
}
?>

<div id='contact'>
<h1 class='titre'>Me contacter :</h1>
<div id='box'>
    <div id='boxMail'>
        <form action="#Contact" method="post">
            <h3>Votre Nom :</h3>
            <input class='entrer' type="text" name="from"><br>
            <h3>Votre adresse mail :</h3>
            <input class='entrer' type="text" name="to" value="..........@gmail.com"><br>
            <h3>Le sujet du mail :</h3>
            <input class='entrer' type="text" name="subject" placeholder="Sujet"><br>
            <h3>Le contenu :</h3>
            <textarea class='entrer' name="body"></textarea><br>
            <form method='POST'>
                <div class='g-recaptcha' data-sitekey='6Ld-9zcpAAAAAP7zHh8zvIy-mwDj4rdg2WeWB09d'></div><br/>
                <button id='boutton' name='OK' type='submit'> <?php echo $res ?></button>
            </form>
        </form>
    </div>
</div>
</div>


</body>

</html>



