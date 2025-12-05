document.body.onload = init();

function init() {
    console.log("start");
    todoBetolt();
}

function tobbSor(szoveg, id, vegeVan) {
    return `
        <div class="p-2 bg-light rounded-3 mb-3">
            <div class="container">
                <div class="row pt-3 pb-3 ">
                <div class="col-12 col-lg-9" style="font-size: 1.2rem">${szoveg}</div>
                <div class="col-4 col-sm-3 col-md-2 col-lg-1"><button class="btn btn-outline-secondary w-100 h-100
                ${vegeVan ? "bg-success" : ""}" onclick="pipa(${id})">✔</button></div>
                <div class="col-4 col-sm-3 col-md-2 col-lg-1"><button class="btn btn-outline-secondary w-100 h-100"
                data-id="${id}" ${!vegeVan ? "onclick=\"torol(this)\"" : ""} >🗑️</button></div>
                <div class="col-4 col-sm-3 col-md-2 col-lg-1"><button class="btn btn-outline-secondary w-100 h-100"
                ${!vegeVan ? "onclick=\"szerkeszt(" + id + ")\"" : ""} >✏️</button></div>
            </div>
        </div>
        `;
}

function todoBetolt() {
    fetch("todo")
        .then((x) => x.json())
        .then((adatok) => {
            document.getElementById("lista").innerText = "";
            adatok.forEach((todo) => {
                document.getElementById("lista").innerHTML += tobbSor(todo.szoveg, todo.id, todo.vege != "0000-00-00 00:00:00");
            });
        });
}

function hozzaAd() {

    let szoveg = document.getElementById("szoveg").value;

    let json = {
        memberid: "asd",
        feladat: szoveg
    };

    fetch("todo/", {
        method: "POST",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                document.getElementById("szoveg").value = "";
                todoBetolt();
            } else {
                document.getElementById("errorMessage").innerText = y.errorMessage;
                document.getElementById("errorRow").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("errorMessage").innerText = "";
                    document.getElementById("errorRow").classList.add("d-none");
                }, 5000);
            }
        })
}

function torol(elem) {

    let json = {
        memberid: "asd"
    };

    fetch("todo/" + elem.dataset.id, {
        method: "DELETE",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                todoBetolt();
            } else {
                document.getElementById("errorMessage").innerText = y.errorMessage;
                document.getElementById("errorRow").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("errorMessage").innerText = "";
                    document.getElementById("errorRow").classList.add("d-none");
                }, 5000);
            }
        })
}

function pipa(id) {

    let json = {
        memberid: "asd",
    };

    fetch("todo/" + id, {
        method: "PUT",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                todoBetolt();
            } else {
                document.getElementById("errorMessage").innerText = y.errorMessage;
                document.getElementById("errorRow").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("errorMessage").innerText = "";
                    document.getElementById("errorRow").classList.add("d-none");
                }, 5000);
            }
        })
}

function szerkeszt(id) {

    let json = {
        memberid: "asd",
    };

    fetch("todo/" + id, {
        method: "GET",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                console.log(y);
            } else {
                document.getElementById("errorMessage").innerText = y.errorMessage;
                document.getElementById("errorRow").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("errorMessage").innerText = "";
                    document.getElementById("errorRow").classList.add("d-none");
                }, 5000);
            }
        })
}
