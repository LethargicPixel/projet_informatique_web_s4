<?php

$donne = $bdd->prepare("SELECT * FROM profils WHERE mail=?");
$donne->execute([$_SESSION['mail']]);
$donne = $donne->fetch(PDO::FETCH_ASSOC);




ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    if (isset($_POST["profil"]) && $_POST["profil"] === "deconnexion") {
        echo "<script>alert('Vous avez été déconnecté avec succès');
        window.location.href = '?page=accueil';
        </script>";

        session_unset();
        exit;
    } else if (isset($_POST["profil"]) && $_POST["profil"] === "modification") {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_SESSION['mail'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $complement = $_POST['complement_dadresse'];
        $code_postal = $_POST['code_postal'];
        $ville = $_POST['ville'];
        $pays = $_POST['pays'];
        $motdepasse = isset($_POST['mots_de_passe']) ? $_POST['mots_de_passe'] : null;


        $pdp = isset($_FILES['pdp']) && $_FILES['pdp']['error'] === 0 ? file_get_contents($_FILES['pdp']['tmp_name']) : $donne['pdp'];


        $existe = $bdd->prepare("SELECT mail,mdp FROM profils WHERE mail=?");
        $existe->execute([$email]);
        $existe = $existe->fetch(PDO::FETCH_ASSOC);





        if ($motdepasse === $donne['mdp']) {

            $modifier = $bdd->prepare("UPDATE profils 
    SET nom = ?, prenom = ?, numero = ?, adresse = ?, complement_adresse = ?, code_postal = ?, ville = ?, pays = ?, pdp = ? 
    WHERE mail = ?");

            $modifier->execute([$nom, $prenom, $telephone, $adresse, $complement, $code_postal, $ville, $pays, $pdp, $email]);


            echo "<script>alert('Votre profil a été modifié avec succès');
            window.location.href = '?page=acceuil';
            </script>";

            exit;
        } else {

            echo "<script>alert('Le mot de passe est incorrect, les données n\'ont pas été modifié');
            window.location.href = '?page=profil';
            </script>";

            exit;
        }

    }

}
ob_end_flush();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="pages/profil.js" defer></script>
</head>

<body>



    <div class="container mt-5">
        <div class="card shadow-lg rounded-3">
            <div class="card-body text-center">

                <form method="post" enctype="multipart/form-data">
                    <h1 class="card-title text-success mb-4"><?= $donne['prenom'] . " " . $donne['nom'] ?></h1>

                    <?php if ($donne['pdp']) { ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($donne['pdp']) ?>"
                            class="img-fluid rounded-circle mb-3" alt="photo de profil"
                            style="width: 150px; height: 150px; object-fit: cover;" />
                    <?php } else { ?>
                        <img src="profil.png" class="img-fluid rounded-circle mb-3" alt="photo de profil"
                            style="width: 150px; height: 150px; object-fit: cover;" />
                    <?php } ?>

                    <p class="fs-5 "><strong>Email :</strong> <?= $donne['mail'] ?></p>
                    <div class="mb-3 row" style="display: none;">
                        <label for="pdp" class="col-md-4 form-label fw-bold" style="text-align: left;">Photo de
                            profil</label>
                        <input type="file" name="pdp" id="nouvel_pdp" class="col-md-4 form-label fw-bold"
                            accept="image/*">
                    </div>
                    <p class=" fs-5 informations" style="display:none;"><strong>Nom :</strong> <?= $donne['nom'] ?></p>
                    <p class="fs-5 informations" style="display:none;"><strong>Prénom :</strong>
                        <?= $donne['prenom'] ?>
                    </p>

                    <p class="fs-5 informations"><strong>Téléphone :</strong> <?= $donne['numero'] ?></p>
                    <p class="fs-5 informations"><strong>Adresse :</strong> <?= $donne['adresse'] ?></p>

                    <p class="fs-5 informations" <?= isset($donne['complement_adresse']) ? '' : 'style=display:none;' ?>>
                        <strong>Complément d'adresse
                            :</strong>
                        <?= $donne['complement_adresse'] ?>
                    </p>



                    <p class="fs-5 informations"><strong>Code postal :</strong> <?= $donne['code_postal'] ?></p>
                    <p class="fs-5 informations"><strong>Ville :</strong> <?= $donne['ville'] ?></p>
                    <p class="fs-5 informations"><strong>Pays :</strong> <?= $donne['pays'] ?></p>
                    <p class="fs-5 informations" style="display: none;"><strong>Mots de passe :</strong></p>


                    <button type="submit" name="profil" value="modification" id="modification"
                        class="btn btn-success w-100 mt-3">Modifier</button>

                    <button type="submit" name="profil" value="deconnexion" class="btn btn-danger w-100 mt-3"
                        id="deconnexion">Se
                        déconnecter</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>