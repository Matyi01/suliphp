document.body.onload = init();

let fiukTomb = [];
let lanyokTomb = [];

let tancokTomb = [];

let aktivTanc1 = "";
let aktivEmber1 = "";

let aktivEmber2 = "";
let aktivTanc2 = "";

function init() {
    emberekBetolt();
    tancBetolt();
}

function tancBetolt() {
    fetch("feladat/tancok")
        .then(x => x.json())
        .then(y => {
            tancokTomb = y.tancok;
            tancFeltolt();
            aktivTanc1 = tancokTomb[0];
            aktivTanc2 = tancokTomb[0];
        });
}

function tancFeltolt() {
    let szoveg = "";
    tancokTomb.forEach(e => {
        //<option value="cha-cha">cha-cha</option>
        szoveg += `<option value="${e}">${e}</option>`;
    });
    document.getElementById("tancValaszto1").innerHTML = szoveg;
    document.getElementById("tancValaszto2").innerHTML = szoveg;
}

function emberekBetolt() {
    fetch("feladat/emberek")
        .then(x => x.json())
        .then(y => {
            fiukTomb = y.fiuk;
            lanyokTomb = y.lanyok;
            emberFeltolt();
            aktivEmber1 = fiukTomb[0];
            aktivEmber2 = fiukTomb[0];
        });
}

function emberFeltolt() {
    let szoveg = "";
    fiukTomb.forEach(e => {
        //<option value="cha-cha">cha-cha</option>

        szoveg += `<option value="${e}">${e}</option>`;
    });
    lanyokTomb.forEach(e => {
        szoveg += `<option value="${e}">${e}</option>`;
    });
    document.getElementById("emberValaszto1").innerHTML = szoveg;
    document.getElementById("emberValaszto2").innerHTML = szoveg;
}

function emberValaszt1() {
    aktivEmber1 = document.getElementById("emberValaszto1").value;
}

function tancValaszt1() {
    aktivTanc1 = document.getElementById("tancValaszto1").value;
}

function emberValaszt2() {
    aktivEmber2 = document.getElementById("emberValaszto2").value;
}

function tancValaszt2() {
    aktivTanc2 = document.getElementById("tancValaszto2").value;
}

function tablazatLetrehoz(parok) {
    let szoveg = "<tr><th>Fiúk</th> <th>Lányok</th></tr>";
    parok.forEach(e => {
        szoveg += `<tr><td>${e.fiu}</td><td>${e.lany}</td></tr>`;
    });
    document.getElementById("tablazat").innerHTML = szoveg;
}

function feladat2() {
    fetch("feladat/2", {
        method: "POST",
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-2").classList.add("d-none");
            document.getElementById("feladat-2").classList.remove("d-none");
            document.getElementById("feladat-2").innerText = y.eredmeny;
        })
}

function feladat3() {
    let json = {
        tanc: aktivTanc1
    };
    fetch("feladat/3", {
        method: "POST",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-3").classList.add("d-none");
            document.getElementById("tancValaszto1").classList.add("d-none");
            document.getElementById("feladat-3").classList.remove("d-none");
            document.getElementById("feladat-3").innerText = y.eredmeny;
        })
}

function feladat4() {
    let json = {
        ember: aktivEmber1
    };
    fetch("feladat/4", {
        method: "POST",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-4").classList.add("d-none");
            document.getElementById("emberValaszto1").classList.add("d-none");
            document.getElementById("feladat-4").classList.remove("d-none");
            document.getElementById("feladat-4").innerText = y.eredmeny;
        })
}

function feladat5() {
    let json = {
        ember: aktivEmber2,
        tanc: aktivTanc2
    };
    fetch("feladat/5", {
        method: "POST",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-5").classList.add("d-none");
            document.getElementById("emberValaszto2").classList.add("d-none");
            document.getElementById("tancValaszto2").classList.add("d-none");
            document.getElementById("feladat-5").classList.remove("d-none");
            document.getElementById("feladat-5").innerText = y.eredmeny;
        })
}

function feladat6() {
    fetch("feladat/6", {
        method: "POST",
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-6").classList.add("d-none");
            document.getElementById("feladat-6").classList.remove("d-none");
            document.getElementById("feladat-6").innerText = y.eredmeny;
        })
}

function feladat7() {
    fetch("feladat/7", {
        method: "POST",
    })
        .then(x => x.json())
        .then(y => {
            document.getElementById("gomb-7").classList.add("d-none");
            document.getElementById("feladat-7").classList.remove("d-none");
            document.getElementById("tablazat").classList.remove("d-none");
            document.getElementById("feladat-7").innerText = y.eredmeny;
            tablazatLetrehoz(y.parok);
        })
}
