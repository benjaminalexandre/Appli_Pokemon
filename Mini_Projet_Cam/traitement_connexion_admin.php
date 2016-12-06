<?php
session_start();
include_once("params.inc.php");
$id = mysqli_connect($host, $user, $password, $dbname);

if (!$id){
	die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
} 

$mail = $_POST["mail"];
$mdp = $_POST["password"];
//Selection du membre qui se connecte
$req = "SELECT id FROM membre WHERE adresse_mail = '$mail'";
$result = mysqli_query($id,$req);
$row = mysqli_fetch_row($result);
$_SESSION["personne"]=$row[0];
?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mini_Projet PHP</title>
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
					include_once("params.inc.php");
					$id = mysqli_connect($host, $user, $password, $dbname);

					if (!$id){
						die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
					}   
					//echo 'Succès...' .mysqli_get_host_info($id). "<br/>"; 
					
									
					$mail = $_POST["mail"];
					$mdp = $_POST["password"];
					
					
					$req = "SELECT mot_de_passe, administrateur FROM membre WHERE adresse_mail = '$mail'";
					$result = mysqli_query($id,$req);
					$row = mysqli_fetch_row($result);
					if($row[0] == $mdp && $row[1]==1){
						//Si la connection a réussi
						echo "Connexion reussie";
					}else{
						//Si la connection echoue
						echo "Une erreur s'est produite";
					}
					
					
					
					
				?>
				
			</div>
		</div>
	</body>
</html>