<?php
session_start();

if ((!isset($_SESSION['logged'])) && ($_SESSION['logged'] != true)) {
    header('Location: login.php');
    exit();
}

require_once "../db.php";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wydarzenia | StudentLife</title>

    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <main>
        <section>
            <a href="index.php">
                <- Powrót</a>

                    <form method="post">
                        <?php
                        switch ($_GET['mode']) {
                            case 'create':
                        ?>
                                <label>Nazwa wydarzenia <input type="text" name="name"></label>
                                <label>Adres <input type="text" name="address"></label>
                                <label>Data rozpoczęcia<input type="datetime-local" name="date_start" id=""></label>
                                <label>Data zakończenia<input type="datetime-local" name="date_end" id=""></label>

                                <label>
                                    Opis
                                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                                </label>
                                <button type="submit" name="submit">Zapisz</button>

                                <?php
                                break;
                            case 'edit':
                                if ($result = $connection->query(sprintf("SELECT * FROM events WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $date_start = new DateTime($row['date_start']);
                                        $date_end = new DateTime($row['date_end']);
                                ?>
                                        <label>Nazwa wydarzenia <input type="text" value="<?php echo $row['name']; ?>" name="name"></label>
                                        <label>Adres <input type="text" value="<?php echo $row['address']; ?>" name="address"></label>
                                        <label>Data rozpoczęcia<input type="datetime-local" name="date_start" id="" value="<?php echo $date_start->format('Y-m-d\TH:i'); ?>"></label>
                                        <label>Data zakończenia<input type="datetime-local" name="date_end" id="" value="<?php echo $date_end->format('Y-m-d\TH:i'); ?>"></label>

                                        <label>
                                            Opis
                                            <textarea name="description" id="" cols="30" rows="10"><?php echo $row['description']; ?></textarea>
                                        </label>
                                        <button type="submit" name="submit">Zapisz</button>

                        <?php

                                    } else {
                                        echo '<h2>Brak wydarzenia o podanym id</h2>';
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
                            $address = $_POST['address'];
                            $description = $_POST['description'];
                            $date_start = $_POST['date_start'];
                            $date_end = $_POST['date_end'];

                            if ($_GET['mode'] == 'edit') {
                                $connection->query("UPDATE events SET name = '$name', address = '$address', description = '$description', date_start = '$date_start', date_end = '$date_end' WHERE id = '$id'");
                            } else if ($_GET['mode'] == 'create') {
                                $connection->query("INSERT INTO events SET name = '$name', address = '$address', description = '$description', date_start = '$date_start', date_end = '$date_end'");
                            }
                        }
                        ?>
                    </form>
        </section>
    </main>
</body>

</html>