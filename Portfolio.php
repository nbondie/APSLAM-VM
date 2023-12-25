<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<title>Portfolio Noé Bondie Houette</title>
<header>
	<div id='entete'>
		<div id='RS'>
			<li><i class="fa-brands fa-linkedin"></i><label><?php echo $data["Linkdin"] ?></label></li>
			<li><i class="fa-brands fa-facebook"></i></i><label><?php echo $data["Facebook"] ?></label></li>
			<li><i class="fa-brands fa-github"></i><label><?php echo $data["GitHub"] ?></label></li>
		</div>
		<div id='Page'>
			<li><a href='#Accueil'><i class="fa-solid fa-magnifying-glass"></i>Accueil</a></li>
			<li><a href='#APropos'><i class="fa-solid fa-magnifying-glass"></i>A propos</a></li>
			<li><a href='#Competences'><i class="fa-solid fa-check"></i>Compétences</a></li>
			<li><a href='#Experience'><i class="fa-solid fa-flask"></i>Exprérience</a></li>
			<li><a href='#Formation'><i class="fa-solid fa-list"></i>Formation</a></li>
			<li><a href='#Contact'><i class="fa-solid fa-phone"></i>Contact</a></li>
		</div>	
	</div>
</header>

<body>
<h1 id="Accueil"></h1>
<?php echo "<br><br>";	
	include 'Accueil.php'; ?>

<h1 id="APropos"></h1>
<?php echo "<br><br>";
	include 'APropos.php'; ?>

<h1 id="Competences"></h1>
<?php echo "<br><br>";
	include 'Competences.php'; ?>

<h1 id="Experience"></h1>
<?php echo "<br><br>";
	include 'Experience.php'; ?>

<h1 id="Formation"></h1>
<?php echo "<br><br>";
	include 'Formation.php'; ?>

<h1 id="Contact"></h1>
<?php echo "<br><br>"; 
	include 'Contact.php'; ?>

</body>

<footer>
    <h1>Me contacter :</h1>
    <li><?php echo "<p>".$data["NumTel"]."</p>\n"; ?></li>
	<li><?php echo "<p>".$data["AdresseMail"]."</p>\n"; ?></li>
   	<a><iframe id="carte" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20875.933929994153!2d-0.28284207120595173!3d49.153273786357424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480a692d0b34f9a7%3A0x40c14484fbcf780!2s14630%20Cagny!5e0!3m2!1sfr!2sfr!4v1698091119578!5m2!1sfr!2sfr" width="400" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></a>
</footer>
</html>
