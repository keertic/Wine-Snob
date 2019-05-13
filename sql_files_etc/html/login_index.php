TODO: shrink sign-up/log-in buttons, format signup page, format login page, implement write a review page, implement explore by region page, implement search by wine type, figure out what to do on the home page, implement recommendations

<?php
	// This file contains the Wine Snob main page

	// need to include all info to connect the database
	include 'dbh.php';

	function testfun(){
		session_start();
		unset($_SESSION["nome"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
	}

	if(array_key_exists('logout',$_POST)){
   		testfun();
	}

	// Find all distinct grape varieties - use in search field drop down menus
	$varietySql = "SELECT distinct(variety) FROM WINES ORDER BY variety";
	$varietyResult = mysqli_query($conn,$varietySql);
	$varietyQueryResult = mysqli_num_rows($varietyResult);

	// Find all distinct countries - use in search field drop down menus
	$countrySql = "SELECT distinct(country) FROM WINES ORDER BY country";
	$countryResult = mysqli_query($conn,$countrySql);
	$countryQueryResult = mysqli_num_rows($countryResult);

?>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>




<script>
	function myFunction()
	{
		alert("I am an alert box!"); // this is the message in ""
	}
</script>

<!--
	Escape Velocity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>

	<!-- TODO: put login buttons here, right align -->


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
							<p>TODO: we can write a couple words to summarize our website here</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<div class="row gtr-25" align="right">
								<div class="col-10">
									<a href="logout.php" class="button style2" name="log-out">Log Out</a>
								</div>
							</div>
							<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>
							<ul>
								<li class="current"><a href="index.php">Home</a></li>
								<li><a href="reviews.php">Write A Review</a></li>
								<li><a href="regions.php">Explore By Region</a></li>
							</ul>
						</nav>

				</section>

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
											<form action="search.php" method="POST">
												<div class="row gtr-50">

													<!-- Keyword Search -->
													<div class="col-12">
														<input type="text" name="keyword-search" placeholder="Keyword Search">
													</div>

													<!-- Wine Type Selection Dropdown -->
													<div class="col-12">
														<select name="type-search">
															<option value="All Wine Types">Wine Type (opt.) - not yet implemented</option>
															<option value="Red">Red</option>
															<option value="White">White</option>
															<option value="Sparkling">Sparkling</option>
															<option value="Dessert">Dessert</option>
															<option value="Port/Sherry">Port/Sherry</option>
														</select>
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
				</section>

<!-- MARKED FOR DELETION -->

			<!-- Highlights -->
<!--				<section id="highlights" class="wrapper style3">
					<div class="title">The Endorsements</div>
					<div class="container">
						<div class="row aln-center">
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>
									<h3><a href="#">Aliquam diam consequat</a></h3>
									<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Learn More</a></li>
									</ul>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
									<h3><a href="#">Nisl adipiscing sed lorem</a></h3>
									<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Learn More</a></li>
									</ul>
								</section>
							</div>
							<div class="col-4 col-12-medium">
								<section class="highlight">
									<a href="#" class="image featured"><img src="images/pic04.jpg" alt="" /></a>
									<h3><a href="#">Mattis tempus lorem</a></h3>
									<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
									<ul class="actions">
										<li><a href="#" class="button style1">Learn More</a></li>
									</ul>
								</section>
							</div>
						</div>
					</div>
				</section>
-->
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
