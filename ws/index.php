<?php 
// type de contenu : format de données JSON
header('Content-Type: application/json');

// On essaie de se connecter à la base de données
try{
	$pdo = new PDO('mysql:host=localhost;dbname=api;', 'root', '');
	$retour["success"] = true;
	$retour["message"] = "Connexion réussi à la BDD";
}

// Cas d'erreur d'accès la base de données
catch(Exception $e){
	$retour["success"] = false;
	$retour["message"] = "Echec de connexion à la BDD";
}

// Test de la requête POST sur la ville de départ
if(!empty($_POST["ville_depart"])){
	$requete = $pdo->prepare("SELECT * FROM `vols` WHERE `ville_depart` LIKE :parametre");
	$requete->bindParam(':parametre', $_POST["ville_depart"]);
	$requete->execute();
}

// Sinon on prend la requête par défaut (liste des vols)
else{
	$requete = $pdo->prepare("SELECT * FROM `vols`");
	$requete->execute();
}

$resultats = $requete->fetchAll();

$retour["success"] = true;
$retour["message"] = "Voici les vols";

// On récupère les résultats
$retour["nb_resultats"] = count($resultats);
$retour["results"]["vols"] = $resultats;

// Retour des données au format JSON
echo json_encode($retour, JSON_PRETTY_PRINT);
?>