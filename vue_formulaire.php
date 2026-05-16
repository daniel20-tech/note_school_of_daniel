<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Faculté des Sciences - Saisie des Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Saisie des notes (INF201)</h2>
    <p>Laisser vide si l'évaluation n'a pas été organisée.</p>
    
    <form action="controleur.php" method="POST">
        
        <div class="form-group">
            <label for="note_tp">Note de TP (/20) :</label>
            <input type="number" id="note_tp" name="note_tp" min="0" max="20" step="0.25">
        </div>
        
        <div class="form-group">
            <label for="note_tpe">Note de TPE (/20) :</label>
            <input type="number" id="note_tpe" name="note_tpe" min="0" max="20" step="0.25">
        </div>
        
        <div class="form-group">
            <label for="note_cc">Note de Contrôle Continu (/20) :</label>
            <input type="number" id="note_cc" name="note_cc" min="0" max="20" step="0.25">
        </div>
        
        <div class="form-group">
            <label for="note_examen">Note d'Examen Final (/20) * :</label>
            <input type="number" id="note_examen" name="note_examen" min="0" max="20" step="0.25" required>
        </div>
        
        <button type="submit" name="calculer">Calculer et Enregistrer</button>
    </form>

    <?php if (isset($message) && $message !== ""): ?>
        <div class="message-box">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>