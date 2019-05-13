<html>
<head>
    <title> Paging in PHP </title>
</head>
<body>
    <?php
    include 'dbh.php';

    $page = $_GET["page"];
    if ($page=="" || $page=="1") {
        $page1 = 0;
    } else {
        $page1 = ($page*10)-10;
    }
    $sql = "SELECT wine_id, country, description, designation, points, price, region_1, title, variety, winery, MIN(price), MAX(price), AVG(points) FROM WINES WHERE country='Croatia' GROUP BY title ORDER BY AVG(points) DESC limit $page1,10";
    $result = mysqli_query($conn,$sql);
    $queryResult = mysqli_num_rows($result);
    while ($row=mysqli_fetch_assoc($result))
    {
        echo $row['title']." ".$row['AVG(points)'];
        echo "<br>";
    }

    // for counting pages:
    $result1 = "SELECT wine_id, country, description, designation, points, price, region_1, title, variety, winery, MIN(price), MAX(price), AVG(points) FROM WINES WHERE country='Croatia' GROUP BY title ORDER BY AVG(points) DESC";
    $result1 = mysqli_query($conn, $result1);
    $count = mysqli_num_rows($result1);
    $pages = ceil($count/10);

    for ($i=1; $i<=$pages; $i++) {
        ?><a href="search.php?page=<?php echo $i; ?>" style="text-decoration:none"> <?php echo $i." "; ?> </a><?php
    }
    ?>
</body>
</html>
