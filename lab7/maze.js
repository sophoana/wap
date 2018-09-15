/**
 * Vichrak Sean
 */

"use strict";

$(() => {

	/**
	 * It's triggered when the player clicks 'S' button.
	 */
    $("#start").click(() => {
    	updateStatus("Good Luck!");
    	$(".boundary").removeClass("youlose");
    	bindEvents(true);
    });

    /**
     * It shows that the player wins.
     */
    function youWin() {
		updateStatus("You win! :] Click 'S' to play again.");
		bindEvents(false);
    }

    /**
     * It shows that the player loses.
     */
    function youLose() {
    	$(".boundary").addClass("youlose");
    	updateStatus("You lose! :[ Click 'S' to retry.");
    	bindEvents(false);
    }

    /**
     * To bind or unbind needed events.
     * @param enabled
     */
    function bindEvents(enabled) {
    	if(enabled) {
        	$("#end").bind("mouseover", youWin);
        	$("#maze").bind("mouseleave", youLose);
        	$(".boundary").bind("mouseover", youLose);
    	}
    	else {
        	$("#end").unbind("mouseover");
        	$("#maze").unbind("mouseleave");
        	$(".boundary").unbind("mouseover");
    	}
    }

    /**
     * To show if the player wins or loses.
     * @param text
     */
    function updateStatus(text) {
    	$("#status").text(text);
    }

});
