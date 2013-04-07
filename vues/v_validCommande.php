<?php
    /**
    * Header content
    *
    * @author  My name
    *
    * @since 1.0.0
    */
?>
<!DOCTYPE html>
<html lang="fr" class="no-js"> 
<form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
<table border='1'> <br><?php
foreach ($information as $i):
?>
<tr>
   Vos informations :<br>
   <td>Nom : <?php echo $i->clt_nom ?><br>
   Adresse : <?php echo $i->clt_adresse ?><br>
   Code Postal : <?php echo $i->clt_cpostal ?><br>
   Téléphone : <?php echo $i->clt_tel ?><br></td>
</tr>
</table>
<?php endforeach;
$total = 0;
?>
<?php foreach ($lesProduitsDuPanier as $p): ?>
<table border='1'>
<tr>
<?php
$id = $p['pdt_ref'];
$description = $p['pdt_designation'];
$image = $p['pdt_image'];
$prix = $p['pdt_prix'];
$total = $total + $prix;
echo "<br><br>Vos produits :";
echo "<td>";
echo "Description : ".$description;
echo "<br>";
?><img src="<?php echo $image ?>" alt=image width=130 height=100 /><?php
echo "<br>";
echo "Prix : ".$prix." Euros";
echo "<br>";
echo "Quantité :".$qte;
?> <input type="hidden" name="qte" value="<?php echo $qte ?>" /><?php
echo "<br>";
?>
</tr>
<?php endforeach; 
echo "<td align='right'>";
echo "Prix total : ".$total*$qte." Euros";
echo "</td><br>";?>
</table>
<input type="submit" value="Valider" name="valider">
<input type="button" onclick="history.back();" value="Annuler"> 
</form>