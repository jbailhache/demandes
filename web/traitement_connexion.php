<?php
    session_start();
    require_once("config.php");
    
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=$db_name", $db_user, $db_pass);

    $stmt = $pdo->prepare("
        SELECT 
            u.id AS utilisateur, 
            r.code AS role
        FROM utilisateur u 
        JOIN role r ON r.id = u.role
        WHERE nom = :nom AND mdp = :mdp
        ");

    $param = array(
        'nom' => $identifiant,
        'mdp' => md5($mdp),
    );
    
    $stmt->execute($param);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        session_regenerate_id();
        $_SESSION['utilisateur'] = $res['utilisateur'];
        $_SESSION['role'] = $res['role'];
        $message = "Identification correcte";
    } else {
        $message = "Identification incorrecte";
    }
    
    header("Location: index.php?message=$message");
    
