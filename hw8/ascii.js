var PREVIOUS_TEXT = "";
var currentIdx = 0;
var interval;

function onSpeed(){
    if(!isStarted()) return;
    
    var time = document.getElementById("speed-id").checked == true ? 50 : 250;

    if(interval) {
        clearInterval(interval);
    }

    interval = setInterval(animate, time);
}

function onFontSize(){
    var element = document.getElementById("font-size-id");
    var fontSize = element.options[element.selectedIndex].value;

    var textArea = document.getElementById("text-area-id");
    textArea.style.cssText = "font-size: " + fontSize + "pt;";
}

function onAnimation(){
    if(!isStarted()) return;
    
    animate();
}

function animate(){
    var text = getAnimationText();
    var amines = text.split("=====\n");
    ++currentIdx;

    if(currentIdx >= amines.length)
        currentIdx = 0;

    displayText(amines[currentIdx]);
}

function getAnimationText(){
    var anima = document.getElementById("animation-id");
    var s = anima.options[anima.selectedIndex].value;
    return ANIMATIONS[s];
}
function isStarted(){
    return document.getElementById("start-id").disabled;
}

function start() {
    storePreviousText();
    toggleButton();
    
    var time = document.getElementById("speed-id").checked == true ? 50 : 250;
    if(interval)
        clearInterval(interval);

    interval = setInterval(animate, time);
}

function stop() {
    toggleButton();
    displayText(PREVIOUS_TEXT);
    clearInterval(interval);
}

function displayText(str) {
    var textArea = document.getElementById("text-area-id");
    textArea.value = str;
}

function toggleButton(){
    var start = document.getElementById("start-id");
    var stop = document.getElementById("stop-id");

    start.disabled = !start.disabled;
    stop.disabled = !stop.disabled;
}

function storePreviousText(){
    PREVIOUS_TEXT = document.getElementById("text-area-id").value;
}

function restorePreviousText(){
    document.getElementById("text-area-id").value = PREVIOUS_TEXT;
}