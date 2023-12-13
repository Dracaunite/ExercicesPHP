<?php
// Initialisation de curl
$curl = curl_init();

// Initialiser les paramètres de la requête POST.
$parametres = [
    'ville_depart' => 'madrid',
];

// Gérer des paramètres pour la requête
$params = [
    CURLOPT_URL => "http://127.0.0.1/ExercicesPHP/ws/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $parametres,
];

// Association des paramètres à la requête
curl_setopt_array($curl, $params);

// Exécution de la requête
$response = curl_exec($curl);

// Fermer la ressource
curl_close($curl);

// Affichage de la réponse
header('Content-type: application/json');

// Suppression de l'entête du fichier (conserver que les données JSON)
$response = substr($response, 3);

echo $response;

// Convertir données JSON en données brutes
$data = json_decode($response, true);

// Accès aux données
$var = $data['message'];
$var2 = $data['results']['vols'][0]['ville_depart'];
echo $var . ' pour ' . $var2;

?>