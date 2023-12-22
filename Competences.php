<?php
$data=yaml_parse_file('donnée.yaml');

?>


<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="principal.css">
<script src="https://kit.fontawesome.com/7ca312f99b.js" crossorigin="anonymous"></script>
<body>
	<div id='competence'>
		<h1 id='titre'>Mes compétences :</h1>
		<div id='block2'>
			<div id='resultat'>
				<ul>
				<?php
					foreach($data["Compétence"] AS $uneCompétence){
						?>
						<U><li><?=ucfirst($uneCompétence["domaine"])?> :</U>
							<ul>
							<?php
								foreach($uneCompétence["item"] AS $unItem){
									?>
										<B><li><?=$unItem["nom"]?></li></B>
										<?php
											if ($unItem['score'] != ""){
												?><li><?=$unItem["score"]?></li><?php
											}
										?>
										
										
										<li><?php
											$lvl=$unItem["lvl"];

											$star="<i class='fa-solid fa-star'></i>";
											$star2="<i class='fa-regular fa-star'></i>";
											$nv=0;
											$tot=0;

											while ($lvl >0) {
												echo "<div class='etoile'>".$star."</div>";
												$lvl=$lvl-1;
												$tot=$tot+1;
											}
											while ($tot <5) {
												echo "<div class='etoile'>".$star2."</div>";
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
