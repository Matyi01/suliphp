/*

login:
    adatbekérés
        felhasználónév
        jelszó
    elküldés az apinak
        post
    api feldolgozza
        megkapja
            felhasználónév
            jelszó
        adarbázis ellenőrzés
            nev-jelszó páros
            jelszo: password_hash()???
        ha nem stimmel
            akkor hiba: nem jo adat
        ha jok az adatok
            token generálás
            elmenti az adatbázisba
            lejárati időt is

            token visszaküldése (json-ben)

    frontend megkapja
        json feldolgozás
        hiba esetén hibaüzenet megjelenítése
        ha van hiba
        token eltárolása
            süti vagy localstorage
        belépett tartalom megjelenítése

login után 
bármilyen kommunikációnál el kell küldeni a tokent
    api feldolgozza
    token ellenőrzése
        ha még jó
            kért feladatok elvégzése
            a token lejárati idejének frissítése
            eredmény visszaadaása
        ha nem jó
            hiba: lejárt/kilépett/újra belépés

    adatok feldolgozása




regisztráció:
    form 
        username
        email
        jelszo * 2
        elfelejtett jelszo link

*/


function login(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch("login", {
        method: "POST",
        body: JSON.stringify({
            username: username,
            password: password
        })
    })
        .then(response => response.json())
        .then(json => {
            console.log(json);
            if (json.status == "success") {
                //sikeres bejelentkezés
                localStorage.setItem("token", json.data.token);
                localStorage.setItem("expires", json.data.expires);
                document.getElementById("login").classList.add("d-none");
                document.getElementById("loggedIn").classList.remove("d-none");
            } else {
                //hiba
                console.log(json.errorMessage);
            }

        })
}

function logInCheck() {

    fetch("logincheck", {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + localStorage.getItem("token"),
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(json => {
            console.log(json);

        });
}

