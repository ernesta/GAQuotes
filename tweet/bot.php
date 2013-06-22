#!/usr/bin/php -q

<?php
	// Includes
	require_once(dirname(__FILE__) . "/../quotes.php");
	require_once(dirname(__FILE__) . "/../secrets.php");
	
	require_once(dirname(__FILE__) . "/TwitterOAuth/twitteroauth.php");
	
	
	// Retrieves data
	$quote = getQuote();
	updateQuoteDate($quote->id);
	
	
	// Generates the tweet
	$tweet = $quote->quote . " - " . $quote->author . " (" . $quote->season . "x" . $quote->episode . ")";
	if (strlen($tweet) <= 126) {
		$tweet = $tweet . " #GreysAnatomy"; 
	}
	
	//Tweets
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
	$connection->post("statuses/update", array("status" => $tweet));