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
<div id="categories"><br>
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['cat_code'];
	$libCategorie = $uneCategorie['cat_libelle'];
	?>
	<li>
		<a href=index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits><?php echo $libCategorie ?></a>
	</li>
<?php
}
?>
</div>
