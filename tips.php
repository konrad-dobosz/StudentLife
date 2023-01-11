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

    <link rel="stylesheet" href="css/tips.css">
    <script type="text/javascript" src="js/index.js" defer></script>
</head>

<body>
    <?php include_once "components/navbar/indexnavbar.php"; ?>
    <main>
        <header>
            <h1>Przydatne wskazówki dla studentów</h1>
        </header>
        <section class="tips">
            <article>
                <h2>Porada 1: Zachowaj porządek</h2>
                <p>
                    Jednym z kluczy do sukcesu na politechnice jest organizacja. Obejmuje to śledzenie terminów i harmonogramów oraz materiałów od prowadzących. W organizacji pomagają takie rzeczy jak kalendarze, listy rzeczy do zrobienia i aplikacje do notatek, które pomogą Ci utrzymać porządek i wywiązać się z obowiązków.
                </p>
                <article>
                    <h2>Porada 2: Dbaj o siebie</h2>
                    <p>
                        Studia mogą być wymagającym i stresującym okresem, dlatego ważne jest, aby dbać o siebie. Upewnij się, że śpisz wystarczająco dużo, dobrze się odżywiasz, regularnie ćwiczysz i robisz przerwy w nauce. Powinieneś również rozważyć szukanie wsparcia, jeśli czujesz się przytłoczony lub zmagasz się z problemami ze zdrowiem psychicznym.
                    </p>
                </article>
                <article>
                    <h2>Porada 3: Zaangażuj się</h2>
                    <p>
                        Studia to świetna okazja do poznania nowych ludzi i zaangażowania się w nowe działania. Rozważ dołączenie do klubów, organizacji lub drużyn sportowych. Możesz także zostać wolontariuszem lub zaangażować się w prace społeczne. Te doświadczenia mogą pomóc Ci zdobyć nowe umiejętności, nawiązać kontakty i dobrze się bawić!
                    </p>
                </article>
                <article>
                    <h2>Porada 4: Zarządzaj swoimi finansami</h2>
                    <p>
                        Studia mogą być drogie, dlatego ważne jest, aby ostrożnie zarządzać swoimi finansami. Zrób listę swoich wydatków i trzymaj się jej. Szukaj sposobów na zaoszczędzenie pieniędzy, na przykład kupowanie używanych podręczników lub gotowanie w domu zamiast jedzenia poza domem. Powinieneś również być świadomy wszelkich możliwości pomocy finansowej lub stypendiów, które mogą być dla Ciebie dostępne.
                    </p>
                </article>
                <article>
                    <h2>Porada 5: W razie potrzeby szukaj pomocy</h2>
                    <p>
                        Politechnika może być wyzwaniem i możesz poprosić o pomoc, kiedy jej potrzebujesz. Nie bój się kontaktować się z profesorami, wykładowcami lub korepetytorami, jeśli masz problemy z zajęciami. Powinieneś również wiedzieć o wszelkich usługach wsparcia, które mogą być dla Ciebie dostępne, takich jak doradztwo lub akademickie centra wsparcia.
                    </p>
                </article>
        </section>
    </main>

</body>

</html>