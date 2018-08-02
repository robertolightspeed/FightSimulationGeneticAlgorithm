<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="UTF-8">
    <title>War Timeline</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Raleway|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <header>
      <h1>War Timeline: Heroes against Cyclops</h1>
    </header>

    <section id="cd-timeline" class="cd-container">
      <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-cyclops">
          <img src="https://png.icons8.com/ios/50/000000/cbs-logo-filled.png" alt="Cyclops">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
          <h2>Cyclops Stats</h2>
          <p>
            Health: <?php echo $data[1]['fights'][0]['monster']['health']; ?><br/>
            Strength: <?php echo $data[1]['fights'][0]['monster']['strength']; ?><br/>
            Defense: <?php echo $data[1]['fights'][0]['monster']['defense']; ?><br/>
            Speed: <?php echo $data[1]['fights'][0]['monster']['speed']; ?><br/>
            Luck: <?php echo $data[1]['fights'][0]['monster']['luck']; ?>
          </p>
        </div> <!-- cd-timeline-content -->
      </div> <!-- cd-timeline-block -->

      <?php
        foreach ($data as $key => $generation)
        {
          ?>
          <div class="cd-timeline-block">
            <div class="cd-timeline-img cd-fighters">
              <img src="https://png.icons8.com/ios/50/000000/armored-helmet-filled.png" alt="Generation Heroes">
            </div> <!-- cd-timeline-img -->

            <div class="cd-timeline-content">
              <h2>Heroes</h2>
              <p>
                  <?php

                  foreach ($generation['fights'] as $fight)
                  {
                      ?>
                      <?php echo $fight['hero']['name']; ?><br/>
                      <?php
                  }
                  ?>
              </p>
              <a href="#0" class="cd-read-more">Read more</a>
              <span class="cd-date">Generation <?php echo $key; ?></span>
            </div> <!-- cd-timeline-content -->
          </div> <!-- cd-timeline-block -->
          <?php

          foreach ($generation['fights'] as $fight)
          {
            ?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-fight">
                <img src="https://png.icons8.com/material/50/000000/battle.png" alt="Fight">
              </div> <!-- cd-timeline-img -->

              <div class="cd-timeline-content">
                <h2>Fight: <?php echo $fight['hero']['name']; ?> vs Cyclops</h2>
                <p>
                  <b>Hero Stats</b><br/>
                  Health: <?php echo $fight['hero']['health']; ?><br/>
                  Strength: <?php echo $fight['hero']['strength']; ?><br/>
                  Defense: <?php echo $fight['hero']['defense']; ?><br/>
                  Speed: <?php echo $fight['hero']['speed']; ?><br/>
                  Luck: <?php echo $fight['hero']['luck']; ?><br/>
                  Survived: <?php echo count($fight['rounds']); ?> Rounds<br/>
                  Cyclops Remaining Health: <?php
                    $lastRound = last($fight['rounds']);
                    echo $lastRound['attacker']['initialHealth'];
                    ?>
                </p>
                <a href="#0" class="cd-read-more">Read more</a>
                <span class="cd-date"><?php echo $fight['hero']['name']; ?> vs Cyclops</span>
              </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->
            <?php
          }

          if (isset($generation['naturalSelection'])) {
              ?>
            <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-bests">
                <img src="https://png.icons8.com/ios/50/000000/best-seller-filled.png" alt="Fittest Heroes">
              </div> <!-- cd-timeline-img -->

              <div class="cd-timeline-content">
                <h2>Fittest Heroes (Survived more Rounds)</h2>
                <p>
                    <?php echo implode('<br/>', $generation['naturalSelection']); ?>
                </p>
                <span class="cd-date">Generation <?php echo $key; ?></span>
              </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->
              <?php
          }

            if (isset($generation['winner'])) {
                ?>
              <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-bests">
                  <img src="https://png.icons8.com/ios/50/000000/trophy-filled.png" alt="Fittest Heroes">
                </div> <!-- cd-timeline-img -->

                <div class="cd-timeline-content">
                  <h2>The Cyclops is defeated!</h2>
                  <p>
                    <b><?php echo $generation['winner']; ?> is the perfect hero!</b><br/>
                      The heroes took <?php echo $key; ?> generations to defeat the might cyclops.
                  </p>
                  <span class="cd-date">Generation <?php echo $key; ?></span>
                </div> <!-- cd-timeline-content -->
              </div> <!-- cd-timeline-block -->
                <?php
            }
        }
      ?>
    </section> <!-- cd-timeline -->
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </body>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <footer>
      <a href="https://icons8.com">Icon pack by Icons8</a>
    </footer>

    <script  src="assets/js/index.js"></script>
  </body>
</html>
