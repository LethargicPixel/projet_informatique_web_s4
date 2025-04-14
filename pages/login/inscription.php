<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $complement = $_POST['complement'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $motdepasse = $_POST['motdepasse'];
    $confirmation_motdepasse = $_POST['confirmation_motdepasse'];

    $existe = $bdd->prepare("SELECT mail FROM profils WHERE mail=?");
    $existe->execute([$email]);
    $existe = $existe->fetch(PDO::FETCH_ASSOC);
    if ($existe) {
        echo "<script>alert('Le compte avec $mail comme addresse mail existe deja. \\n Tentez de vous connecter ou contactez un gérant du site');</script>";
        header('Location: ?page=connexion');

    } else {


        if ($motdepasse === $confirmation_motdepasse) {

            $inserer = $bdd->prepare("INSERT INTO profils (nom, prenom, mail, numero, adresse, complement_addresse, code_postal, ville, pays, mdp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $inserer->execute([$nom, $prenom, $email, $telephone, $adresse, $complement, $code_postal, $ville, $pays, $motdepasse]);

            header('Location: ?page=acceuil');
            $_SESSION['mail'] = $email;
            $_SESSION['connecter'] = true;
            exit;
        } else {
            $_SESSION['erreur_connexion'] = true;
        }
    }
}



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="pages/login/verif_mdp.js" defer></script>
    <script src="pages/login/affiche_mdp.js" defer></script>
</head>

<body>


    <form method="post">
        <div class="container">
            <h1>Inscription</h1>

            <?php if ($_SESSION["nb_erreur"] >= 3): ?>
                <?php $_SESSION['erreur_connexion'] = false; ?>
                <?php $_SESSION['nb_erreur'] = 0; ?>
                <div class="alert alert-danger" role="alert">
                    Vous avez atteint le nombre maximum de tentatives de connexion. Veuillez vous inscrire.
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div>
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="mb-3">
                <label for="complement" class="form-label">Complément d'adresse</label>
                <input type="text" class="form-control" id="complement" name="complement">
            </div>
            <div>
                <label for="code_postal" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" required>
            </div>
            <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de passe</label>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    <button class="btn btn-outline-secondary rounded-end toggleMdp" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <ul>
                    <li id="8caractere" class="verif">Doit contenir au moins 8 caractères</li>
                    <li id="maj" class="verif">Doit contenir au moins une lettre majuscule</li>
                    <li id="min" class="verif">Doit contenir au moins une lettre minuscule</li>
                    <li id="chiffre" class="verif">Doit contenir au moins un chiffre</li>
                    <li id="speciale" class="verif">Doit contenir au moins un caractère spécial</li>
                    <li id="espace" class="verif">Ne doit pas contenir d'espaces</li>
                </ul>
            </div>
            <div class="mb-3">
                <label for="confirmation_motdepasse" class="form-label">Confirmer le mot de passe</label>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="confirmation_motdepasse"
                        name="confirmation_motdepasse" required>
                    <button class="btn btn-outline-secondary rounded-end toggleMdp" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="confirmation" class="btn btn-primary">S'inscrire</button>
        </div>


    </form>
</body>

</html>