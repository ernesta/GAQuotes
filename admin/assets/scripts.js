// Attributes
var url = "post.php";

var maxCount = 140 - 7;
var remCount = maxCount;

var authors = [];
var season = 0;
var episode = 0;



//// Event Listeners ////
$("#save").on("click", addQuote);
$(".edit").on("click", editQuote);
$(".delete").on("click", deleteQuote);
$(".btn-group .btn").on("click", filterSeasons);



//// Initial Setup ////
$(function() {
	// Fill episode and season numbers
	fillSeasonAndEpisode();
	
	// Update character count
	setCharacterCount();
	setInterval(countCharacters, 500);
	
	// Prepare typeahead authors
	setTypeaheadAuthors();
});



//// Database ////
// Deletes a quote
function deleteQuote(event) {
	event.preventDefault();
	
	var id = $(this).closest("tr").attr("id");
	
	$.ajax({
		type: "POST",
		url: url,
		data: {
			type: "delete",
			id: id
		}
	}).done(function() {
		$("#" + id).remove();
	});
}


// Adds a quote
function addQuote(event) {
	event.preventDefault();
	
	var season = $("#in-season").val();
	var episode = $("#in-episode").val();
	var author = $("#in-author").val();
	var quote = $("#in-quote").val();
	
	var s = "s-" + season;
	
	$.ajax({
		type: "POST",
		url: url,
		data: {
			type: "insert",
			season: season,
			episode: episode,
			author: author,
			quote: quote
		}
	}).done(function(id) {
		$("#add")[0].reset();
		var id = 5;
		var html = "<tr id=" + id + " class='info " + s + "'>";
		html += "<td>" + season + "</td>";
		html += "<td>" + episode + "</td>";
		html += "<td>" + author + "</td>";
		html += "<td class='quote'>" + quote + "</td>";
		html += "<td><a href='' class='edit'><i class='icon-pencil'></i></a><a href='' class='delete'><i class='icon-trash'></i></a></td>";
		html += "</tr>";
		
		$("#all tbody").prepend(html);
		
		$(".delete").on("click", deleteQuote);
		$(".edit").on("click", editQuote);
		
		fillSeasonAndEpisode();
	});
}


// Updates a quote
function updateQuote(event) {
	if (event.which === 13) {
		event.preventDefault();
		
		var id = $(this).closest("tr").attr("id");
		var quote = $(this).val();
		
		$.ajax({
			type: "POST",
			url: url,
			data: {
				type: "update",
				id: id,
				quote: quote
			}
		}).done(function() {
			$("#" + id + " .quote").html(quote);
		});
	}
}


//// UI ////
// Fills in season and episode numbers
function fillSeasonAndEpisode() {
	season = $("tr td")[0]["textContent"];
	episode = $("tr td")[1]["textContent"];
	
	$("#in-season").val(season);
	$("#in-episode").val(episode);
}


// Retrieves typeahead authors
function setTypeaheadAuthors() {
	$.ajax({
		type: "POST",
		url: url,
		data: {
			type: "authors"
		}
	}).done(function(data) {
		raw = JSON.parse(data);
		
		for (var i = 0; i < raw.length; i++) {
			authors[i] = raw[i][0];
		}
		
		$("#in-author").typeahead({ source: authors });
	});
}


// Counts tweet characters
function countCharacters() {
	var curCount = maxCount -
		$("#in-season").val().length -
		$("#in-episode").val().length -
		$("#in-author").val().length -
		$("#in-quote").val().length;
	
	if (curCount != remCount) {
		remCount = curCount;
		setCharacterCount();
	}
}


// Displays character count
function setCharacterCount() {
	$("#count").text(remCount); 
}


// Filters quotes by season
function filterSeasons(event) {
	event.preventDefault();
	
	var id = $(this).attr("id");
	var season = "s-" + id.split("-")[1];
	
	$(this).siblings(".active").removeClass("active");
	$(this).addClass("active");
	
	var table = $("tbody tr");
	
	for (var i = 0; i < table.length; i++) {
		var row = $(table[i]);
		var classes = row.attr("class").split(/\s+/);
		
		if (season === "s-0" || classes.indexOf(season) > -1 || classes.indexOf("info") > -1) {
			row.show();
		} else {
			row.hide();
		}	
	}
}


// Allows quote editing
function editQuote(event) {
	event.preventDefault();
	
	var id = $(this).closest("tr").attr("id");
	var quote = $("#" + id).children(".quote").text();
	
	$("#" + id + " .quote").html("<textarea rows='1'>" + quote + "</textarea>");
	$("#" + id + " .quote textarea").keypress(updateQuote);
}