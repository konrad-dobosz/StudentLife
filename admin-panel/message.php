<?php
session_start();

require_once "../db.php";

if ((!isset($_SESSION['logged'])) && ($_SESSION['logged'] != true)) {
    header('Location: login.php');
    exit();
} else {
    $id = $_SESSION['id'];
    if ($result = $connection->query("SELECT id, isAdmin FROM users WHERE id='$id' AND isAdmin=1")) {
        if ($result->num_rows == 0) {
            header('Location: index.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiadomość | StudentLife</title>

    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <main>
        <section>
            <a href="index.php">
                <- Powrót</a>

                    <form method="post">
                        <?php
                        $confirm_delete = false;

                        if (isset($_POST['submit-remove'])) {
                            $confirm_delete = true;
                        }

                        if ($_GET['id'] == '') {
                            echo '<h2>Nie podano id</h2>';
                        } else {
                            if ($result = $connection->query(sprintf("SELECT * FROM help WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                        ?>
                                    <label>Imię <input type="text" value="<?php echo $row['name']; ?>" name="name" readonly></label>
                                    <label>Email <input type="text" value="<?php echo $row['email']; ?>" name="email" readonly></label>
                                    <label>Typ błędu <input type="text" value="<?php echo $row['type']; ?>" name="type" readonly></label>

                                    <label>
                                        Opis
                                        <textarea name="description" id="" cols="30" rows="10" readonly><?php echo $row['description']; ?></textarea>
                                    </label>


                                    <?php if (!$confirm_delete) : ?>
                                        <button type="submit" id="event-remove" name="submit-remove">Usuń wiadomość</button>
                                    <?php else : ?>
                                        <button type="submit" id="event-remove" name="submit-remove-confirm">Potwierdź usunięcie wiadomości</button>
                                    <?php endif; ?>
                        <?php

                                } else {
                                    echo '<h2>Brak wiadomości o podanym id</h2>';
                                }
                            }
                        }

                        if (isset($_POST['submit-remove-confirm'])) {
                            $id = $_GET['id'];
                            $connection->query("DELETE FROM help WHERE id='$id'");
                            header('Location: index.php');
                        }

                        ?>
                    </form>
        </section>
    </main>
</body>

</html>