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
ini_set('display_errors', 1);
require_once("util/fonctions.inc.php");
require_once("util/class.pdoLafleur.inc.php");
/**
 * HOME correspond au chemin pour afficher des fichiers
 */
define('HOME', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
/**
 * ROOT correspond au chemin pour ajouter des fichiers
 */
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
session_start();
include("vues/v_entete.php") ;
include("vues/v_bandeau.php") ;

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
     $uc = $_REQUEST['uc'];

$pdo = PdoLafleur::getPdoLafleur();	 
switch($uc)
{
	case 'accueil':
		{include(HOME."vues/v_accueil.php");break;}
	case 'voirProduits' :
		{include("controleurs/c_voirProduits.php");break;}
	case 'gererPanier' :
		{ include("controleurs/c_gestionPanier.php");break; }
	case 'connexion' :
                { include("controleurs/c_validConnexion.php");break;  } 
        case 'admin' :{ 
            if(fonction::isConnecteAdmin()){
                include("controleurs/c_gestionProduits.php");
            }else{
                header('Location: '.HOME);
            }
            break;  
        }
        case 'clients' :{ 
            if(fonction::isConnecteClient()){
                include("controleurs/c_gestionCompte.php");
            }else{
                header('Location: '.HOME);
            }
            break;  
        }
}
include("vues/v_pied.php") ;
?>
