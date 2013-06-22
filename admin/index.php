<!DOCTYPE html>

<?php require("template.php"); ?>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>@GAQuotesBot Admin</title>
    <meta name="description" content="Adding and editing the awesome Grey's Anatomy quotes is now a blast!">
    <meta name="author" content="Ernesta Orlovaitė">
    
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/ico/apple-touch-icon-144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72.png">
    <link rel="apple-touch-icon" href="assets/ico/apple-touch-icon-57.png">

    <!-- Styles -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	body {
    		padding-top: 60px;
    	}
    </style>
    <link href="assets/style.css" rel="stylesheet">

    <!-- HTML5 shim -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
	<!-- Navigation -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a href="" class="brand"><img src="assets/ico/icon.png" alt="@GAQuotesBot" /></a>
				<ul class="nav">
					<li><a href="http://twitter.com/GAQuotesBot">@GAQuotesBot</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Navigation -->
	
	<!-- Content -->
	<div class="container-fluid">
		<!-- Random Quote -->
		<div id="random">
			<?php displayRandomQuote(); ?>
		</div>
		<!-- Random Quote -->
		
		<!-- Add Quote -->
		<form id="add" class="form-inline" autocomplete="off">
			<div class="input-prepend">
				<span class="add-on">S</span>
				<input class="input-mini" id="in-season" type="text">
			</div>
			
			<div class="input-prepend">
				<span class="add-on">E</span>
				<input class="input-mini" id="in-episode" type="text">
			</div>
			
			<input type="text" class="input-large" id="in-author" placeholder="Author" data-provide="typeahead">
			<input type="text" class="input-xxlarge" id="in-quote" placeholder="That awesome quote goes here!">
			<span id="count"></span>
			
			<button type="submit" class="btn pull-right" id="save">Save</button>
		</form>
		<!-- Add Quote -->
		
		<!-- Filer Quotes -->
		<div id="filter" class="btn-group">
			<button class="btn active" id="season-0">All Seasons</button>
			<?php displaySeasonButtons(); ?>
		</div>
		<!-- Filer Quotes -->
		
		<!-- All Quotes -->
		<table id="all" class="table table-hover">
			<tbody>
				<?php displayQuotesTable(); ?>
			</tbody>
		</table>
		<!-- All Quotes -->
	</div>
	<!-- Content -->

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/scripts.js"></script>
</body>
</html>