<?php
session_start();
//On se connecte à la base
include_once("params.inc.php");
	$id = mysqli_connect($host, $user, $password, $dbname);

	if (!$id){
		die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
	}
	$idpersonne=$_SESSION["personne"][0];
	//On recupere les infos du membre
	$req="SELECT id, Nom, Prenom, adresse FROM membre WHERE id=$idpersonne";
	$result = mysqli_query($id,$req);
	
	if($result = mysqli_query($id,$req)){
		while ($row = mysqli_fetch_row($result)){
			$idclient=$row[0];
			$nom=$row[1];
			$prenom=$row[2];
			$adresse=$row[3];
		}
	}
	//On recupere les tabeaux des id et de quantité et on les combine
	$tab=array_combine($_POST["id"], $_POST["quantite"]);
	$prixtotal=0;
	$numdevis=0000;
	$numfacture=0000;
?>
<!--CSS-->
<style type="text/css">
	table{ width: 100%; color: #717375; font-size: 12pt; line-height: 6mm; }
	strong{ color: #000; font-size: 15pt;}
	table.border th {background-color: black; color: white; text-align: center;}
</style>
<!--Page PDF-->
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm">
<!--Info de l'entreprise-->
	<table>
		<tr>
			<td style="width: 75%">
				<strong>Pokeshop</strong><br/>
				16 rue du Pikachu<br/>
				71960 Mâcon<br/>
				03 85 74 66 99<br/>
			</td>
		</tr>
	</table>

<!--Info du client-->
	<table style="text-align: right">
		<tr>
			<td style="width: 100%">
				<?php echo "<strong>" . $nom . "<br/>" . $prenom . "<br/></strong>" . $adresse . "<br/>"; ?>
			</td>
		</tr>
	</table>
	
<!--Devis-->
	<table>
		<tr>
			<td style="width: 100%">
				<strong><?php 
							if(isset($_POST["devis"])){	
								$numdevis++;
								echo "DEVIS N°" . $numdevis;
							}
							if(isset($_POST["facture"])){	
								$numfacture++;
								echo "FACTURE N°" . $numfacture;
							}
				?></strong><br/>
				Emis le : <?php echo date('d/m/Y'); ?>
				<br/>
			</td>
		</tr>
	</table>
	<br/>
<!--Tableau des pokemon commandés-->
	<table class="border">
		<thead>
			<tr>
				<th style="width: 10%">Id</th>
				<th style="width: 40%">Pokemon</th>
				<th style="width: 20%">Prix</th>
				<th style="width: 20%">Quantite</th>
				<th style="width: 10%">Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach($tab as $cle => $element){
			if($element!=NULL && $cle!=0){
			$req = "SELECT * From Pokemon WHERE id_pokemon=$cle";
			if($result = mysqli_query($id,$req)){
				while ($row = mysqli_fetch_row($result)){?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[4]; ?>€</td>
				<td><?php echo $element; ?></td>
				<td><?php $prixpokemon=$row[4]*$element;
				echo $prixpokemon;
				$prixtotal=$prixtotal+$prixpokemon;?>€</td>
			</tr>
				<?php }
			}
			}
		}?>
		<!--Affichage du prix total-->
			<tr>
				<td colspan="3"></td>
				<td>Prix total:</td>
				<td><?php echo $prixtotal; ?>€</td>
			</tr>
		</tbody>
	</table>
	
	<!--Enregistrement des données dans une base de données-->
	<?php
	if(isset($_POST["devis"])){	
		$req = "INSERT INTO devis(date,id_client,prix_total) VALUES (CURRENT_DATE,$idclient,$prixtotal)";
		$result = mysqli_query($id,$req);
	}
	if(isset($_POST["facture"])){	
		$req = "INSERT INTO facture(date,id_client,prix_total) VALUES (CURRENT_DATE,$idclient,$prixtotal)";
		$result = mysqli_query($id,$req);
	}
	?>
	
	
	
</page>

<?php
//Pour pouvoir générer un pdf
$content = ob_get_clean();
require('html2pdf/html2pdf.class.php');
try{
	$pdf = new HTML2PDF('P','A4', 'fr');
	$pdf->pdf->SetDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output('test.pdf','D');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>