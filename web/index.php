<?php
    session_start();
    
    function connecte() {
        $res = !empty($_SESSION['utilisateur']);
        return $res;
    }
    
    if (!connecte()) {        
        $page = 'connexion';
    } elseif (!empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'tdb';
    }
?>
<html>
    <head>
        <title>Demandes</title>
    </head>
    <body style="background-color: #cccccc;">

        <h2>SUIVI DES DEMANDES</h2>
        
        <table border="5" cellpadding="5">
            <tr>
                <td>
                    <a href="?page=tdb">Tableau de bord</a>
                    <br/>
                    <a href="?page=demandes">Liste des demandes</a>
                    <br/>
                    <a href="?page=nouvelle">Nouvelle demande</a>
                    <br/>
                    <a href="?page=utilisateurs">Utilisateurs</a>
                    <br/>
                    <a href="?page=compte">Mon compte</a>
                    <br/>
                    <a href="?page=deconnexion">Déconnexion</a>                    
                    <br/>                                          
                </td>
                <td>
                    <?php
                        echo "Page: $page";
                        if ($page == 'connexion') {
                            require_once("connexion.php");
                        }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>

