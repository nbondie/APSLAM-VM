<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<body>
	<div id="Accueil">
		<div id='presentation'>
			<img id='pdp' src='<?php echo $data["pdp"] ?>'>          <!-- affichage de la photo de profile grace au liens dans le YAMl-->
			<h2 id='nom'><?php echo $data["Nom"] ?></h2>                    <!-- affichage du nom depuis le YAML -->
			<p id='accroche'><?php echo $data["AccrocheAccueil"] ?></p>     <!-- affichage de l'accroche depuis le YAMl-->
		</div> 
	</div>
</body>
</html>

