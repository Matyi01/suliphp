
function versek(db = 0) {
    if (db == 0) {
        fetch("versek")
            .then(response => response.json())
            .then(data => {
                console.log(data);
                //return data[0];
                // 1 random vers
            });
    } else if (db > 0) {
        fetch("versek/" + db)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                //return data;
                // db random vers
            });
    }
}

function vers(id) {
    fetch("vers/" + id)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            //return data[0];
            // egy vers
        });
}

function kolto(id = 0) {
    if (id == 0) {
        fetch("kolto")
            .then(response => response.json())
            .then(data => {
                console.log(data);
                //return data;
                // összes költő
                bal(data);
            });
    } else if (id > 0) {
        fetch("kolto/" + id)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                //return data[0];
                // egy költő
            });
    }
}

function init() {
    kolto();
    fejlec();
    fetch("versek/4")
        .then(response => response.json())
        .then(data => {

            jobb(data);
        });
}

function bal(adatok) {
    vissza = "";
    adatok.forEach(e => {
        vissza += `<button class="btn btn-light w-100 m-1" onclick="koltoClick(${e.id})">
            ${e.nev}
        </button>
        `;
    });
    document.getElementById("bal").innerHTML = vissza;
}

function jobb(adatok) {
    vissza = "";
    adatok.forEach(e => {
        vissza += `<div class="p-2 m-2 bg-light rounded-3">
            <h4>
                ${e.cim}
            </h4>
            <p>
                ${e.versszakok}
            </p>
            <i>
                ${e.kolto_nev}
            </i>
        </div>`;
    });
    document.getElementById("jobb").innerHTML = vissza
}

function fejlec() {
    fetch("versek")
        .then(response => response.json())
        .then(data => {
            vissza = "";
            data.forEach(e => {
                vissza += `<div class="p-2 m-2 bg-light rounded-3">
            <p>
                „
                ${e.versszakok}
                ”
            </p>
            <i>
                ${e.kolto_nev}: 
                ${e.cim},
            </i>
            <span>
                ${e.megjelenes_eve}
            </span>
        </div>`;
            });
            document.getElementById("fejlec").innerHTML = vissza
        });
}

function koltoClick(id) {
    fetch("kolto/" + id)
        .then(response => response.json())
        .then(data => {
            console.log(data);

            e = data[0];
            vissza = `<div class="p-2 m-2 bg-light rounded-3">
                <h2>
                    ${e.nev}
                </h2>
                <p>
                    ${e.eletrajz}
                </p>
                <p>
                    Született: ${e.szuletesi_datum}, ${e.szuletesi_hely}
                </p>
                <p>
                    Elhunyt: ${e.halalozi_datum}, ${e.halalozi_hely}
                </p>
                <p>
                    Versei: ${e.versek_cimei}
                </p>
            </div>`;
            document.getElementById("jobb").innerHTML = vissza
        });
}

setInterval(fejlec, 30000);