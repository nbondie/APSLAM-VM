<?php
$data=yaml_parse_file('donnée.yaml');
$res="Envoyer un Mail";
$captcha="Fail" ;
?>


<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<header>
	<div id='entete'>
		<a href='Accueil.php'><img id='logo' src='logo.png' /></a>
		<div id='lien'>
			<li><a href='APropos.php'><i class="fa-solid fa-magnifying-glass"></i>A propos</a></li>
			<li><a href='Competences.php'><i class="fa-solid fa-check"></i>Compétences</a></li>
			<li><a href='Experience.php'><i class="fa-solid fa-flask"></i>Exprérience</a></li>
			<li><a href='Formation.php'><i class="fa-solid fa-list"></i>Formation</a></li>
			<li><a href='Contact.php'><i class="fa-solid fa-phone"></i>Contact</a></li>
		</div>	
	</div>
	
</header>
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
            var_dump($error);
            $captcha = "Fail";
        }
    }

    ?>



<?php
include_once 'yaml/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "./PHPMailer/src/Exception.php";
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";



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
    <div id='box'>
        <form action="Contact.php" method="post">
            <h3>Votre Nom :</h3>
            <input class='entrer' type="text" name="from"><br>
            <h3>Votre adresse mail :</h3>
            <input class='entrer' type="text" name="to" value="monaddressmail@gmail.com"><br>
            <h3>Le sujet du mail :</h3>
            <input class='entrer' type="text" name="subject" placeholder="Sujet"><br>
            <h3>Le contenu :</h3>
            <textarea class='entrer' name="body"></textarea><br>
            <?php
            echo "<form method='POST'>
                    <div class='g-recaptcha' data-sitekey='6Ld-9zcpAAAAAP7zHh8zvIy-mwDj4rdg2WeWB09d'></div><br/>
                    <button id='boutton' name='OK' type='submit'>" .$res. "</button>
                </form>";
             ?>
        </form>
    </div>
</div>


</body>

<footer>
    <h1>Me contacter :</h1>
    <li><?php echo "<p>".$data["NumTel"]."</p>\n"; ?></li>
	<li><?php echo "<p>".$data["AdresseMail"]."</p>\n"; ?></li>
   	<a><iframe id="carte" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20875.933929994153!2d-0.28284207120595173!3d49.153273786357424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480a692d0b34f9a7%3A0x40c14484fbcf780!2s14630%20Cagny!5e0!3m2!1sfr!2sfr!4v1698091119578!5m2!1sfr!2sfr" width="400" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></a>
</footer>

</html>



