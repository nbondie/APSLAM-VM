<?php
$data=yaml_parse_file('../Yaml/donnée.yaml');
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../Css/principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<body>
	<div id='competence'>
		<h1 class='titre'>Mes compétences :</h1>
		<div id='block2'>
			<div class='resultat'>
				<ul>
				<?php
					foreach($data["Compétence"] AS $uneCompétence){                         //création d'une boucle qui va aller récupéré toute les données du tableau YAML de Compétence
						?>
						<B><U><li><?=ucfirst($uneCompétence["domaine"])?> :</U></B>             <!-- Nom du domaine -->
							<ul>
							<?php
								foreach($uneCompétence["item"] AS $unItem){ 						// Pour chaque item dans Compétence
									?>
										<B><li><?=$unItem["nom"]?></li></B>                         <!-- Nom de l'item dans le domaine -->
										<?php
											if ($unItem['score'] != ""){                   //Vérifie si il y à un score pour voir si il s'agit d'une compétence ou d'une certification
												?><li><?=$unItem["score"]?></li><?php           //Et donc si c'est une certification il y affiche le score 
											}
										?>
										
										
										<li><?php
											$lvl=$unItem["lvl"];      //niveau sur 5 de maitrise de la compétence           

											$star="<i class='fa-solid fa-star'></i>";         //Icon d'étoile pleines
											$star2="<i class='fa-regular fa-star'></i>";      //Icon d'étoile vide
											$tot=0;
											while ($lvl >0) {           	//boucle qui va afficher le niveau de compétence avec des étoile pleines						      
												echo "<div id='etoile".$tot."' >".$star."</div>";
												$lvl=$lvl-1;
												$tot=$tot+1;
											}
											while ($tot <5) {               //boucle qui va afficher le reste des étoile en vide pour arriver à 5 étoile en tout
												echo "<div id='etoile".$tot."' >".$star2."</div>";
												$tot=$tot+1;
											}
										?></li><br>
										
									<?php 
								} 
							?>
							</ul><br>
						</li>
						<?php
					}
				?>
				</ul>
			</div>

		</div>
	</div>
</body>
</html>
