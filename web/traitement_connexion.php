<?php
    require_once("config.php");

    echo "<p><pre>" . print_r($_POST, true) . "</pre></p>";
    
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    echo "<p>identifiant=$identifiant mdp=$mdp</p>";
    
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=$db_name", $db_user, $db_pass);
    
    echo "<p>pdo=<pre>".print_r($pdo, true)."</pre></p>";

    $stmt = $pdo->prepare("
        SELECT 
            u.id AS utilisateur, 
            r.code AS role
        FROM utilisateur u 
        JOIN role r ON r.id = u.role
        WHERE nom = :nom AND mdp = :mdp
        ");
    echo "<p>stmt=<pre>".print_r($stmt, true)."</pre></p>";
    $param = array(
        'nom' => $identifiant,
        'mdp' => md5($mdp),
    );
    echo "<p>param=<pre>".print_r($param, true)."</pre></p>";
    $stmt->execute($param);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        echo "Identification correcte";
        exit();
        session_regenerate_id();
        $_SESSION['utilisateur'] = $res['id'];
        $_SESSION['role'] = $res['role'];
    } else {
        echo "Identification incorrecte";
        exit();
    }
    
