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
							<li><a href="Accueil.html">Accueil</a></li>
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
					
						
						<br/>
						  <br/>Voici la liste de vos clients : </br>				  
						  
						<?php 
						$nom="";
						?>
						<br/>
						<form method="post" action="traitement_admin.php">
							<label for="Nom">Nom    </label>
							<input type="text" name="Nom" value="<?php echo $nom ?>">
							
							<input type="submit" value="Valider" name="submit">
							<input type="submit" value="Annuler" name="reset">
						</form> <br>
						
						<?php
						if(isset($_GET['page'])){
							$page = $_GET['page'];
							if(is_null($page)){
								$page = 0;
							}
						}else{
							$page = 0;
						}
						
						//On va calculer le nombre de page necessaire pour afficher tout les utilisateur avec nb_personne par page
						$nb_personne = 10; 
						$req_nombre="SELECT COUNT(*) from membre"; // on compte nb personne totale dans la table
						$result_nombre = mysqli_query($id,$req_nombre);
						$nb_page = mysqli_fetch_row($result_nombre)[0]/$nb_personne;// on compte le nb de page
						
						  
						$req = "SELECT * From membre WHERE id!=0 order by id"; //On selectionne tous les clients
						$result = mysqli_query($id,$req);	
						for($i=0;$i<$page*$nb_personne;$i++){
							mysqli_fetch_row($result);
						}
						$variable = 0;
						while ($row = mysqli_fetch_row($result)){
							if($variable<$nb_personne){ ?>
							<!--On affiche les membres-->
								<table>
								<tr><td><?php echo $row[0] ?></td>
								<td>nom: <?php echo $row[1] ?></td></tr>
								
								<tr><td colspan="2">prenom : <?php echo $row[2] ?></td></tr>
								<tr><td colspan="2">  mail : <?php echo $row[3] ?></td></tr>
								<tr><td colspan="2"> mot de passe :  <?php echo $row[4] ?></td></tr>
								
								</table><br/>
								<?php
								$variable = $variable + 1;
							}else{
								break;
							}
						}
						mysqli_free_result($result);
						
						//Pour afficher les 10 membres prècédents
						if($page>0){
							echo "<a href=\"?page=".($page-1)."\">Page precedente </a>";
						}
						//Pur afficher les 10 membres suivants
						if($page<$nb_page-1){
							echo "<a href=\"?page=".($page+1)."\">Page suivante</a>";
						}			
					
					
			
					
				?>
				
			</div>
		</div>
	</body>
</html>