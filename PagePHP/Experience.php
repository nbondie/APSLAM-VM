<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<body>
	<div id='experience'>
		<h1 class='titre'>Mes expériences :</h1>
		<div id='block2'>
			<div class='resultat'>
				<ul>
				<?php
					foreach($data["Experience"] AS $uneExperience){					//Pour chaque Expérience dans Experience
						?>
						<B><li><?=ucfirst($uneExperience["entreprise"])?></B>     <!-- Nom de l'entreprise -->
							<ul>
								<li><?=$uneExperience["poste"]?></li>             <!-- Nom du poste -->
								<li><?=$uneExperience["date-début"]?></li>        <!-- Date de début -->
								<li><?=$uneExperience["date-fin"]?></li>
								<li><?=$uneExperience["lieu"]?></li>
								<li><?=$uneExperience["tâche"]?></li>
							</ul><br>
						</li>
						<?php $cv=$uneExperience["cv"] ?>       <!-- Récupération du lien vers la CV dans le YAML -->
						<?php
					}
				?>
				</ul>
			</div>
		</div>
		<h1 class='titreCV'>Mon CV :</h1>
		<?php echo "<a class='cv' href=".$cv.">Mon curriculum vitae</a>"; ?>      <!-- Affichae du lien vers le CV -->
	</div>
</body>
</html>
