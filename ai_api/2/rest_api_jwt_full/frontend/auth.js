
function login() {
    fetch('http://localhost/suliphp/ai_api/2/rest_api_jwt_full/backend/api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: u.value, password: p.value })
    })
        .then(r => r.json())
        .then(d => {
            console.log(d);
            if (d.error) {
                alert("nem jo login");
                return;
            }
            localStorage.token = d.token;
            location = 'dashboard.html';
        });
}

function reg() {
    fetch('http://localhost/suliphp/ai_api/2/rest_api_jwt_full/backend/api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: u.value, password: p.value })
    })
        .then(r => r.json())
        .then(() => {
            alert("Registration successful!");
            location = 'index.html'
        });
}


