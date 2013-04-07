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
<form method="POST" action="index.php?uc=gererPanier&action=recapitulatif">
<img src="images/panier.png" style="height:100px;"alt="Panier" title="panier"/><br>
<?php
//affichage des produits
$total = 0;
foreach( $lesProduitsDuPanier as $unProduit) 
{
	$id = $unProduit['pdt_ref'];
	$description = $unProduit['pdt_designation'];
	$image = $unProduit['pdt_image'];
	$prix = $unProduit['pdt_prix'];
        $qtemax = $unProduit['pdt_qtedispo'];
        $total = $total + $prix;
	?>
	<p>
	<img src="<?php echo $image ?>" alt=image width=130	height=100 />
	<?php
		echo	$description."($prix Euros)";
	?>
        <select name="qte">
        <?php
        $ii = 0;
        while($ii < $qtemax)
        {
            $ii++;
        ?>
            <option value="<?php echo $ii ?>"><?php echo $ii ?></option>
        <?php
        }
        ?>
        </select>
        <a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article de votre panier ?');">
	<img src="images/retirerpanier.png" TITLE="Retirer du panier" ></a>
	</p>
	<?php
}
echo "<div align='center'>";
echo "Prix total : ".$total." Euros<br>";
echo "Frais de livraison : Offert<br>";
?>
<br>
<input type="submit" value="Valider" name="valider">
<!--<a href=index.php?uc=gererPanier&action=passerCommande<img src="images/commander.jpg" TITLE="Passer commande" ></a>-->
</div>
</form>