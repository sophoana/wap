/**
 * Vichrak Sean
 */

"use strict";

$(() => {

	initializeTiles();

	const initialTiles = getCurrentTilesWithPosition();

	let emptyTileTop = 300;
	let emptyTileLeft = 300;

    /**
     * It's triggered when the player click button 'Shuffle'.
     */
    $("#shufflebutton").click(() => {
        for(let i = 0; i < 100; i++) {
            const puzzlePieces = $(".puzzlepiece");
            let pieces = [];
            let k = 0;
            for(let j = 0; j < puzzlePieces.length; j++) {
                if((emptyTileTop === Math.floor($(puzzlePieces[j]).position().top)
                		&& (emptyTileLeft === Math.floor($(puzzlePieces[j]).position().left + 100)
                			|| emptyTileLeft === Math.floor($(puzzlePieces[j]).position().left - 100))) || 
                	(emptyTileLeft === Math.floor($(puzzlePieces[j]).position().left)
                		&& (emptyTileTop === Math.floor($(puzzlePieces[j]).position().top + 100)
                			|| emptyTileTop === Math.floor($(puzzlePieces[j]).position().top - 100)))) {
                    pieces[k] = $(puzzlePieces[j]);
                    k++;
                }
            }
            empty($(pieces[Math.floor(Math.random() * (pieces.length))]));
        }
    });

    /**
     * It's triggered when the player put mouse pointer over one of the tiles.
     */
    $(".puzzlepiece").hover(function() {
        if(isMovable($(this))) {
            $(this).addClass("movablepiece");
        }
    }, function() {
        $(this).removeClass("movablepiece");
    });

    /**
     * It's triggered when the player clicks one of the tiles to slide.
     */
    $(".puzzlepiece").click(function() {
        if(isMovable($(this))) {
            empty($(this));
            validateResult();
        }
    });

    /**
     * Initialize tiles.
     */
	function initializeTiles() {		
		const tiles = $("#puzzlearea div");
		for(let i = 0; i < tiles.length; i++) {
			const tile = tiles[i];
			const x = ((i % 4) * 100);
			const y = (Math.floor(i / 4) * 100);
			tile.className = "puzzlepiece";
			tile.style.left = x + "px";
			tile.style.top = y + "px";
			tile.style.backgroundImage = "url('background.jpg')";
			tile.style.backgroundPosition = -x + "px " + (-y) + "px";
			tile.x = x;
			tile.y = y;
		}
	}

    /**
     * Get current tiles containing position information.
     */
    function getCurrentTilesWithPosition() {
        const tiles = [];
        const puzzlepieces = $(".puzzlepiece");
        for(let i = 0; i < puzzlepieces.length; i++) {
        	tiles[i] = {
            	x: $(puzzlepieces[i]).position().left,
                y: $(puzzlepieces[i]).position().top
            };
        }
        return tiles;
    }

    /**
     * @param tile
     * @returns true if the tile is movable.
     */
    function isMovable(tile) {
    	const currentTilePosition = tile.position();
    	return (emptyTileTop === currentTilePosition.top
    			&& (emptyTileLeft === currentTilePosition.left + 100 || emptyTileLeft === currentTilePosition.left - 100))
        	|| (emptyTileLeft === currentTilePosition.left
        		&& (emptyTileTop === currentTilePosition.top + 100 || emptyTileTop === currentTilePosition.top - 100));
    }

    /**
     * Make the given tile to be an empty tile.
     * @param tile
     */
    function empty(tile) {
        const pos = tile.position();
        tile.css("top", emptyTileTop + "px");
        tile.css("left", emptyTileLeft + "px");
        emptyTileTop = pos.top;
        emptyTileLeft = pos.left;
    }

    /**
     * To evaluate if the player wins or not in case she arranges the tiles to be as the initial state.
     */
    function validateResult() {
        const currentTiles = getCurrentTilesWithPosition();
        let complete = true;
        for(let i = 0; i < initialTiles.length; i++) {
            if((Math.floor(initialTiles[i].x) !== Math.floor(currentTiles[i].x))
            		|| (Math.floor(initialTiles[i].y) !== Math.floor(currentTiles[i].y))) {
                complete = false;
            }
        }
        if(complete) {
            alert("You Win!");
        }
    }

});
