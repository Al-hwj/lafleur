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
<div id="produits">
<?php
//affichage des produits
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['pdt_ref'];
	$description = $unProduit['pdt_designation'];
	$prix=$unProduit['pdt_prix'];
	$image = $unProduit['pdt_image'];
	?>	
	<ul>
			<li><img src="<?php echo $image ?>" alt=image width="130" height="100"/></li>
			<li><?php echo $description ?></li>
			 <li><?php echo " : ".$prix." Euros" ?>
			<li><a href=index.php?uc=voirProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier> 
			 <img src="images/mettrepanier.png" TITLE="Ajouter au panier" /></li></a>
			
	</ul>
			
			
			
<?php			
}
?>
</div>