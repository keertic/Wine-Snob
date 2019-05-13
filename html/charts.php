<?php
    include 'dbh.php';
    session_start();
    //

    // the 3 maps
    $user_name = $_SESSION['user_name'];
    $allWinesByCountrySQL = "SELECT country, count(*) as all_wine_count
                             FROM WINES
                             GROUP BY country
                             HAVING LENGTH(country) > 0";
    $allWinesByCountryResult = mysqli_query($conn, $allWinesByCountrySQL);
    $userWinesByCountrySQL = "SELECT a.country as country, count(*) as user_wine_count
                              FROM
                                  (SELECT country, w.wine_id
                                   FROM WINES w
                                   INNER JOIN REVIEWS r
                                   ON w.wine_id=r.wine_id
                                   WHERE r.user_id='".$user_name."') a
                              GROUP BY a.country";
    $userWinesByCountryResult = mysqli_query($conn, $userWinesByCountrySQL);
    $userRecWinesSQL = "SELECT a.country as country, count(*) as user_rec_count
                        FROM
                            (SELECT country, w.wine_id
                             FROM WINES w
                             INNER JOIN RECOMMENDATIONS r
                             ON w.wine_id=r.wine_id
                             WHERE r.user_id='".$user_name."') a
                        GROUP BY a.country";
    $userRecWinesResult = mysqli_query($conn, $userRecWinesSQL);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data_1 = google.visualization.arrayToDataTable([
          ['Country', 'Wine Count'],
          <?php   while($row = mysqli_fetch_assoc($allWinesByCountryResult)){ ?>
                ['<?php echo $row['country']?>' , <?php echo $row['all_wine_count']?>],
                <?php } ?>
        ]);

        var data_2 = google.visualization.arrayToDataTable([
          ['Country', 'Wine Count'],
          <?php   while($row = mysqli_fetch_assoc($userWinesByCountryResult)){ ?>
                ['<?php echo $row['country']?>' , <?php echo $row['user_wine_count']?>],
                <?php } ?>
        ]);

        var data_3 = google.visualization.arrayToDataTable([
          ['Country', 'Wine Count'],
          <?php   while($row = mysqli_fetch_assoc($userRecWinesResult)){ ?>
                ['<?php echo $row['country']?>' , <?php echo $row['user_rec_count']?>],
                <?php } ?>
        ]);

        var options = {};
        options['colorAxis'] = {colors : ['18de99', '21e0d6', '2dc5e3', '05a6e6', '1489e8',
                                          '1e69eb', '202aed', '461bf0', '6f1df2', '6f1df2']};
        options['backgroundColor'] = '#f6f7ff';
        options['datalessRegionColor'] = '#bed0ff';
        options['width'] = 800;
        options['height'] = 600;
        var chart_1 = new google.visualization.GeoChart(document.getElementById('regions_div_1'));
        chart_1.draw(data_1, options);
        var chart_2 = new google.visualization.GeoChart(document.getElementById('regions_div_2'));
        chart_2.draw(data_2, options);
        var chart_3 = new google.visualization.GeoChart(document.getElementById('regions_div_3'));
        chart_3.draw(data_3, options);
      }
    </script>
  </head>
  <body>
    <div id="regions_div_1" style="width: 900px; height: 500px;"></div>
    <div id="regions_div_2" style="width: 900px; height: 500px;"></div>
    <div id="regions_div_3" style="width: 900px; height: 500px;"></div>
  </body>
</html>


// this is for the triple bar chart on review scores:::
<?php
    include 'dbh.php';
    session_start();
    $user_name = $_SESSION['user_name'];
    $tripleBarChartSQL = "SELECT a_1.wine_id, a_1.avg_score, a_1.prof_points, r_1.score as user_score FROM
                           (SELECT a.wine_id, a.score as avg_score, b.points as prof_points FROM
                           (SELECT r.wine_id, avg(score) as score FROM WINES w
                           INNER JOIN REVIEWS r ON w.wine_id=r.wine_id
                           group by wine_id) a
                           INNER JOIN WINES b
                           ON b.wine_id=a.wine_id) a_1
                           INNER JOIN REVIEWS r_1
                           ON a_1.wine_id=r_1.wine_id
                           WHERE user_id='$user_name'";
    $tripleBarChartResult = mysqli_query($conn, $tripleBarChartSQL);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Wine_id', 'Your Review', 'Professional Review', 'Avg Reviews'],
          <?php   while($row = mysqli_fetch_assoc($tripleBarChartResult)){ ?>
                ["<?php echo $row['wine_id']?>" , <?php echo $row['user_score']?> ,
                 <?php echo $row['prof_points']?> , <?php echo $row['avg_score']?> ],
                <?php } ?>
        ]);

        var options = {
          chart: {
            title: 'Wine Scores',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>




/// Average Rating per country (user-based and professional-based averages per country)
<?php
    include 'dbh.php';
    session_start();
    $user_name = $_SESSION['user_name'];
    $countryRatingsSQL = "SELECT a.prof_avg as professional_avg, b.country as country, avg(b.score) as user_avg FROM
                           (SELECT avg(points) as prof_avg, country FROM WINES GROUP BY country) a
                           INNER JOIN
                           (SELECT country, avg(score) as score FROM WINES w
                            INNER JOIN REVIEWS r on r.wine_id=w.wine_id GROUP BY country) b
                          ON a.country=b.country
                          GROUP by b.country";
    $countryRatingsResult = mysqli_query($conn, $countryRatingsSQL);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Country', 'User Average', 'Professional Average'],
            <?php   while($row = mysqli_fetch_assoc($countryRatingsResult)){ ?>
                  ["<?php echo $row['country']?>" , <?php echo $row['professional_avg']?> ,
                   <?php echo $row['user_avg']?>],
                  <?php } ?>
        ]);

        var options = {
            chart: {
            title: 'Average Rating Per Country'
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          colors: ['#cfc2ff', '#b8caff']
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>




// the top rated wines from each country as rated by the profs
// also has the price attached to it so its a nice bubble chart
<?php
    include 'dbh.php';
    session_start();
    $user_name = $_SESSION['user_name'];
    $profBestRatedWinesByCountrySQL = "SELECT max(points) as rating, country, title, price
                                    FROM WINES where country != ''
                                    GROUP BY country";
    $profBestRatedWinesByCountryResult = mysqli_query($conn, $profBestRatedWinesByCountrySQL);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawSeriesChart);

    function drawSeriesChart() {

      var data = google.visualization.arrayToDataTable([
        ['Country', 'Rating', 'Price', 'Wine Title'],
        <?php   while($row = mysqli_fetch_assoc($profBestRatedWinesByCountryResult)){ ?>
              ["<?php echo $row['country']?>" , <?php echo $row['rating']?>,
                <?php echo $row['price']?>, "<?php echo $row['title']?>" ],
        <?php } ?>

      ]);

      var options = {
        title: 'Top Rated Wines From Each country (by Professionals)',
        hAxis: {title: 'Rating'},
        vAxis: {title: 'Price'},
        bubble: {textStyle: {fontSize: 11}}
      };

      var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>
  <body>
    <div id="series_chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
