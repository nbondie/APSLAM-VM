<?php
$data=yaml_parse_file('donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<title>Accueil</title>
<body>
	<div id="Accueil">
		<div id='presentation'>
			<img id='pdp' src='pdp.jpg'> 
			<h2 id='nom'><?php echo $data["Nom"] ?></h2>
			<p id='accroche'><?php echo $data["AccrocheAccueil"] ?></p>
		</div> 
	</div>
</body>
</html>

