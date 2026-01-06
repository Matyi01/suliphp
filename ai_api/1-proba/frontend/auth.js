function login() {
fetch('http://localhost/suliphp/ai_api/1-proba/backend/api/login.php', {
method: 'POST',
headers: { 'Content-Type': 'application/json' },
body: JSON.stringify({ username: user.value, password: pass.value })
})
.then(r => r.json())
.then(d => {
if (d.token) {
localStorage.setItem('token', d.token);
location.href = 'dashboard.html';
} else {
alert('Hibás belépés');
}
});
}
