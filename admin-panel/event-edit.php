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

                    <form action="">
                        <?php
                        if ($result = $connection->query(sprintf("SELECT * FROM events WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $date = new DateTime($row['date_start']);
                        ?>
                                <label>Nazwa wydarzenia <input type="text" value="<?php echo $row['name']; ?>"></label>
                                <label>Adres <input type="text" value="<?php echo $row['address']; ?>"></label>
                                <label>Data <input type="datetime-local" name="" id="" value="<?php echo $date->format('Y-m-d\TH:i'); ?>"></label>

                                <label>
                                    Opis
                                    <textarea name="" id="" cols="30" rows="10"><?php echo $row['description']; ?></textarea>
                                </label>
                                <button type="submit">Zapisz</button>


                    </form>

            <?php    } else {
                                echo '<h2>Brak wydarzenia o podanym id</h2>';
                            }
                        }
            ?>
        </section>
    </main>
</body>

</html>