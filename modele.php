<?php
// Fonction pour se connecter à la base de données
function connecterBDD() {
    try {
        return new PDO('mysql:host=localhost;dbname=architechture_des_logitiels;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
}

// Fonction pour enregistrer la note finale en base de données
function sauvegarderNote($id_etudiant, $id_ue, $tp, $tpe, $cc, $examen, $note_finale) {
    $bdd = connecterBDD();
    $req = $bdd->prepare('INSERT INTO notes(id_etudiant, id_ue, note_tp, note_tpe, note_cc, note_examen, note_finale) 
                          VALUES(?, ?, ?, ?, ?, ?, ?)');
    $req->execute([$id_etudiant, $id_ue, $tp, $tpe, $cc, $examen, $note_finale]);
}
?>