<?php
	require(dirname(__FILE__) . "/secrets.php");
	
	
	class Quote {
		public $id;
		public $quote;
		public $author;
		public $season;
		public $episode;
	}
	
	
	
	// Opens a connection to the database
	function openConn() {
		$host = "mysql:host=" . DB_HOST . ";";
		$database = "dbname=" . DB_NAME;
		
		try {
			$DBHandler = new PDO($host . $database, DB_USER, DB_PASSWORD);
			$DBHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex) {
			echo $ex->getMessage();  
		}
		
		return $DBHandler;
	}
	
	
	// Returns a specified or a random quote
	function getQuote($id = 0) {
		$DBHandler = openConn();
		
		if ($id === 0) {
			$query =
				"SELECT id, quote, author, season, episode
				FROM " . DB_TABLE . " " .
				"WHERE date < DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
				ORDER BY RAND()
				LIMIT 1;";
		} else {
			$query =
				"SELECT id, quote, author, season, episode
				FROM " . DB_TABLE . " " .
				"WHERE id = ?
				LIMIT 1;";	
		}
		
		$statement = $DBHandler->prepare($query);
		$statement->execute(array($id));
		$statement->setFetchMode(PDO::FETCH_CLASS, "Quote");
		
		$quote = $statement->fetch();
		
		$DBHandler = null;
		return $quote;
	}
	
	
	// Inserts a new quote
	function insertQuote($season, $episode, $author, $quote) {
		$DBHandler = openConn();
		
		$query =
			"INSERT INTO " . DB_TABLE . "(season, episode, author, quote)
			VALUES(?, ?, ?, ?);";
		
		$statement = $DBHandler->prepare($query);
		$statement->execute(array($season, $episode, $author, $quote));
		
		$id = $DBHandler->lastInsertId();
		
		$DBHandler = null;
		return $id;
	}
	
	
	// Updates an existing quote's text
	function updateQuoteText($id, $quote) {
		$query =
			"UPDATE " . DB_TABLE . " " .
			"SET quote = ?
			WHERE id = ?;";
		
		executeQuery($query, array($quote, $id));
	}
	
	
	// Updates an existing quote's access date
	function updateQuoteDate($id) {
		$query =
			"UPDATE " . DB_TABLE . " " .
			"SET date = CURRENT_DATE()
			WHERE id = ?;";
		
		executeQuery($query, array($id));
	}
	
	
	// Deletes a quote
	function deleteQuote($id) {
		$query =
			"DELETE FROM " . DB_TABLE . " " .
			"WHERE id = ?;";
		
		executeQuery($query, array($id));
	}
	
	
	// Counts seasons
	function getSeasonCount() {
		$DBHandler = openConn();
		
		$query =
			"SELECT MAX(season)
			FROM " . DB_TABLE . ";";
		
		$statement = $DBHandler->query($query);
		$count = $statement->fetch();
		
		$DBHandler = null;
		return $count[0];
	}
	
	
	// Retrieves all quote authors
	function retrieveAuthors() {
		$DBHandler = openConn();
		
		$query =
			"SELECT DISTINCT author
			FROM " . DB_TABLE . " " .
			"ORDER BY author ASC;";
		
		$statement = $DBHandler->query($query);
		
		$authors = array();
		while ($author = $statement->fetch()) {
			$authors[] = $author;
		}
		
		$DBHandler = null;
		return $authors;
	}
	
	
	// Returns either all quotes, or all quotes for a specified season
	function getSeasonQuotes($season = 0) {
		$DBHandler = openConn();
		
		if ($season === 0) {
			$query =
				"SELECT id, quote, author, season, episode
				FROM " . DB_TABLE . " " .
				"ORDER BY season, episode ASC;";
		} else {
			$query =
				"SELECT id, quote, author, season, episode
				FROM " . DB_TABLE . " " .
				"WHERE season = ?
				ORDER BY episode ASC;";
		}
		
		$statement = $DBHandler->prepare($query);
		$statement->execute(array($season));
		
		$statement->setFetchMode(PDO::FETCH_CLASS, "Quote");
		
		$quotes = array();
		while($quote = $statement->fetch()) {
			$quotes[] = $quote;
		}
		
		$DBHandler = null;
		return $quotes;
	}
	
	
	// Performs a simple query
	function executeQuery($query, $params) {
		$DBHandler = openConn();
		
		$statement = $DBHandler->prepare($query);
		$statement->execute($params);
		
		$DBHandler = null;
	}