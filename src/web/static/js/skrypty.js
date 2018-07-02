$(document).ready(function () {
    $("#javas").click(function () {
        $("form").hide();
        $("p").hide();
    });
}); 
 
$(function () {
    $("#local").dialog()
});
$(function () {
    $('input').tooltip();
});

function zliczajLocal() {
    if (localStorage.click_count) {
        localStorage.click_count = Number(localStorage.click_count) + 1;
    } else {
        localStorage.click_count = 1;
    }
    if (localStorage.click_count > 0) {
        var div = document.getElementById("local");
        div.innerHTML = "Jestes odwiedzajacym nr " + localStorage.click_count + ". Dziekujemy wam za to,ze jest was tak duzo!";
    }

}
function zliczaj() {
    if (sessionStorage.click_count) {
        sessionStorage.click_count = Number(sessionStorage.click_count) + 1;
    } else {
        sessionStorage.click_count = 1;
    }


    var div = document.getElementById("text");
    div.innerHTML = "(Uzycie sessionStorage " + sessionStorage.click_count + " raz.)";

    var zmienna = document.createElement("div");
    var text = document.createTextNode("Z pomoca sessionStorage mozesz pomoc ulepszac nasza strone.");
    zmienna.appendChild(text);
    var element = document.getElementById("text");
    element.appendChild(zmienna);

    var br = document.createElement("br");
    element.appendChild(br);

    var zmienna = document.createElement("div");
    var text = document.createTextNode("Wpisz samodzielnie 3 inne propozycje zmian na naszej stronie:");
    zmienna.appendChild(text);
    var element = document.getElementById("text");
    element.appendChild(zmienna);

    var input = document.createElement("input");
    input.className = "inputy";
    input.classList.add("inputy");
    element.appendChild(input);

    var br = document.createElement("br");
    element.appendChild(br);

    var input1 = document.createElement("input");
    input1.className = "inputy";
    input1.classList.add("inputy");
    element.appendChild(input1);
    var br = document.createElement("br");
    element.appendChild(br);
    var input1 = document.createElement("input");
    input1.className = "inputy";
    input1.classList.add("inputy");
    element.appendChild(input1);

    var br = document.createElement("br");
    element.appendChild(br);

    var button = document.createElement("button");
    var text1 = document.createTextNode("Kliknij by zakonczyc");
    button.appendChild(text1);
    element.appendChild(button);

    button.addEventListener("click", zakoncz);


}
function zakoncz() {
    window.location = "opcja2";
}
function zmien() {

    var zmienna = document.createElement("p");
    var text = document.createTextNode("Szpony i kly - zbior opowiadan o fabule toczacej sie w swiecie wiedzminskim stworzonym przez Andrzeja Sapkowskiego, wylonionych na drodze konkursu zorganizowanego przez miesiecznik Nowa Fantastyka w 2016 roku.");
    zmienna.appendChild(text);
    var element = document.getElementById("tresc");
    element.appendChild(zmienna);
}
function wlacz() {
    

 /*   var zmienna = document.createElement("div");
    var text = document.createTextNode("Wlasnie zmieniles nasza strone z JavaScript :)");
    zmienna.appendChild(text);
    var element = document.getElementById("text");
    element.appendChild(zmienna);

    var zmienna1 = document.createElement("button");
    var text1 = document.createTextNode("sessionStorage");
    zmienna1.appendChild(text1);
    var element1 = document.getElementById("text");
    element1.appendChild(zmienna1);
    */
    element1.addEventListener("click", zliczaj);



}

