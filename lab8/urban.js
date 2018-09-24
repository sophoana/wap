/**
 * Vichrak Sean
 */

"use strict";

$(() => {

	//const API_URL = "http://mumstudents.org/cs472/2014-02/Labs/8/urban.php";
	const API_URL = "http://mumstudents.org/cs472/2015-07-DE/Labs/8/urban.php";

	/**
	 * To search the term's definition when the user click Lookup button.
	 */
    $("#lookup").click(lookup);

    /**
     * To call lookup() function when the user presses Enter key.
     */
	$("#term").keyup(e => {
        if(e.keyCode === 13) {
        	lookup();
        }
    });

	/**
	 * Calls API to get definitions of the input term.
	 */
    function lookup() {
    	clearResult();
    	const term = $("#term").val();
    	if(term) {
    		$.ajax({
    			headers: {          
    				Accept: "text/xml; charset=utf-8",         
    				"Content-Type": "text/xml; charset=utf-8"
    			},
    			url: API_URL,
    			method: "GET",
    			data: {
    				term: term,
    				all: true
    			}
    		})
    		.done(xml => {
    			$("<ol></ol>").appendTo("#result");
    			$(xml).find("entry").each(function() {
    				const definition = $(this).children("definition").text();
    				const example = $(this).children("example").text();
    				const author = $(this).attr("author");
    				const li = $("<li></li>").appendTo("ol");
    				$("<p></p>").text(definition).appendTo(li);
    				$("<p></p>").addClass("example").text(example).appendTo(li);
    				$("<p></p>").addClass("author")
    				.text("- " + author)
    				.bind("click", () => showAllEntriesByAuthor(author))
    				.appendTo(li);
    			});
    		})
    		.fail(() => {
    			$("<h3></h3>").text("Term not found in the Urban Dictionary.").appendTo("#result");
    		});    		
    	}
    	$("#term").focus();
    }

    /**
     * For each term submitted by the given author, display the term itself followed by the date it was 
     * submitted in parentheses. Separate terms by commas.
     * @param authorName
     */
    function showAllEntriesByAuthor(authorName) {
    	$("#related").empty();
        $.ajax({
        	headers: {          
                Accept: "application/json; charset=utf-8",         
                "Content-Type": "application/json; charset=utf-8"
            },
        	url: API_URL,
			method: "GET",
			data: {author: authorName}
		})
		.done(json => {
			$("<h2></h2>").text("All entries by " + authorName).appendTo("#related");
			const termWithDateArray = $.map(json.entries, entry => `${entry.term} (${entry.submitted})`);
			$("<p></p>").text(termWithDateArray.join(", ")).appendTo("#related");
		})
		.fail(() => {
			$("<h2></h2>").text(`Entry not found for author ${authorName}.`).appendTo("#related");
		});
	}

    /**
     * Clear result & related block contents.
     * @returns
     */
    function clearResult() {
    	$("#result").empty();
    	$("#related").empty();
    }

});
