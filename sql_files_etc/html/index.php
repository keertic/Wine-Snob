<!-- This document contains the formatted Wine Snob home page! -->

TODO: Fix wine_id to accept title of the wine<br>
      Formatting the Log-in, Sign-up pages.<br>
      Modifying reviews (from the profile page).<br>
      Maybe add a tab to the navigation bar called "My Reviews" that exists only when a user is logged in.<br>
      Fix pagination - is okay for page 1 but doesn't display anything else for other pages.<br>

<?php
	// This file contains the Wine Snob main page
	session_start();
	// need to include all info to connect the database
	include_once('dbh.php');

    if ($_SESSION['logged_in'] == 1)
        echo "logged in";

	// Find all distinct grape varieties - use in search field drop down menus
	$varietySql = "SELECT distinct(variety) FROM WINES ORDER BY variety";
	$varietyResult = mysqli_query($conn,$varietySql);
	$varietyQueryResult = mysqli_num_rows($varietyResult);

	// Find all distinct countries - use in search field drop down menus
	$countrySql = "SELECT distinct(country) FROM WINES ORDER BY country";
	$countryResult = mysqli_query($conn,$countrySql);
	$countryQueryResult = mysqli_num_rows($countryResult);
?>


<!--
	Escape Velocity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>


	<head>
		<title>Wine Snob | Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header" class="wrapper">

					<!-- Logo -->
						<div id="logo">
							<h1><a href="index.html">Wine Snob</a></h1>
							<p>Find your taste today!</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<div class="row gtr-25" align="right">
								<?php
								if (isset($_SESSION['logged_in']) && ($_SESSION['user_name'] != '')) {
									?>
									<div class="col-10">
										<a href="profile.php" class="button style1">My Profile</a>
									</div>
									<div class="col-1">
										<a href="logout.php" class="button style2" name="log-out">Log Out</a>
									</div> <?php
								} else {
									?>

									<div class="col-10">
										<a href="register.php" class="button style1" name="sign-up">Sign Up</a>
									</div>
									<div class="col-1">
										<a href="login.php" class="button style2" name="log-in">Log In</a>
									</div> <?php
							} ?>
							</div>
                            <?php
                            if (isset($_SESSION['logged_in']) && ($_SESSION['user_name'] != '')) {
                                ?>
							<ul>
								<li class="current"><a href="index.php">Home</a></li>
								<li><a href="reviews.php">Write A Review</a></li>
								<li><a href="regions.php">Explore By Region</a></li>
							</ul> <?php
                        }
                            ?>
						</nav>

				</section>

                <?php
                if (isset($_SESSION['logged_in']) && ($_SESSION['user_name'] != '')) {
                    ?>
                <ul>
			<!-- Main -->
				<section id="main" class="wrapper style2">
					<div class="container">
						<div class="row gtr-150">
							<div class="col-4 col-12-medium">

								<!-- Sidebar -->
									<div id="sidebar">
										<section class="box">
											<header>
												<center><h2>Find a Recommended Wine!</h2></center>
											</header>
											<form action="search.php?page=".1." method="POST">
												<div class="row gtr-50">

													<!-- Keyword Search -->
													<div class="col-12">
														<input type="text" name="keyword-search" placeholder="Keyword Search">
													</div>

													<!-- Variety Selection Dropdown -->
													<div class="col-12">
														<select name="variety-search">
															<option value="All Varieties">Grape Variety (opt.)</option>
															<?php while($row = mysqli_fetch_assoc($varietyResult)){
																if($row['variety'] != ""){
																	echo "<option value=".$row['variety'].">".$row['variety']."</option>";
																}
															} ?>
														</select>
													</div>

													<!-- Country Selection Dropdown -->
													<div class="col-12">
														<select name="country-search">
															<option value="All Countries">Country (opt.)</option>
															<?php while($row = mysqli_fetch_assoc($countryResult)){
																if($row['country'] != ""){
																	echo "<option value=".$row['country'].">".$row['country']."</option>";
																}
															} ?>
														</select>
													</div>

													<!-- Input Price Range -->
													<div class="col-6 col-12-small">
														<input type="text" name="min-price-search" placeholder="Minimum Price">
													</div>
													<div class="col-6 col-12-small">
														<input type="text" name="max-price-search" placeholder="Maximum Price">
													</div>

													<!-- Submit Button -->
													<div class="col-12">
														<center><button type="submit" class="button style1" name="submit-search">Search</button></center>
													</div>
												</div>
											</form>
										</section>

									</div>

							</div>
							<div class="col-8 col-12-medium imp-medium">

								<!-- Content -->
									<div id="content">
										<article class="box post">
											<header class="style1">
												<h2>Maybe we can throw in some pre-searched lists in this section</h2>
												<p>Maybe also a summary of what this site is and how to get started?</p>
											</header>
										</article>
										<div class="row gtr-150">
											<div class="col-6 col-12-small">
												<section class="box">
													<header>
														<h2>Popular Wines</h2>
													</header>
													<a href="#" class="image featured"><img src="images/pic05.jpg" alt="" /></a>
													<p>TODO: approve this idea during our next team meeting</p>
													<p>A summary of this list would go here!</p>
													<a href="#" class="button style1">Read More</a>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section class="box">
													<header>
														<h2>Top 10 Wines on a Budget</h2>
													</header>
													<a href="#" class="image featured"><img src="images/pic06.jpg" alt="" /></a>
													<p>TODO: approve this idea during our next team meeting</p>
													<p>A summary of this list would go here!</p>
													<a href="#" class="button style1">More</a>
												</section>
											</div>
										</div>
									</div>

							</div>
						</div>
					</div>
				</section> <?php
                }
                ?>

