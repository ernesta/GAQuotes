<?php
	require("../quotes.php");
	
	
	$type = $_POST["type"];
	switch ($type) {
		case "delete":
			$id = $_POST["id"];
			deleteQuote($id);
			
			break;
		case "insert":
			$season = $_POST["season"];
			$episode = $_POST["episode"];
			$author = stripslashes($_POST["author"]);
			$quote = stripslashes($_POST["quote"]);
			
			$id = insertQuote($season, $episode, $author, $quote);
			echo $id;
			
			break;
		case "update":
			$id = stripslashes($_POST["id"]);
			$quote = stripslashes($_POST["quote"]);
			
			updateQuoteText($id, $quote);
			
			break;
		case "authors":
			$authors = retrieveAuthors();
			echo json_encode($authors);
			
			break;
	}