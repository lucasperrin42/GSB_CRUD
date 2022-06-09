<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `FicheFrais`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD GSB</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>CRUD Fiche Frais</h1>
                <table class="table">
                    <thead>
                        <th>id Visiteur</th>
                        <th>mois</th>
                        <th>nbJustificatif</th>
                        <th>Montant valide</th>
                        <th>date Modif</th>
                        <th>id Etat</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['idVisiteur'] ?></td>
                                <td><?= $produit['mois'] ?></td>
                                <td><?= $produit['nbJustificatifs'] ?></td>
                                <td><?= $produit['montantValide'] ?></td>
                                <td><?= $produit['dateModif'] ?></td>
                                <td><?= $produit['idEtat'] ?></td>
                                <td><a href="edit.php?id=<?= $produit['idVisiteur'.'mois'] ?>">Modifier</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>