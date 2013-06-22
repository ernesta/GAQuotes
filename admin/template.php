<?php
	require("../quotes.php");
	
	
	function displayRandomQuote() {
		$quote = getQuote();
		
		echo "<p id='q'>" . $quote->quote . "</p>";
		echo "<span id='a'>" . $quote->author . "</span>";
		echo "<span id='s'> (S" . $quote->season . "</span>";
		echo "<span id='e'>E" . $quote->episode . ")</span>";
	}
	
	
	function displaySeasonButtons() {
		$seasons = getSeasonCount();
		
		for ($i = 1; $i <= $seasons; $i++) {
			echo "<button class='btn' id='season-" . $i . "'>S" . $i . "</button>";
		}
	}
	
	
	function displayQuotesTable() {
		$quotes = array_reverse(getSeasonQuotes());
		
		foreach ($quotes as $key => $quote) {
			echo "<tr id='" . $quote->id . "' class='s-" . $quote->season . "'>";
			
			echo "<td>" . $quote->season . "</td>";
			echo "<td>" . $quote->episode . "</td>";
			echo "<td>" . $quote->author . "</td>";
			echo "<td class='quote'>" . $quote->quote . "</td>";
			
			$edit = "<a href='' class='edit'><i class='icon-pencil'></i></a>";
			$delete = "<a href='' class='delete'><i class='icon-trash'></i></a>";
			echo "<td>" . $edit . $delete . "</td>";
			
			echo "</tr>";
		}
	}