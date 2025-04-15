<?php

$coachs = $bdd->query("SELECT * FROM coachs")->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>

<body>
    <div class="container">
        <h1>Encadrant(e)s :</h1>

        <div class="container">
            <?php
            foreach ($coachs as $coach) {
                echo '<div class="container">';
                echo '<h2>' . htmlspecialchars($coach['prenom']) . " " . htmlspecialchars($coach["nom"]) . '</h2>';
                echo '<p><strong>Téléphone:</strong> ' . htmlspecialchars($coach['numero']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <form action="mailto:sportify@mail.com" method="post" enctype="text/plain">

        <div class="container">
            <h1>Contactez-nous</h1>
            <div class="mb-3">
                <label for="prenom" class="form-label">prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</body>

</html>