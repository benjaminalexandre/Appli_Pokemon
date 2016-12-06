<?php
session_start();

?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mini_Projet PHP</title>
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
					
					include_once("params.inc.php");
					$id = mysqli_connect($host, $user, $password, $dbname);

					if (!$id){
						die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
					}   
					?> 
					
					<form method="post" action="compte_admin.php">
						<input type="submit" value="Retour" name="retour"/><br>
					</form>
					
					<?php
					$nom=$_POST["Nom"];					
					
					//Pour pouvoir rechercher des membres
					$req = "SELECT * FROM membre WHERE Nom='$nom'";
					$result = mysqli_query($id,$req);
					if($result->lengths){
						echo "Aucun membre de trouvé";
					}
					else{
						echo "Resultat trouve pour nom : " . $nom . "<br>";
						
						while ($row = mysqli_fetch_row($result)){?>
							<!--Affichage des membres recherchés-->
							<table>
							<tr><td><?php echo $row[0] ?></td>
							<td>Nom : <?php echo $row[1] ?></td></tr>
							
							<tr><td colspan="2">Prenom : <?php echo $row[2] ?></td></tr>
							<tr><td colspan="2">E-mail : <?php echo $row[3] ?></td></tr>
							<tr><td colspan="2">Mot de passe : <?php echo $row[4] ?></td></tr>
							
							</table>
							<br/>
							<?php
						}
					mysqli_free_result($result);
					}
					
				?>
			</div>
		</div>
	</body>
