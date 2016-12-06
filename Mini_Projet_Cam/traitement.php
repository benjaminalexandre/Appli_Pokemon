<?php
session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mini_Projet PHP</title>
		<link rel="stylesheet" href="pokemon.css">
    </head>
    
    <body>
		<div id="wrapper">
			<div id="bloc_page">
				<header>
					<div id="titre_principal">
						<div id="logo">
							<img src="logo.png" style="width:50px;height:60px" alt="Logo" />
						</div>
					</div>
					
					<!--Barre de menu-->
					<nav>
						<ul>
							<li><a href="Accueil.php">Accueil</a></li>
							<li><a href="pokemon.php">Pokémon</a></li>
							<?php
							if($_SESSION["personne"]==null){
							?>
							<li><a href="connexion.php">Connexion</a></li>
							<?php }else{ ?>
							<li><a href="compte.php">Mon compte</a></li>
							<?php } ?>
							<li><a href="inscription.php">Inscription</a></li>
							<li><a href="panier.php">Panier</a></li>
						</ul>
					</nav>
				</header>
				<?php
					if(isset($_POST["reset"])){	
						header("Location: http:/Mini_Projet_Cam/pokemon.php");
					}
					
					//On se connecte à la base
					include_once("params.inc.php");
					$id = mysqli_connect($host, $user, $password, $dbname);

					if (!$id){
						die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
					}?>  
					<!-- Formulaire qui permet de retourner vers la page où il y a tout les pokemons-->
					<form method="post" action="pokemon.php">
						<input type="submit" value="Retour" name="retour"/><br>
					</form>
					<br>
					<!--Formulaire qui envoie les pokemons dans le panier-->
					<form method="post" action="panier.php">
						<input type="submit" value="Valider votre selection"/>
					<br>
					
					<?php
					//On recupere les champs de la barre de recherche de pokemon.php
					$nom=$_POST["Nom"];
					$type=$_POST["Type"];
					
					//Si on recherche un pokemon
					if($nom!=""){
						//On compte les resultats trouvés
						$reqnb = "SELECT COUNT(id_pokemon) From Pokemon WHERE nom_pokemon='$nom'";
						$x = mysqli_query($id, $reqnb);
						$nbpokemon = mysqli_fetch_row($x);
						//On selectionne les pokemons recherchés
						$req = "SELECT * From Pokemon WHERE lower(nom_pokemon)='$nom'";
						$result = mysqli_query($id,$req);
						if($result->lengths){ //Si aucun pokemon de trouvé
							echo "Aucun Pokemon de trouvé";
						}
						else{
							//Si il y a des résultats
							echo $nbpokemon[0] . " résultats trouvée pour nom : " . $nom . "<br>";
							while ($row = mysqli_fetch_row($result)){ ?>
								<!--Affichage des pokemons trouvées-->
								<table>
										<tr>
											<td><?php echo $row[0] ?> </td>
											<td><?php echo $row[1] ?> </td>
										</tr>
										<tr>
											<td colspan="2"> <img src="<?php echo $row[5] ?>" style="width:100px;height:100px;"></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo $row[2] ?></td>
										</tr>
										<tr>
											<td colspan="2"> Rareté: <?php echo $row[3] ?></td>
										</tr>
										<tr>
											<td colspan="2"> Prix: <?php echo $row[4] ?>€</td>
										</tr>
										<tr>
											<td colspan="2">
												<input type="text" name="Nombre[]">
												<input type="hidden" name="id[]" value=" <?php echo $row[0] ?>">
											</td>
										</tr>
									</table>
							<?php }
							mysqli_free_result($result); 
						}?>
						<!--On envoi également le nombre de pokemon choisi-->
						<input type="hidden" name="Nombrepokemon" value="<?php echo $nbpokemon[0] ?>">
					<?php }
					//Si on recherche un type de pokemon
					if($type!=""){
						//On compte les resultats trouvés
						$reqnb = "SELECT COUNT(id_pokemon) From Pokemon WHERE lower(type_pokemon)='$type'";
						$x = mysqli_query($id, $reqnb);
						$nbpokemon = mysqli_fetch_row($x);
						//On selectionne les pokemons recherchés
						$req = "SELECT * From Pokemon WHERE lower(type_pokemon)='$type'";
						$result = mysqli_query($id,$req);
						if($result->lengths){ //Si aucun pokemon de trouvé
							echo "Aucun Pokemon de trouvé";
						}
						else{
							//Si il y a des résultats
							echo $nbpokemon[0] . " résultats trouvée pour nom : " . $type . "<br>";
							while ($row = mysqli_fetch_row($result)){ ?>
								<!--Affichage des pokemons trouvées-->
								<table>
										<tr>
											<td><?php echo $row[0] ?> </td>
											<td><?php echo $row[1] ?> </td>
										</tr>
										<tr>
											<td colspan="2"> <img src="<?php echo $row[5] ?>" style="width:100px;height:100px;"></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo $row[2] ?></td>
										</tr>
										<tr>
											<td colspan="2"> Rareté: <?php echo $row[3] ?></td>
										</tr>
										<tr>
											<td colspan="2"> Prix: <?php echo $row[4] ?>€</td>
										</tr>
										<tr>
											<td colspan="2">
												<input type="text" name="Nombre[]">
												<input type="hidden" name="id[]" value=" <?php echo $row[0] ?>">
											</td>
										</tr>
									</table>
							<?php }
							mysqli_free_result($result); 
						}?>
						<!--On envoi également le nombre de pokemon choisi-->
						<input type="hidden" name="Nombrepokemon" value="<?php echo $nbpokemon[0] ?>">
					<?php }
						 ?>
				</form>
			</div>
		</div>
	</body>
</html>