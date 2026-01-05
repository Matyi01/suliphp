/*
A megadott api segítségével készítsetek egy reszponzív frontendet, Bootstrap segítségével, ahol egy navbar segítségével lehet választani
hogy melyik funkciót (fakt, szorzat, haromszog, random, lorem) akarjuk látni! Csak az aktív legyen látható, a többi nem!
A kommunikációhoz a fetch API-t használjátok! 
Legyen ízlésesen megformázva, fejléccel, lábléccel, címmel, alcímekkel, magyarázó szövegekkel, eredmény megjelenítéssel.
*/

function faktShow() {
    document.getElementById("fakt").classList.remove("d-none");
    document.getElementById("szorzat").classList.add("d-none");
    document.getElementById("haromszog").classList.add("d-none");
    document.getElementById("random").classList.add("d-none");
    document.getElementById("lorem").classList.add("d-none");
    document.getElementById("home").classList.add("d-none");
}

function szorzatShow() {
    document.getElementById("fakt").classList.add("d-none");
    document.getElementById("szorzat").classList.remove("d-none");
    document.getElementById("haromszog").classList.add("d-none");
    document.getElementById("random").classList.add("d-none");
    document.getElementById("lorem").classList.add("d-none");
    document.getElementById("home").classList.add("d-none");
}

function haromszogShow() {
    document.getElementById("fakt").classList.add("d-none");
    document.getElementById("szorzat").classList.add("d-none");
    document.getElementById("haromszog").classList.remove("d-none");
    document.getElementById("random").classList.add("d-none");
    document.getElementById("lorem").classList.add("d-none");
    document.getElementById("home").classList.add("d-none");
}

function randomShow() {
    document.getElementById("fakt").classList.add("d-none");
    document.getElementById("szorzat").classList.add("d-none");
    document.getElementById("haromszog").classList.add("d-none");
    document.getElementById("random").classList.remove("d-none");
    document.getElementById("lorem").classList.add("d-none");
    document.getElementById("home").classList.add("d-none");
}

function loremShow() {
    document.getElementById("fakt").classList.add("d-none");
    document.getElementById("szorzat").classList.add("d-none");
    document.getElementById("haromszog").classList.add("d-none");
    document.getElementById("random").classList.add("d-none");
    document.getElementById("lorem").classList.remove("d-none");
    document.getElementById("home").classList.add("d-none");
}

function fakt() {
    let szam = document.getElementById("faktInput").value;

    fetch("fakt/" + szam)
        .then(response => response.json())
        .then(data => {
            document.getElementById("faktOutput").innerText = data.eredmeny;
        })

}

function szorzat() {
    let szam1 = document.getElementById("szorzatInput1").value;
    let szam2 = document.getElementById("szorzatInput2").value;

    fetch("szorzat/" + szam1 + "/" + szam2)
        .then(response => response.json())
        .then(data => {
            document.getElementById("szorzatOutput").innerText = data.eredmeny;
        })

}

function haromszog() {
    let szam1 = document.getElementById("haromszogInput1").value;
    let szam2 = document.getElementById("haromszogInput2").value;
    let szam3 = document.getElementById("haromszogInput3").value;

    fetch("haromszog/" + szam1 + "/" + szam2 + "/" + szam3)
        .then(response => response.json())
        .then(data => {
            document.getElementById("haromszogOutput").innerText = "Szerkeszthető: " + (data.eredmeny.szerkesztheto ? "igen" : "nem") + ", terület: " + data.eredmeny.terulet;
        })

}

function random() {
    let szam1 = document.getElementById("randomInput1").value;
    let szam2 = document.getElementById("randomInput2").value;
    let szam3 = document.getElementById("randomInput3").value;

    if (szam2 == NaN && szam3 == NaN) {
            fetch("random/" + szam1)
        .then(response => response.json())
        .then(data => {
            document.getElementById("randomOutput").innerText = data.eredmeny;
        })

    } else if (szam3 == NaN) {
        fetch("random/" + szam1 + "/" + szam2)
        .then(response => response.json())
        .then(data => {
            document.getElementById("randomOutput").innerText = data.eredmeny;
        })

    } else {
        fetch("random/" + szam1 + "/" + szam2 + "/" + szam3)
        .then(response => response.json())
        .then(data => {
            document.getElementById("randomOutput").innerText = data.eredmeny;
        })

    }
}

function lorem() {
    let szam = document.getElementById("loremInput").value;

    fetch("lorem/" + szam)
        .then(response => response.json())
        .then(data => {
            document.getElementById("loremOutput").innerText = data.eredmeny;
        })

}