<!-- If user is not logged in -->
<?php
    if ($_SESSION['logged_in'] == 0) {
?>

			<!-- Highlights -->
				<section id="highlights" class="wrapper style3">
					<div class="title">What We Have To Offer</div>
					<div class="container">
						<div class="row aln-center">
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/reviews.jpg" alt="" width="45" height="180" /></a>
									<h3>Rate Wines!</h3>
									<p>Users of Wine Snob can write reviews with scores. Find out what others think of your favorite wines!</p>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/wine.jpg" alt="" width="45" height="180"/></a>
									<h3>Get Personalized Wine Recommendations!</h3>
									<p>Users of Wine Snob will be able to select from selected wines based on their preferences. The more wines a user reviews, the more recommendations!</p>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/map.jpg" alt="" width="45" height="180"/></a>
									<h3>Discover Wines From Around The World</h3>
									<p>Wondering what the world has to offer... users have interactive maps (need to figure out what we're really doing here).</p>
                                </section>
							</div>
						</div>
					</div>
				</section> <?php } ?>

			<!-- Footer -->
				<section id="footer" class="wrapper">
					<div class="container">
						<header class="style1">
							<h2>Use this section to do a cute little write-up about of our group</h2>
							<p>Time permitting, ofc, not a req for this project</p>
						</header>
						<div class="row">
							<div class="col-6 col-12-medium">

								<!-- Contact Form -->
									<section>
										<form method="post" action="#">
											<div class="row gtr-50">
												<div class="col-6 col-12-small">
													<input type="text" name="name" id="contact-name" placeholder="Name" />
												</div>
												<div class="col-6 col-12-small">
													<input type="text" name="email" id="contact-email" placeholder="Email" />
												</div>
												<div class="col-12">
													<textarea name="message" id="contact-message" placeholder="Message" rows="4"></textarea>
												</div>
												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" class="style1" value="Send" /></li>
														<li><input type="reset" class="style2" value="Reset" /></li>
													</ul>
												</div>
											</div>
										</form>
									</section>

							</div>
							<div class="col-6 col-12-medium">

								<!-- Contact -->
									<section class="feature-list small">
										<div class="row">
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon fa-home">Mailing Address</h3>
													<p>
														Untitled Corp<br />
														1234 Somewhere Rd<br />
														Nashville, TN 00000
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon fa-comment">Social</h3>
													<p>
														<a href="#">@untitled-corp</a><br />
														<a href="#">linkedin.com/untitled</a><br />
														<a href="#">facebook.com/untitled</a>
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon fa-envelope">Email</h3>
													<p>
														<a href="#">info@untitled.tld</a>
													</p>
												</section>
											</div>
											<div class="col-6 col-12-small">
												<section>
													<h3 class="icon fa-phone">Phone</h3>
													<p>
														(000) 555-0000
													</p>
												</section>
											</div>
										</div>
									</section>

							</div>
						</div>
						<div id="copyright">
							<ul>
								<li>&copy; Untitled.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</div>

				</section>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
