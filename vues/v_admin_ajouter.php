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
<table border="1"><tr>
<form method="post" action="/lafleur/index.php?uc=admin&action=ajoutProduit" enctype="multipart/form-data"><br>
    <td>Categorie : <br><select name="cat">
    <option value="bul">Bulbes</option>
    <option value="mas">Massif</option>
    <option value="ros">Rosier</option>
    </select></td>
    <td>Reference : <br><input type="text" name="ref"/></td>
    <td>Description : <br><input type="text" name="desc"/></td>
    <td>Prix : <br><input type="text" name="prix"/></td>
    <td>Image : <br><input type="file" name="image"/></td>
    <td><input type="submit" value="Valider" /></td>
</form></tr></table><br>