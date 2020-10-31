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
            <header class="col-lg-12">
                <h1>Test d'ouverture des ports</h1>
            </header>


            <section class="col-lg-10 offset-lg-1">
                <h2>Resultat</h2>
                <p>Domaine testé : </p>

                <table class="table">
                      <thead>
                        <tr>
                          <th ></th>
                          <th >Resultat</th>
                          <th >connexion</th>
                          <th >port</th>
                        </tr>
                      </thead>

                      <tbody>

                          <?php

                          $host = 'google.com';
                          $ports = array(80,255,6550,25);


                          foreach ($ports as $port)
                          {
                              $connection = @fsockopen($host, $port,  $errno, $errstr, 0.15);

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

                          ?>

                      </tbody>
            </section>




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</main>
</body>
</html>