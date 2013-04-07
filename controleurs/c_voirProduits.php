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
<?php
fonction::initPanier();
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirCategories':
	{
  		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		break;
	}
	case 'voirProduits' :
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		$categorie = $_REQUEST['categorie'];
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits.php");
		break;
	}
	case 'ajouterAuPanier' :
	{
		$idProduit=$_REQUEST['produit'];
		$categorie = $_REQUEST['categorie'];
		$ok = fonction::ajouterAuPanier($idProduit);
		if(!$ok)
		{
			$message = "Cet article est déjà dans votre panier.";
			include("vues/v_message.php");
		}
		else
		{
			$message = "Cet article à bien été ajouté au panier.";
			include("vues/v_message.php");
		}
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits.php");
		break;
	}
}   
?>

