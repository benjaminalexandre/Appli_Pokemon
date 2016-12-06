<?php
session_start();

if(isset($_POST["valider"])){
	//Pour recuperer les id des pokemons commandés...
	for($i=0;$i<$_POST["Nombrepokemon"];$i++){
		$idpokemon[$i]=$_POST["id"][$i];
	}
	$i=1;


	//...Et les associés à une quantité
	foreach($_POST["Nombre"] as $nb){
		if($nb!=NULL && $nb!=0){
			$_SESSION["panier"][$i]=$nb;
	}
	$i++;
	}
}
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
				if($_SESSION["personne"]!=NULL){
					//Si on vide le panier
					if(isset($_POST["vider"])){
						$_SESSION["panier"]='';
						header("Location: http:/Mini_Projet_Cam/pokemon.php");
					}?>
					<!-- Formulaire pour retourner aux choix des pokemons-->
					<form method="post" action="pokemon.php">
							<input type="submit" value="Retour" name="retour"/>
					</form><br>
					<!-- Formulaire pour vider le panier-->
					<form method="post" action="panier.php">
						<input type="submit" value="Vider le panier" name="vider"/>
					</form><br>
					<!-- Formulaire pour faire un devis-->
					<form method="post" action="pdf.php">
						<input type="submit" value="Générer un devis" name="devis"/>
					
						<input type="submit" value="Générer une facture" name="facture"/><br><br>
						<fieldset>
						<legend>Votre panier :</legend>
						<?php
						//On se connecte à la base
						include_once("params.inc.php");
						$id = mysqli_connect($host, $user, $password, $dbname);

						if (!$id){
							die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
						}
							
						$prixtotal=0;
						//On recupere les pokemons ainsi que leur quantité
						foreach($_SESSION["panier"] as $cle => $element){
							if($element!=NULL && $cle!=0){
								//Selection des pokemons dans la BD
								$req = "SELECT * From Pokemon WHERE id_pokemon=$cle";
								if($result = mysqli_query($id,$req)){
										//affichage des pokemon sous forme de tableaux -chaque Pokemon a son tableau-
										while ($row = mysqli_fetch_row($result)){ ?>
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
													<td colspan="2"> Quantité: <?php echo $element ?></td>
												</tr>
												<!--Permet d'envoyer l'id et la quantité du pokemon pour le devis-->
												<input type="hidden" name="id[]" value=" <?php echo $cle ?> ">
												<input type="hidden" name="quantite[]" value="<?php echo $element ?> ">
											</table>
											<?php
											//Calcule du prix total
											$prixtotal=$prixtotal+($row[4]*$element);
										}
										mysqli_free_result($result);
								}
							}
						}?>
					
						<!-- Affichage du prix total-->
						
						</form>
						</fieldset>
						<font size="4px">Prix total: <?php echo $prixtotal ?> €
				<?php }else{
					echo "Vous devez vous connecté afin d'accéder à votre panier";
				}?>
				
			</div>
		</div>
	</body>
</html>
