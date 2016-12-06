<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Projet_PHP</title>
		<link rel="stylesheet" href="liste_client.css">
		
		
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
				if(isset($_POST["retour"])){	
						header("Location: http:/Mini_Projet_Cam/affiche_information.php");
					}
				include_once("params.inc.php");
				$id = mysqli_connect($host, $user, $password, $dbname);
				if (!$id){
					die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
				}
				//On recupere l'id de la personne connecté
				$idpersonne=$_SESSION["personne"];
				
				$req = "SELECT administrateur FROM membre WHERE id='$idpersonne'";
				
				$result = mysqli_query($id,$req);
				$row = mysqli_fetch_row($result);
				
				if($row[0]==0){ //Si la personne connecté n'est pas admin
					if(isset($_POST["devis"])){ //Et qu'elle clique sur Devis
						echo "Liste de vos devis";
						$dev="SELECT * FROM devis WHERE id_client='$idpersonne'";
						$result=mysqli_query($id,$dev);
						while ($row = mysqli_fetch_row($result)){ //On affiche tous ses devis
						?>
						<table>
							<tr><td>Devis N°<?php echo $row[0] ?></td><tr>
							<tr><td>Date du devis : <?php echo $row[1] ?></td><tr>
							<tr><td>Prix total du devis : <?php echo $row[3] ?></td><tr>
						</table><br>
						<?php
						}
					}else if(isset($_POST["facture"])){ //Et qu'elle clique sur Facture
						echo "Liste de vos factures";
						$fac="SELECT * FROM facture WHERE id_client='$idpersonne'";
						$result=mysqli_query($id,$fac);
						while ($row = mysqli_fetch_row($result)){ //On affiche toutes ses factures
						?>
						<table>
							<tr><td>Facture N°<?php echo $row[0] ?></td><tr>
							<tr><td>Date de la facture : <?php echo $row[1] ?></td><tr>
							<tr><td>Prix total de la facture : <?php echo $row[3] ?></td><tr>
						</table>
						<?php
						}
					}
				}
				else if($row[0]=1){ //Si la personne connecté est admin
					if(isset($_POST["membres"])){ //Et qu'elle clique sur membres
						header('Location: compte_admin.php'); //On renvoie vers ce lien
						exit();
					}
					
				
					
					if(isset($_POST["devis"])){ //Et qu'elle clique sur devis
						echo "Liste des devis";
						$dev="SELECT * FROM devis";
						$result=mysqli_query($id,$dev);
						while ($row = mysqli_fetch_row($result)){ //On affiche tous les devis existants
						?>
						<table>
							<tr><td>Devis N°<?php echo $row[0] ?></td><tr>
							<tr><td>Date du devis : <?php echo $row[1] ?></td><tr>
							<tr><td>Prix total du devis : <?php echo $row[3] ?></td><tr>
						</table><br>
						<?php
						}
					}
					if(isset($_POST["factures"])){ //Et qu'elle clique sur facture
						echo "Liste des factures";
						$fac="SELECT * FROM facture";
						$result=mysqli_query($id,$fac);
						while ($row = mysqli_fetch_row($result)){ //On affiche toutes les factures existantes
						?>
						<table>
							<tr><td>Facture N°<?php echo $row[0] ?></td><tr>
							<tr><td>Date de la facture : <?php echo $row[1] ?></td><tr>
							<tr><td>Prix total de la facture : <?php echo $row[3] ?></td><tr>
						</table>
						<?php
						}
					}
				}?> 
				<!--Pour pouvoir retourner surla page précédente-->
				<form method="post" action="compte.php">
						<input type="submit" value="Retour" name="retour"/><br>
				</form>
				
				
				
				
			</div>
		</div>
	</body>
</html>