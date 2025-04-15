<?php

$activite = $bdd->prepare("SELECT * FROM activites");
$activite->execute();
$activite = $activite->fetchAll(PDO::FETCH_ASSOC);




?>


<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container">
        <h1>Activités</h1>
        <p>reservez une de nos différentes activités sportives.</p>
        <form method="post">
            <label for="activite">Choisissez une activité :</label>
            <select name="activite" id="activite">
                <option value="">Choisissez une activité</option>
                <?php foreach ($activite as $a): ?>
                    <option value="<?= $a['id'] ?>"><?= $a['nom'] ?></option>
                <?php endforeach; ?>

            </select>


        </form>
    </div>
</body>

</html>