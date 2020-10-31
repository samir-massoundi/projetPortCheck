<?php
/* *function debutTab : affiche les premiers elements du tableau
*/
    function debutTab($hote)
    {
        echo '<h2>Resultats :</h2>
        <p>Domaine testé :'.$hote.' </p>



        <form action="index.php" method="post">
            <button type="submit" class="btn btn-primary form-check-inline text-left">Retour</button>
        </form>

        <table class="table">
        <thead>
        <tr>
        <th ></th>
        <th >Resultat</th>
        <th >Protocole</th>
        <th >Port</th>
        </tr>
        </thead>

        <tbody>';
    }

/* *function finTab : affiche la fin du tablea
    */
    function finTab()
    {
        echo " </tbody></table>";
    }

/*  *fonction Portcheck, verifie l'etat des ports, s'il est ouvert ou fermé
    *$hote : adresse ip ou nom de domaine cible
    *$protocol : protocole utilisé (TCP ou UDP)
    *$ports : liste des ports ou plage de ports testé       */
    function portCheck($hote, $ports, $protocol, $range)
    {

        $arrayPorts = explode(",",$ports);
        foreach ($arrayPorts as $port)
        {
            $connection = @fsockopen($hote, $port,  $errno, $errstr, 0.05);

            if (is_resource($connection))
            {

                echo '<tr><th class = "bg-success"></th> <td>Réussite</td> <td>#</td> <td>'.$port.'</td></tr>';
                fclose($connection);
            }
            else
            {

                echo '<tr><th class = "bg-danger"></th> <td>Échec</td> <td>#</td> <td>'.$port.'</td></tr>';

            }
        }

        $arrayRange = explode("-",$range);
        for ($i=$arrayRange[0]; $i <$arrayRange[1] ; $i++) {
            $connection = @fsockopen($hote, $i,  $errno, $errstr, 0.05);

            if (is_resource($connection))
            {

                echo '<tr><th class = "bg-success"></th> <td>Réussite</td> <td>TCP</td> <td>'.$i.'</td></tr>';
                fclose($connection);
            }
            else
            {

                echo '<tr><th class = "bg-danger"></th> <td>Échec</td> <td>TCP</td> <td>'.$i.'</td></tr>';

            }
        }
        echo " </tbody></table>";

    }

/*fucntion formulaire
*/

function formulaire()
{
    echo '<form action="index.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="domaine" placeholder="domaine à tester / adresse IP">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="ports" placeholder="ports à vérifier. ex : 80,154,41100">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="portRange" placeholder="une plage de port à verifier ex : 50000-50010">
        </div>

        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="TCP" value="true">
                <label class="form-check-label" for="inlineCheckbox1">TCP</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="UDP" value="true">
                <label class="form-check-label" for="inlineCheckbox2">UDP</label>

            </div>
            <input class="form-check-input" type="hidden" name="formulaire" value="true">
            <button type="submit" class="btn btn-primary form-check-inline">Valider</button>

        </div>
    </form>';
}
    ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ports Report</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container">

        <main class="row">
            <header class="col-lg-12 ">
                <h1 class="text-center">Test d'ouverture de ports</h1>
            </header>


            <section class="col-lg-10 offset-lg-1">

                          <?php
                          //Debut de la section

                         // $host = '127.0.0.1';
                          //$ports = array(80,255,6550,25);



                          if(!isset($_POST["formulaire"]))
                          {
                            formulaire();

                          }
                          else
                          {
                              unset($_POST["formulaire"]);
                              debutTab($_POST["domaine"]);
                              portCheck($_POST["domaine"],$_POST["ports"],"UDP",$_POST["portRange"]);
                              finTab();
                          }

                          ?>


            </section>




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</main>
</body>
</html>
