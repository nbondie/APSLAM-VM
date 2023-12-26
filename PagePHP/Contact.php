<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
$res="Envoyer un Mail";    //Variable res qui est au début en Envoyer un Mail et qui sera affciher dans le boutton d'envoie de mail
$captcha="Fail" ;    //Tant que le captcha n'est pas validé il reste en Fail
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>       <!-- lien vers l'affichage du captcha -->

<?php                       //Code pour le fonctionnement du captcha
require '../reCaptcha/autoload.php';               //Paquets pour le captcha 
if(isset($_POST['OK'])){
    $recaptcha = new \ReCaptcha\ReCaptcha("6Ld-9zcpAAAAAAm0DXEl56Z_mwrFL2srdSnuAq3J");

    $gRecaptchaResponse = $_POST['g-recaptcha-response'];

    $resp = $recaptcha->setExpectedHostname('srv1-vm-1126.sts-sio-caen.info')
             ->verify($gRecaptchaResponse, $remoteIp);

    if ($resp->isSuccess()) {       //Vérification de si le captcha à bien été fait ou pas 
        $captcha = "Succes";          //Si il a bien été fait alors on met la variable captcha en Succes ce qui va permettre de pouvoir envoyer le mail
    } else {
        $errors = $resp->getErrorCodes(); 
        $captcha = "Fail";            //Et si il n'a pas été fait alors on met captcha en Fail pour ampécher l'envoie de mail
    }
}
?>

<?php
include_once '/usr/share/php/Symfony/Contracts/Service/autoload.php';                 // Appel de tout les paquets pour faire fonctionner le PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;

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
        $mail->Password = 'Password123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 
        //Recipients
        $mail->setFrom('noe.bondiehouette@sts-sio-caen.info', $_POST['from']);
        $mail->addAddress($_POST['to']??'noe.bondiehouette@sts-sio-caen.info');     //Add a recipient
 
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $_POST['subject']??'Subject';
        $mail->Body = $_POST['body']??'This is the HTML message body <b>in bold!</b>';
        $res= "Le message a bien été envoyer";             // Vériable res qui sert a garder en elle le résultat de l'envoie et qui donc la ce met en message envoyer                                
        if ($captcha=="Succes"){           //Vérifie si le captcha a bien été validé avant d'envoyer le mail
            $mail->send();          //Si il a bien été fait alors on envoie le mail
        } else{
            $res= "Captcha non validé !";     //Sinon c'est qu'il n'a pas été fait alors on met res en Captcha non validé
        }
    } catch (Exception $e) {
        $res= "Le message ne sait pas envoyer: {$mail->ErrorInfo} <br>Réessayer";        //Récupérer l'erreur si il y en a une durant la tentative d'envoie du mail
    }
} ?>

<div id='contact'>
<h1 class='titre'>Me contacter :</h1>
<div id='box'>
    <div id='boxMail'>             <!-- Boite pour le formulaire d'envoie de mail-->
        <form action="#Contact" method="post">     
            <h3>Votre Nom :</h3>
            <input class='entrer' required="required" type="text" name="from"><br>          <!-- zone d'entrer de text pour ici y entrer son nom -->
            <h3>Votre adresse mail :</h3>
            <input class='entrer' required="required" type="email" name="to" value="..........@gmail.com"><br>    <!-- IDEM pour son adresse mail-->
            <h3>Le sujet du mail :</h3>
            <input class='entrer' required="required" type="text" name="subject" placeholder="Sujet"><br>
            <h3>Le contenu :</h3>
            <textarea class='entrer' required="required" name="body"></textarea><br>
            <form method='POST'>
                <div class='g-recaptcha' data-sitekey='6Ld-9zcpAAAAAP7zHh8zvIy-mwDj4rdg2WeWB09d'></div><br/>       <!-- Captcha qui sert à vérifier si le mail n'est pas envoyer par un bot et qui doit donc être vélidé pour pouvoir envoyer un mail -->
                <button id='boutton' name='OK' type='submit'><?php echo $res ?></button>      <!-- boutton d'envoie du mail dans le quel d'affiche le résultat de l'envoie et qui dit donc si il y à une erreur et qui dit la quel, et il dit aussi si le captcha n'a pas été validé et que donc il faut le faire  -->
                <p>Vos données ne seront pas conservés.</p>     <!-- Indication sur la non conservation des données -->
        </form>
    </div>
</div>
</div>
</body>
</html>



