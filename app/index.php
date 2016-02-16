<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lottokone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,900,900italic">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrap">
  <header class="header" role="banner">
    <h1 class="logo">Lottokone</h1>
  </header>
  <main class="content" role="main">
    <div class="input-wrap">
      <div class="input">
        <form class="form" method="post">
          <div class="form-inner">
            <?php
              $omatNumerot = isset($_POST["omatNumerot"]) ? $_POST["omatNumerot"] : array();

              $omaNumero = 1;
              while($omaNumero <= 39) {
                echo '<input type="checkbox" id="'.$omaNumero.'" name="omatNumerot[]" value="' . $omaNumero . '" ' . ((in_array($omaNumero, $omatNumerot) == true) ? 'checked' : '') . ">" . '<label for="' . $omaNumero . '"><span>' . $omaNumero . "</span></label>";
                $omaNumero++;
              }
            ?>
          </div>
          <input class="btn" type="submit" value="Pelaa!">
        </form>
      </div>
    </div>
    <div class="output-wrap">
      <div class="output">
        <?php
          if (count($omatNumerot) == 0) {
            echo "<h2>Valitse numerot!</h2>";
            echo "<p>Numeroita pitää olla valittuna 7.</p>";
          }

          elseif (count($omatNumerot) > 0) {

            sort($omatNumerot);

            if (count($omatNumerot) == 7) {

              $paaNumerot = array();
              $lisaNumerot = array();

              while (count($paaNumerot) < 7) {
                $paaNumero = rand(1, 39);
                if (in_array($paaNumero, $paaNumerot)) {
                  continue;
                }

                array_push($paaNumerot, $paaNumero);
              }

              while (count($lisaNumerot) < 3) {
                $lisaNumero = rand(1, 39);
                if (in_array($lisaNumero, $paaNumerot)) {
                  continue;
                } elseif (in_array($lisaNumero, $lisaNumerot)) {
                  continue;
                }

                array_push($lisaNumerot, $lisaNumero);
              }

              sort($paaNumerot);
              sort($lisaNumerot);

              echo "<h2>Päänumerot:</h2>";
              echo '<ul class="primary-balls"><li class="animated bounceInRight"><span>' . implode('</span></li><li class="animated bounceInRight"><span>', $paaNumerot) . "</span></li></ul>";
              echo "<h2>Lisänumerot:</h2>";
              echo '<ul class="secondary-balls"><li class="animated bounceInRight"><span>' . implode('</span></li><li class="animated bounceInRight"><span>', $lisaNumerot) . "</span></li></ul>";

              $oikeatPaaNumerot = count(array_intersect($omatNumerot, $paaNumerot));
              $oikeatLisaNumerot = count(array_intersect($omatNumerot, $lisaNumerot));
              echo '<h2 class="result animated bounceIn">Sait ' . $oikeatPaaNumerot . ' + ' . $oikeatLisaNumerot . ' oikein!</h2>';

            } elseif (count($omatNumerot) < 7) {
              echo "<h2>Virhe!</h2>";
              echo "<p>Numeroita pitää olla valittuna 7, valitsit vain " . count($omatNumerot) . ".</p>";
            } elseif (count($omatNumerot) > 7) {
              echo "<h2>Virhe!</h2>";
              echo "<p>Numeroita pitää olla valittuna vain 7, valitsit " . count($omatNumerot) . ".</p>";
            }
          }
         ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
