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
		
      <!-- on le wrapper dans le body  -->
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
				<div id="banniere_image">
					
				</div>
				 <section>
					<article>
						<form method="post" action="traitement_inscription.php">
								  <br>
								  <br>
								  <br>
							<fieldset>
								<br>
								<!-- Formulaire d'inscription-->
								<legend>Inscrivez vous :</legend>					  
								<table>									
									<tr><td><label for="nom">Nom</label></td>
									<td><input type="text" name="nom" required/></td></tr>
									
									<tr><td><label for="prenom">Prenom</label></td>
									<td><input type="text" name="prenom" required/> </td></tr>
									
									<tr><td><label for="adresse">Adresse</label>
									<td><input type="text" name="adresse" required/></tr>
									
									<tr><td><label for="mail">E-mail</label></td>
									<td><input type="text" name="mail" required/></td></tr>					
									
									<tr><td><label for="password">Mot de passe </label></td>
									<td><input type="password" name="password" required/></td></tr>
								</table>
							</fieldset>
								  <input type="reset" name="reset"  />
								  <input type="submit"/>
						   
					    </form>
					</article>
				</section>
			 </div>
		</div>
    </body>
</html>
