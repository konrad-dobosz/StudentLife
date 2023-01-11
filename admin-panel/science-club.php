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
    <title>Koła naukowe | StudentLife</title>

    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <main>
        <section>
            <a href="index.php">
                <- Powrót</a>

                    <form method="post">
                        <?php
                        $error_msg = '';
                        $confirm_delete = false;

                        if (isset($_POST['submit-remove'])) {
                            $confirm_delete = true;
                        }

                        switch ($_GET['mode']) {
                            case 'create':
                        ?>
                                <label>Nazwa <input type="text" name="name" required></label>
                                <label>Strona internetowa <input type="text" name="web" required></label>
                                <label>Wydział <input type="text" name="faculty" required></label>
                                <label>Spotkania <input type="text" name="meetings" required></label>
                                <label>Kontakt <input type="text" name="contact" required></label>

                                <label>
                                    Opis
                                    <textarea name="description" id="" cols="30" rows="10" required></textarea>
                                </label>

                                <button type="submit" name="submit">Zapisz</button>

                                <?php
                                break;
                            case 'edit':
                                if ($_GET['id'] == '') {
                                    echo '<h2>Nie podano id</h2>';
                                } else {
                                    if ($result = $connection->query(sprintf("SELECT * FROM science_clubs WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                ?>
                                            <label>Nazwa <input type="text" value="<?php echo $row['name']; ?>" name="name" required></label>
                                            <label>Strona internetowa <input type="text" value="<?php echo $row['web']; ?>" name="web" required></label>
                                            <label>Wydział <input type="text" value="<?php echo $row['faculty']; ?>" name="faculty" required></label>
                                            <label>Spotkania <input type="text" value="<?php echo $row['meetings']; ?>" name="meetings" required></label>
                                            <label>Kontakt <input type="text" value="<?php echo $row['contact']; ?>" name="contact" required></label>

                                            <label>
                                                Opis
                                                <textarea name="description" id="" cols="30" rows="10" required><?php echo $row['description']; ?></textarea>
                                            </label>


                                            <button type="submit" name="submit">Zapisz</button>

                                            <?php if (!$confirm_delete) : ?>
                                                <button type="submit" id="event-remove" name="submit-remove">Usuń koło naukowe</button>
                                            <?php else : ?>
                                                <button type="submit" id="event-remove" name="submit-remove-confirm">Potwierdź usunięcie koła naukowego</button>
                                            <?php endif; ?>
                            <?php

                                        } else {
                                            echo '<h2>Brak koła naukowego o podanym id</h2>';
                                        }
                                    }
                                }
                                break;
                            default:
                                header('Location: index.php');
                                break;
                        }

                        if (isset($_POST['submit'])) {
                            $id = $_GET['id'];
                            $name = $_POST['name'];
                            $web = $_POST['web'];
                            $description = $_POST['description'];
                            $faculty = $_POST['faculty'];
                            $meetings = $_POST['meetings'];
                            $contact = $_POST['contact'];

                            if (empty($name) || empty($web) || empty($description) || empty($faculty) || empty($meetings) || empty($contact)) {
                                $error_msg = 'Należy wypełnić każde pole!';
                            } else {
                                if ($_GET['mode'] == 'edit') {
                                    if (empty($id)) {
                                        $error_msg = 'Nie podano id';
                                    } else {
                                        $connection->query("UPDATE science_clubs SET name = '$name', web = '$web', description = '$description', faculty = '$faculty', meetings = '$meetings', contact = '$contact' WHERE id = '$id'");
                                        header('Location: index.php');
                                    }
                                } else if ($_GET['mode'] == 'create') {
                                    $connection->query("INSERT INTO science_clubs (name, web, description, faculty, meetings, contact) VALUES ('$name', '$web', '$description', '$faculty', '$meetings', '$contact')");
                                }
                            }
                        }

                        if (isset($_POST['submit-remove-confirm'])) {
                            $id = $_GET['id'];
                            $connection->query("DELETE FROM science_clubs WHERE id='$id'");
                            header('Location: index.php');
                        }

                        if ($error_msg != '') : ?>
                            <p style="color: red;">
                                <?php echo $error_msg; ?>
                            </p>
                        <?php endif; ?>
                    </form>
        </section>
    </main>
</body>

</html>