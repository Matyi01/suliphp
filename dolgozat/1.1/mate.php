<?php
/**
 * <?= $valami ?> - ez ugyanaz, mint: <?php echo $valami; ?>
 *
 * Több soros string:
 * $x = <<<VALAMI
 *  <table>
 *      <thead>
 *      </thead>
 *  </table>
 * VALAMI;
 *
 */

session_start();

const ADMIN_NAME = "admin";
const ADMIN_PASSWORD = "admin";

$adminUser = [ "name" => ADMIN_NAME, "pass" => ADMIN_PASSWORD, "admin" => true ];
if ( !isset( $_SESSION["users"] ) ) {
    $_SESSION["users"] = [ $adminUser ];
    $_SESSION["login"] = null;
}

if ( $_SERVER["REQUEST_METHOD"] === "POST" ) {
    if ( isset( $_POST["logout"] ) ) {
        $_SESSION["login"] = null;
    }
    else if ( isset( $_POST["login"] ) ) {
        $name = $_POST["name"];
        $pass = $_POST["pass"];

        foreach ( $_SESSION["users"] as $user ) {
            if ( $user["name"] === $name && $user["pass"] === $pass ) {
                $_SESSION["login"] = [
                        "name" => $user["name"],
                        "admin" => $user["admin"]
                ];
                break;
            }
        }
    }
    else if ( isset( $_POST["addUser"] ) ) {
        $_SESSION["users"][] = [ "name" => $_POST["name"], "pass" => $_POST["pass"], "admin" => false ];
    }
    else if ( isset( $_POST["delUser"] ) ) {
        $id = $_POST["id"];
        if ( isExistingNonAdminUser( $id ) ) {
            unset( $_SESSION["users"][$id] );
        }
    }
    else if ( isset( $_POST["addAdminRole"] ) ) {
        $id = $_POST["id"];
        if ( isExistingNonAdminUser( $id ) ) {
            $_SESSION["users"][$id]["admin"] = true;
        }
    }
    else if ( isset( $_POST["removeAdminRole"] ) ) {
        $id = $_POST["id"];
        if ( isExistingNonAdminUser( $id ) ) {
            $_SESSION["users"][$id]["admin"] = false;
        }
    }

    header( "Location: " . $_SERVER["PHP_SELF"] );
    exit;
}

function isExistingNonAdminUser( $id ) {
    return isset( $_SESSION["users"][$id] ) && $_SESSION["users"][$id]["name"] !== ADMIN_NAME;
}

function isAdmin() {
    return $_SESSION["login"]["admin"] ?? false;
}

function generateUserList() {
    $userList = "";
    foreach ( $_SESSION["users"] as $id => $user ) {
        $name = htmlspecialchars( $user["name"] );
        $pass = htmlspecialchars( $user["pass"] );
        $admin = $user["admin"] ? "Igen" : "Nem";

        $actions = '';
        if ( isAdmin() ) {
            $actions .= '<form action="" method="post"><input type="hidden" name="id" value="' . $id . '"><input type="submit" name="delUser" value="X"' . ( $name === ADMIN_NAME ? ' disabled' : '' ) . '></form>';

            if ( $user["admin"] ) {
                $actions .= '<form action="" method="post"><input type="hidden" name="id" value="' . $id . '"><input type="submit" name="removeAdminRole" value="U"' . ( $name === ADMIN_NAME ? ' disabled' : '' ) . '></form>';
            }
            else {
                $actions .= '<form action="" method="post"><input type="hidden" name="id" value="' . $id . '"><input type="submit" name="addAdminRole" value="A"' . ( $name === ADMIN_NAME ? ' disabled' : '' ) . '></form>';
            }
        }

        $userList .= <<<EOF
            <tr>
                <td>$name</td>
                <td>$pass</td>
                <td>$admin</td>
                <td>$actions</td>
            </tr>
EOF;
    }

    return <<<EOF
    <table>
        <thead>
            <tr>
                <th>Felhasználónév</th>
                <th>Jelszó</th>
                <th>Admin</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            $userList
        </tbody>
    </table>
EOF;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolgozat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
        table {
            margin-bottom: 20px;
        }
        table form {
            display: inline;
            margin: 0;
        }
    </style>
</head>
<body>
<?php if ( $_SESSION["login"] ): ?>
    <h1>Helló <?= htmlspecialchars( $_SESSION["login"]["name"] ) ?>!</h1>
    <form action="" method="post">
        <input type="submit" name="logout" value="Kijelentkezés">
    </form>
<?php else: ?>
    <form action="" method="post">
        <label for="name">Felhasználó neve: </label>
        <input type="text" name="name" id="name">
        <label for="pass">Jelszó: </label>
        <input type="password" name="pass" id="pass">
        <input type="submit" name="login" value="Küld">
    </form>
<?php endif; ?>
<?= generateUserList() ?>
<?php if ( isAdmin() ): ?>
    <form action="" method="post">
        <label for="name">Felhasználó neve: </label>
        <input type="text" name="name" id="name">
        <label for="pass">Jelszó: </label>
        <input type="password" name="pass" id="pass">
        <input type="submit" name="addUser" value="Új felhasználó">
    </form>
<?php endif; ?>
</body>
</html>
