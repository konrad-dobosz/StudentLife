<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudentLife - panel logowania</title>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <main>
        <form action="login.php" method="post">
            <!-- <img src="img/logo.svg" alt="Logo"> -->
            <h2>Zaloguj się!</h2>
            <input type="text" name="login" placeholder="Login" id="login">
            <input type="password" name="pass" placeholder="Hasło" id="pass">

            <button type="submit" name="submit">Zaloguj się</button>
            <?php
            if (isset($_SESSION['error']))
                echo $_SESSION['error'];
            ?>
        </form>
    </main>

    <?php
    if (isset($_POST['submit'])) {
        require_once "db.php";

        $login = $_POST['login'];
        $pass = $_POST['pass'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $pass = htmlentities($pass, ENT_QUOTES, "UTF-8");

        if ($result = $connection->query(sprintf("SELECT * FROM users WHERE login='%s'", mysqli_real_escape_string($connection, $login)))) {
            $users = $result->num_rows;
            $row = $result->fetch_assoc();

            if ($users > 0) {
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['login'] = $row['login'];

                    unset($_SESSION['error']);
                    $result->free_result();
                    header('Location: index.php');
                } else {
                    $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                }
            }
        }

        $connection->close();
    }
    ?>

</body>

</html>