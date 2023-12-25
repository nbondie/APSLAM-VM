<?php
$data=yaml_parse_file('donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<title>Formation</title>
<body>
	<div id='formation'>
		<h1 class='titre'>Mes Formations :</h1>
			<div class='resultat'>
				<ul>
				<?php
					foreach($data["Formation"] AS $uneFormation){
						?>
						<li><?=ucfirst($uneFormation["diplome"])?>
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
	</div>
</body>
</html>
