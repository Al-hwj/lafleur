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
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    switch ($action){
        case "connecter":{
            $login = $_POST['login'];
            $password = $_POST['mp'];
            if($login == 'admin'){
                $result = $pdo->connexionAdmin($login, $password);
                if($result != 0)
                {
                    $_SESSION['admin'] = $result['a_login'];
                    $_SESSION['mdp'] = $result['a_mdp'];
                    header('Location: '.HOME.'index.php?uc=admin');
                }
                else
                {
                    ?><script>alert("Erreur, le compte n'existe pas")</script><?php
                }
            }
            else {
               $result = $pdo->connexionClients($login, $password);
               if($result != 0)
                {
                    $_SESSION['client'] = $result['clt_login'];
                    $_SESSION['mdp'] = $result['clt_mdp'];
                    header('Location: '.HOME.'index.php?uc=clients');
                }
                else
                {
                    ?><script>alert("Erreur, le compte n'existe pas")</script><?php
                }
            }
            
            break;
        }
        
        case 'inscription' :
        {
            $login = $_POST['nlogin'];
            $mdp = $_POST['nmdp'];
            $nom = $_POST['nnom'];
            $adresse = $_POST['nadresse'];
            $cp = $_POST['ncp'];
            $tel = $_POST['ntel'];
            $email = $_POST['nmail'];
            $result = $pdo->inscriptionClient($login, $mdp, $nom, $adresse, $cp, $tel, $email);
            if($result != 0)
            {
                //Inscription réussi
                $pdo->connexionClients($login, $mdp);
                $_SESSION['client'] = $login;
                $_SESSION['mdp'] = $mdp;
                header('Location: '.HOME.'index.php?uc=gererPanier&action=voirPanier');
                
            }
            else
            {
                //Le login existe déjà
                ?><script>alert("Erreur, ce login existe déjà")</script><?php
                header('Location: '.HOME.'index.php?uc=gererPanier&action=voirPanier');
            }
            break;   
        }
        
        case 'connecterCommande' :
        {
            $login = $_POST['login'];
            $password = $_POST['mp'];
            $result = $pdo->connexionClients($login, $password);
               if($result != 0)
                {
                    $_SESSION['client'] = $result['clt_login'];
                    $_SESSION['mdp'] = $result['clt_mdp'];
                    header('Location: '.HOME.'index.php?uc=gererPanier&action=voirPanier');
                }
                else
                {
                    ?><script>alert("Erreur, le compte n'existe pas")</script><?php
                }
            break;
        }
        case "deconnecter":{
                session_destroy();
                session_unset(); 
                header('Location: '.HOME);
                
            break;
        }
    }
}else{
    include ("vues/v_connexion.php");
}
?>