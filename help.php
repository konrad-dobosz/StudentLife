<?php
session_start();

if ((!isset($_SESSION['logged'])) && ($_SESSION['logged'] != true)) {
    header('Location: login.php');
    exit();
}

require_once "db.php";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentLife</title>

    <link rel="stylesheet" href="css/help.css">
    <script type="text/javascript" src="js/index.js" defer></script>
</head>

<body>
    <?php include_once "components/navbar/indexnavbar.php"; ?>
    <main>
        <div class="container">
            <h1>Raport Błędu</h1>
            <form method="post">
                <label for="name">Imie:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="error-type">Typ Błędu</label>
                <select id="error-type" name="type">
                    <option value="Page Not Found">Strony nie znaleziono</option>
                    <option value="Broken Link">Zepsuty Link</option>
                    <option value="Visual Bug">Błąd Wizualny</option>
                    <option value="Content Error">Błąd Zawartości</option>
                    <option value="Other">Inny Błąd</option>
                </select>

                <label for="error-description">Opisz swój błąd:</label>
                <textarea id="error-description" name="description"></textarea>
                <input type="submit" name="submit" value="Zgłoś Błąd">
            </form>

            <?php
            $error_msg = '';
            $result_msg = '';

            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $email = $_POST['email'];
                $type = $_POST['type'];

                if (empty($name) || empty($email) || empty($type) || empty($description)) {
                    $error_msg = 'Pola nie mogą być puste!';
                } else {
                    $connection->query("INSERT INTO help (name, description, email, type) VALUES ('$name', '$description', '$email', '$type')");
                    $result_msg = 'Raport został wysłany.';
                }
            }
            ?>

            <?php if ($result_msg != '') : ?>
                <p style="color: white;">
                    <?php echo $result_msg; ?>
                </p>
            <?php endif; ?>
            <?php if ($error_msg != '') : ?>
                <p style="color: red;">
                    <?php echo $error_msg; ?>
                </p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>