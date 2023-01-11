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
            header('Location: ../index.php');
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
    <title>Admin panel | StudentLife</title>

    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <nav>
        <div>
            <img src="../img/logo.png" alt="Logo">
            <h4><a href="index.php">Admin | Student Life</a></h4>
        </div>
        <a id="btn-back" href="../">Strona główna</a>
    </nav>
    <main>
        <section>
            <form>
                <h4>Lista wydarzeń</h4>
                <a href="event.php?mode=create" class="event-row">+ Dodaj nowe wydarzenie</a>
                <?php
                if ($result = $connection->query(sprintf("SELECT * FROM events LIMIT 10"))) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="event.php?mode=edit&id=' . $row['id'] . '" class="event-row">' . $row['name'] . '</a>';
                        }
                    } else {
                        echo '<p>Brak wydarzeń</p>';
                    }
                }
                ?>
            </form>
        </section>
        <section>
            <form>
                <h4>Lista kół naukowych</h4>
                <a href="science-club.php?mode=create" class="event-row">+ Dodaj nowe koło naukowe</a>
                <?php
                if ($result = $connection->query(sprintf("SELECT * FROM science_clubs LIMIT 10"))) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="science-club.php?mode=edit&id=' . $row['id'] . '" class="event-row">' . $row['name'] . '</a>';
                        }
                    } else {
                        echo '<p>Brak kół naukowych</p>';
                    }
                }
                ?>
            </form>
        </section>
        <section>
            <form>
                <h4>Wiadomości kontaktowe</h4>
                <?php
                if ($result = $connection->query(sprintf("SELECT * FROM help LIMIT 10"))) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="message.php?id=' . $row['id'] . '" class="event-row">' . $row['type'] . ' - ' . $row['email'] . '</a>';
                        }
                    } else {
                        echo '<p>Brak wiadomości</p>';
                    }
                }
                ?>
            </form>
        </section>
    </main>
</body>

</html>