<?php
$data=yaml_parse_file('donnée.yaml');

?>


<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<body>
	<div id='experience'>
		<h1 class='titre'>Mes expériences :</h1>
		<div id='block2'>
			<div id='resultat'>
				<ul>
				<?php
					foreach($data["Experience"] AS $uneExperience){
						?>
						<li><?=ucfirst($uneExperience["entreprise"])?>
							<ul>
								<li><?=$uneExperience["poste"]?></li>
								<li><?=$uneExperience["date-début"]?></li>
								<li><?=$uneExperience["date-fin"]?></li>
								<li><?=$uneExperience["lieu"]?></li>
								<li><?=$uneExperience["tâche"]?></li>
							</ul><br>
						</li>
						<?php $cv=$uneExperience["cv"] ?>
						<?php
					}
				?>
				</ul>
			</div>
		</div>
		<h1 id='titreCV'>Mon CV :</h1>
		<?php echo "<a id='cv' href=".$cv.">Mon curriculum vitae</a>"; ?>
	</div>
</body>
</html>
