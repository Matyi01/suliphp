document.body.onload = init();

function init() {
    console.log("start");
    sorBetolt();
}

function tobbSor(sor) {
    return `
        <div class="p-2 bg-light rounded-3 mb-3">
            <div class="container">
                <div class="row pt-3 pb-3">
                <div class="col-9" style="font-size: 1.2rem">${sor}</div>
                <div class="col-1"><button class="btn btn-outline-secondary w-100 h-100">✔</button></div>
                <div class="col-1"><button class="btn btn-outline-secondary w-100 h-100">🗑️</button></div>
                <div class="col-1"><button class="btn btn-outline-secondary w-100 h-100">✏️</button></div>
            </div>
        </div>
        `;
}

function sorBetolt() {
    fetch("todo")
        .then((x) => x.json())
        .then((adatok) => {
            adatok.forEach((todo) => {
                document.getElementById("lista").innerHTML += tobbSor(todo.szoveg);
            });
        });
}

function hozzaAd() {

    let szoveg = document.getElementById("szoveg").value;

    let json = {
        memberid: "asd",
        feladat: szoveg
    };
    fetch("todo/",{
        method: "POST",
        body: JSON.stringify(json)
    })
    .then(x => x.json())
    .then(y => console.log(y))
}