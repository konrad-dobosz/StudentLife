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
    <title>StudentLife - rejestracja</title>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <main>
        <form action="register.php" method="post">
            <!-- <img src="img/logo.svg" alt="Logo"> -->
            <h2>Stwórz nowe konto!</h2>
            <input type="text" name="login" placeholder="Login" id="login" required>
            <input type="email" name="email" placeholder="E-mail" id="email" required>
            <input type="password" name="pass" placeholder="Hasło" id="pass" required>
            <input type="password" name="pass_verify" placeholder="Powtórz hasło" id="pass_verify" required>

            <button type="submit" name="submit">Załóż konto</button>
            <a href="login.php">Masz już konto? Zaloguj się!</a>
            <?php
            if (isset($_SESSION['error']))
                echo $_SESSION['error'];
            ?>
        </form>
    </main>

    <?php
    if (isset($_POST['submit'])) {
        require_once "db.php";

        $login = mysqli_real_escape_string($connection, $_POST['login']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $pass = mysqli_real_escape_string($connection, $_POST['pass']);
        $password_verify = mysqli_real_escape_string($connection, $_POST['pass_verify']);

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
        unset($_SESSION['error']);

        if (empty($login)) $_SESSION['error'] = 'Login jest wymagany';
        if (empty($email)) $_SESSION['error'] = 'Email jest wymagany';
        if (empty($pass)) $_SESSION['error'] = 'Musisz wpisać hasło';
        if ($pass != $password_verify) $_SESSION['error'] = 'Hasła nie są takie same';

        $exists = $connection->query(sprintf("SELECT * FROM users WHERE login='%s' OR email='%s'", $login, $email));

        if ($exists->num_rows > 0) {
            $_SESSION['error'] = 'Konto już istnieje!';
        } else {
            if (!isset($_SESSION['error'])) {
                $pass = password_hash($pass, PASSWORD_BCRYPT);
                $query = $connection->query(
                    sprintf(
                        "INSERT INTO users VALUES (NULL, '%s', '%s', '%s')",
                        $login,
                        $email,
                        $pass
                    )
                );

                $row = $exists->fetch_assoc();

                $_SESSION['logged'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['login'];

                $exists->free_result();
                header('Location: index.php');
            } else {
                unset($_SESSION['error']);
            }
        }

        $connection->close();
    }
    ?>

</body>

</html>