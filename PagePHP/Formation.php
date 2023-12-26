<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<body>
	<div id='formation'>
		<h1 class='titre'>Mes Formations :</h1>
			<div class='resultat'>
				<ul>
				<?php
					foreach($data["Formation"] AS $uneFormation){
						?>
						<B><li><?=ucfirst($uneFormation["diplome"])?></B>
							<ul>
								<li><?=$uneFormation["etablissement"]?></li>
								<li><?=$uneFormation["lieux"]?></li>
								<li><?=$uneFormation["date-début"]?></li>
								<li><?=$uneFormation["date-fin"]?></li>
								<li><?=$uneFormation["contenu"]?></li>
							</ul><br>
						</li>
						<?php
					}
				?>
				</ul>
			</div>
		<h1 class='titreCV'>Mon CV :</h1>
		<?php echo "<a class='cv' href=".$cv.">Mon curriculum vitae</a>"; ?>
	</div>
</body>
</html>
