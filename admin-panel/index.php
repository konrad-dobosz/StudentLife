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
    <title>Admin panel | StudentLife</title>

    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
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
    </main>
</body>

</html>