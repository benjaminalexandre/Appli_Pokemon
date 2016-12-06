<?php
session_start();

$_SESSION["panier"][0]=0;


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
					if(isset($_POST["retour"])){	
						header("Location: http:/Mini_Projet_Cam/pokemon.php");
					}
					
					$nom="";
					$type="";
					?>
					<!--Formulaire de recherche du pokemon-->
					<fieldset>
						<legend>Recherche :</legend><br>
					<form method="post" action="traitement.php">
						<label for="Nom">Nom    </label>
						<input type="text" name="Nom" value="<?php echo $nom ?>">
						
						<label for="Type">    Type    </label>
						<input type="text" name="Type" value="<?php echo $type ?>">
						
						<input type="submit" value="Rechercher"/>
						<input type="submit" value="Reinitialiser" name="reset"/>
					</form>
					</fieldset><br>
					
					<fieldset>
						<legend>Liste des Pokémons :</legend><br>
					<!--Formulaire d'envoi du pokemon dans le panier-->
					<form method="post" action="panier.php">
						<input type="submit" value="Valider votre selection" name="valider"/>
					<br>
						
					<?php
						//On se connecte à la base
						include_once("params.inc.php");
						$id = mysqli_connect($host, $user, $password, $dbname);

						if (!$id){
						   die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
						}
						//Compte le nmbre de pokemon qui sera afficher sur la page
						$reqnb = "SELECT COUNT(id_pokemon) From Pokemon";
						$x = mysqli_query($id, $reqnb);
						$nbpokemon = mysqli_fetch_row($x);
						
						//Selection de tout les pokemons
						$req = "SELECT * From Pokemon";
						
						if($result = mysqli_query($id,$req)){
							//affichage des pokemon sous forme de tableaux -chaque Pokemon a son tableau-
							while ($row = mysqli_fetch_row($result)){?>
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
												<!--Pour pouvoir recupérer la quantité demandée et recupérer l'id du pokemon choisit-->
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
					</form>
					</fieldset>
			</div>
		</div>
	</body>
</html>