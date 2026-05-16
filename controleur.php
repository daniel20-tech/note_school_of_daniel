<?php
// On inclut le modèle pour pouvoir utiliser la fonction de sauvegarde
require_once 'modele.php';

$message = "";

if (isset($_POST['calculer'])) {
    // Récupération des données du formulaire (si vide, on met NULL)
    $tp = ($_POST['note_tp'] !== "") ? floatval($_POST['note_tp']) : null;
    $tpe = ($_POST['note_tpe'] !== "") ? floatval($_POST['note_tpe']) : null;
    $cc = ($_POST['note_cc'] !== "") ? floatval($_POST['note_cc']) : null;
    $examen = floatval($_POST['note_examen']);
    
    // Valeurs de test pour l'étudiant et l'UE créés à l'étape 1
    $id_etudiant = 1; 
    $id_ue = 1;       

    $note_finale = 0;

    // Application des règles de calcul de l'énoncé
    if ($tp === null && $tpe === null && $cc === null) {
        // Cas 1 : Seul l'examen a été organisé (100% Examen)
        $note_finale = $examen;
    } 
    elseif ($tp === null && $tpe === null && $cc !== null) {
        // Cas 2 : Seuls le CC (30%) et l'Examen (70%) ont été réalisés
        $note_finale = ($cc * 0.3) + ($examen * 0.7);
    } 
    elseif ((($tp !== null && $tpe === null) || ($tp === null && $tpe !== null)) && $cc !== null) {
        // Cas 3 : Soit le TP, soit le TPE réalisé avec le CC et l'Examen
        $note_tp_tpe = ($tp !== null) ? $tp : $tpe;
        $note_finale = ($note_tp_tpe * 0.1) + ($cc * 0.2) + ($examen * 0.7);
    } 
    else {
        // Cas 4 : Toutes les évaluations ont été réalisées
        $note_finale = ($tp * 0.05) + ($tpe * 0.05) + ($cc * 0.2) + ($examen * 0.7);
    }

    // Sauvegarde dans la base de données via le Modèle
    sauvegarderNote($id_etudiant, $id_ue, $tp, $tpe, $cc, $examen, $note_finale);
    
    $message = "<div style='color: green; font-weight: bold; margin-top: 15px;'>
                Note calculée avec succès ! Note Finale : " . round($note_finale, 2) . "/20
                </div>";
}

// On charge la Vue pour afficher le formulaire à l'utilisateur
require_once 'vue_formulaire.php';
?>