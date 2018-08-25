
function helloWorld () {
    alert("Hello, world!")
}

function changeText() {
    var textArea = document.getElementById("txtArea");
    var fontSize = 12;
    if(textArea.style.fontSize == ""){
        textArea.style.fontSize = (fontSize + 2) + "pt";
    }
    else {
        fontSize = parseInt(textArea.style.fontSize.replace("pt", ""));
        textArea.style.fontSize = (fontSize + 2) + "pt";
    }
}

function boldTextArea() {
    var element = document.getElementById("txtArea");
    var chkBling = document.getElementById("checkBling");

    if(chkBling.checked == true){
        element.classList.add("bold");
        element.classList.add("green");
        element.classList.add("underline");

        $("body").addClass("background");
    }
    else {
        element.classList.remove("bold");
        element.classList.remove("green");
        element.classList.remove("underline");

        $("body").removeClass("background");
    }
}

function pigLatin(){
    var element = document.getElementById("txtArea");
    
    if(element.value == "") {
        alert ("TextArea is empty!");
        return;
    }
    
    var txt = element.value.replace(/\n/g, " " ).split(" ");
    var pig = [];
    var vowels = ['a', 'e', 'i', 'o', 'u'];

    txt.forEach(item => {
        if(vowels.includes(item.charAt(0).toLowerCase())){
            var str = item.substring(1) + item.charAt(0) + "ay";
            pig.push(str);
        }
        else{
            pig.push(item + "ay");
        }
    });

    element.value = pig.join(' ');
}

function malkovitch(){
    var element = document.getElementById("txtArea");
    if(element.value == "") {
        alert ("TextArea is empty!");
        return;
    }
    
    var txt = element.value.replace(/\n/g, " " ).split(" ");
    var mText = [];
    txt.forEach(v => {
        if(v.length >= 5){
            mText.push("Malkovich");
        } else {
            mText.push(v);
        }
    });

    element.value = mText.join(' ');
}