<button id="ide">
    sziaa
</button>


<?php
phpinfo(32);

if (isset($_GET["path"])) {
    $apiParts = explode("/", $_GET["path"]);
    var_dump($apiParts);
}
?>




<script>
    function f1() {
        fetch("/api/12121/121/2112", {
            method: "KUTYA",
            body: JSON.stringify({ username: "example" })
        })
            .then(x => x.text())
            .then(y => {
                m(y);
            })
    }

    function m(message) {
        document.getElementById("ide").innerHTML = message;
    }

</script>