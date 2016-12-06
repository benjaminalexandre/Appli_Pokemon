<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Projet_PHP</title>
		<link rel="stylesheet" href="style_page.css">
		
		
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

						<nav>
							<ul>
								<li><a href="Accueil.php">Accueil</a></li>
								<li><a href="pokemon.php">Pokemon</a></li>
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
				if(isset($_POST["deconnecte"])){
					$_SESSION["personne"]=null;
					header("Location: http:/Mini_Projet_Cam/connexion.php");
				}
					
				include_once("params.inc.php");
				$id = mysqli_connect($host, $user, $password, $dbname);

				if (!$id){
					die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
				}
					
				$idpersonne=$_SESSION["personne"];
				$req = "SELECT * FROM membre WHERE id='$idpersonne'";
				
				$result = mysqli_query($id,$req);
				$row = mysqli_fetch_row($result);
				//Lorsque la personne connecté est un membre...
				if($row[6]==0){?>
				<!--On affiche ses données-->
								<fieldset>
								<legend>Bonjour, <?php echo $row[2] ?> voici ci-dessous le recapitulatif de vos donnees : </legend><br> 
									Nom : <?php echo  $row[1] ?> <br>
									Prénom : <?php echo  $row[2] ?> <br>
									E-mail : <?php echo  $row[3] ?> <br>
									Mot de passe : <?php echo  $row[4] ?> <br>
									Adresse : <?php echo  $row[5] ?> <br>
								</fieldset>
								<!--Et peu choisir de voir ses devis ou ses factures-->
					<form method="post" action="affiche_information.php">
						<input type="submit" value="Mes devis" name="devis" />
						<input type="submit" value="Mes factures" name="facture" />
					</form>
				<?php
				}
				else { ?> <!--Lorsque la personne connecté est l'admin-->
				<br><br><br>
				<!--Il peut afficher la liste des membres, des devis et des factures-->
				<form method="post" action="affiche_information.php">
						<input type="submit" value="Membres" name="membres" />
						<input type="submit" value="Devis" name="devis" />
						<input type="submit" value="Factures" name="factures" />
				</form>
					<br/>
					<br/>
					
				<?php }
				?>
				<!--Lorsque la personne connecté veut se déconnecté-->
				<form method="post" action="compte.php">
					<input type="submit" value="Se déconnecter" name="deconnecte"/>
				</form><br>
				
			 </div>
			</div>
		</body>
</html>