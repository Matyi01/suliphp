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
        .then(x => x.json())
        .then(y => {
            document.getElementById("lista").innerText = "";
            y.forEach((todo) => {
                document.getElementById("lista").innerHTML += tobbSor(todo.szoveg, todo.id, todo.vege != "0000-00-00 00:00:00");
            });
            if (y.every(adat => adat.vege != "0000-00-00 00:00:00") && y.length != 0) {
                let minentTorloGomb = document.createElement("button");
                minentTorloGomb.classList.add("btn", "btn-danger", "w-100", "mb-3", "p-3", "fs-4");
                minentTorloGomb.innerText = "Mindent töröl";
                minentTorloGomb.setAttribute("onclick", "mindentTorol()");
                document.getElementById("lista").insertBefore(minentTorloGomb, document.getElementById("lista").firstChild);
            }
        });
}

function hozzaAd(id = -1) {
    //-1 az uj
    //másik id a szerkesztes



    let szoveg = document.getElementById("szoveg").value;

    let json = {
        memberid: "asd",
        feladat: szoveg
    };

    //TODO ha van id akkor put (id != -1)
    //ha nincs akkor post (id == -1)

    if (id == -1) {
        //hozzadás

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

    } else {
        //szerkesztés
        fetch("todo/" + id + "/edit", {
            method: "PUT",
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
        memberid: "asd"
    };

    fetch("todo/" + id + "/pipa", {
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
        memberid: "asd"
    };

    fetch("todo/" + id + "?memberid=" + json.memberid, {
        method: "GET"
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                console.log(y);
                document.getElementById("szoveg").value = y.data[0].szoveg;
                //document.getElementById("plusGomb").onclick = "hozzaAd(" + y.data[0].id + ")";
                document.getElementById("plusGomb").setAttribute("onclick", "hozzaAd(" + y.data[0].id + ")");

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

function mindentTorol() {
    let json = {
        memberid: "asd"
    };
    fetch("todo/all", {
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