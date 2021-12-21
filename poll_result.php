<?php
require 'config/config.php';
require 'config/common.php';
require 'templates/header.php';

# Tagasiside ja veateated
$note_error = ''; // Kuvatav veateade
$note_success = ''; // Kuvatav teade - andmebaasi kirjutamine õnnestus

$ip_error = false; // Abimuutuja IP kontrolliks

// Vastaja IP-aadress muutujasse $ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
// echo $ip; # Testiks

if (isset($_GET['id']) && $_GET['id'] != '') { // URL-is on küsimuse id ja see ei ole tühi
    $id = $_GET['id'];

    # Andmebaasiühendus, kas sellise id-ga küsimus on andmebaasis olemas
    try {
        $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
        $connection->exec('SET NAMES utf8');
        $sql = 'SELECT COUNT(*) AS total FROM questions WHERE id_q =' . $id;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $total = $statement->fetch(PDO::FETCH_ASSOC);
        $total = $total['total'];
        // show($total); # Testiks
    } catch (PDOException $error) {
        $note_error = 'Viga andmebaasist lugemisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
    }

    if ($total == 1) { // URL-is oleva id-ga küsimus on andmebaasis

        if (isset($_GET['answer']) && $_GET['answer'] != '') { // URL-is on vastuse nr ja see ei ole tühi, seega siseneb vastaja
            $answer = $_GET['answer'];
            // show($id);
            // show($answer);

                    # Andmebaasiühendus, IP aadressi kontrolliks
  /*       try {
            $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
            $connection->exec('SET NAMES utf8');
            $sql = 'SELECT IP FROM answers WHERE id_q =' . $id;
            $statement = $connection->prepare($sql);
            $statement->execute();
            $answers = $statement->fetchAll();
            // show($answers);
        } catch (PDOException $error) {
            $note_error = 'Viga andmebaasist lugemisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
        }

        for ($i = 0; $i < count($answers); $i++) { // Kontroll, kas vastaja IP aadress on juba selle küsimuse vastuste juures olemas
            if ($answers[$i]['IP'] == $ip) {
                $ip_error = true;
            }
        }
        if ($ip_error == true) { // Vastaja IP aadress leiti tabelist selle küsimuse juurest
            $note_error = 'Sellelt IP aadressilt on juba vastatud. Vastata saab vaid üks kord!';
        } else  */ {
                # Andmebaasiühendus. Kas sellel küsimusel on kolmas vastusevariant olemas
                try {
                    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
                    $connection->exec('SET NAMES utf8');
                    $sql = 'SELECT answer_3 FROM questions WHERE id_q =' . $id;
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $answer_3_Ok = $statement->fetch(PDO::FETCH_ASSOC);
                    $answer_3_Ok = $answer_3_Ok['answer_3'];
                    // show($answer_3_Ok); # Testiks
                } catch (PDOException $error) {
                    $note_error = 'Viga andmebaasist lugemisel: <br /> ' . ($error->getMessage());
                }

                if ($answer == 3 && $answer_3_Ok == '') { // URL-is vastuse id = 3 kuid küsimusel vaid 2 vastusevarianti
                    $note_error = 'Selline vastusevariant nagu URL-is märgitud ei ole võimalik!';
                } else {

                    if ($answer == 1 || $answer == 2 || $answer == 3) { // Küsimuse nr URL-is vastab reeglitele
                        # Andmebaasiühendus, valitud vastuse kirjutamine tabelisse
                        try {
                            $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
                            $connection->exec('SET NAMES utf8'); // SQL lause, et täpitähed oleks korrektselt
                            $sql = 'INSERT INTO answers (id_q, answer, IP) VALUES (' . $id . ', ' . $answer . ', "' . $ip . '")';
                            // show($sql); # Testiks
                            $statement = $connection->prepare($sql);
                            $statement->execute();
                            $note_success = 'Vastus edukalt salvestatud!';
                        } catch (PDOException $error) {
                            $note_error = 'Viga andmebaasi kirjutamisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
                        }
                    } else { // URL-is vastuse id ei vasta reeglitele
                        $note_error = 'URL-is vastuse id vale';
                    }
                }
            }
        }

        # Andmebaasiühendus küsimuse ja selle vastuste leidmiseks
        try {
            $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
            $connection->exec('SET NAMES utf8');
            $sql = 'SELECT q.id_q, q.question, q.answer_1, q.answer_2, q.answer_3, a.answer FROM questions AS q LEFT JOIN answers AS a USING (id_q) WHERE q.id_q =' . $id;
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            // show($result); # Testiks
        } catch (PDOException $error) {
            $note_error = 'Viga andmebaasist lugemisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
        }
    } else {
        $note_error = 'URL-is oleva id-ga kuulutust ei ole andmebaasis';
    }
} else {
    $note_error = 'URL-is küsimuse id puudu';
}

# Kuvatakse teade, kas vastuse salvestamine õnnestus või veateade
if ($note_error != '' || $note_success != '') {
?>

    <div class="columns is-centered">
        <div class="column is-one-third mt-2">
            <div class="column box has-background-warning-light">
                <?php if ($note_error != '') { ?>
                    <h3 class="has-text-centered has-text-danger "><?php echo $note_error ?></h3>
                <?php } else { ?>
                    <h3 class="has-text-centered has-text-success "><?php echo $note_success ?></h3>
                <?php }
                ?>
            </div>
        </div>
    </div>

<?php
}
if ($note_error == '') { // Kui ühtegi veateadet ei ole, siis loeb kokku vastanute koguarvu ja kõikide vastusevariantide arvud ning kuvatakse tulemused
    $total = 0;
    $answer_1 = 0;
    $answer_2 = 0;
    $answer_3 = 0;

    for ($i = 0; $i < count($result); $i++) {
        if ($result[$i]['answer'] == 1) {
            $answer_1++;
            $total++;
        }
        if ($result[$i]['answer'] == 2) {
            $answer_2++;
            $total++;
        }
        if ($result[$i]['answer'] == 3) {
            $answer_3++;
            $total++;
        }
    }
    # Arvutame kui suur on iga vastusevariandi osakaal vastuste koguhulgast (%). Kui vastanuid pole (0-ga jagamine) siis tulemuseks 0-d
    $rel_answer_1 = ($total != 0) ? round($answer_1 / $total * 100) : 0;
    $rel_answer_2 = ($total != 0) ? round($answer_2 / $total * 100) : 0;
    $rel_answer_3 = ($total != 0) ? round($answer_3 / $total * 100) : 0;
?>

    <div class="columns is-centered">
        <div class="column is-one-third mt-2">
            <div class="card has-background-light">
                <div class="content">
                    <div class="column box has-background-primary-light">
                        <h1 class="has-text-centered">Küsimuse:</h1>
                    </div>
                    <h1 class="is-italic ml-2"><?php echo ($result[0]['question']); ?></h1>
                    <div class="control m-2">
                        <p class="has-text-weight-bold">Tulemused:</p>
                        <label class="has-text-weight-bold"> <?php echo ($result[0]['answer_1']); ?> <?php echo ($rel_answer_1); ?> % (<?php echo $answer_1;
                                                                                                                                        echo ($answer_1 == 1) ? ' vastaja' : ' vastajat' ?>) </label><br>
                        <progress class="progress is-info" value="<?php echo ($answer_1 / $total * 100); ?>" max="100"></progress>
                        <label class="radio has-text-weight-bold"> <?php echo ($result[0]['answer_2']); ?> <?php echo ($rel_answer_2); ?> % (<?php echo $answer_2;
                                                                                                                                                echo ($answer_2 == 1) ? ' vastaja' : ' vastajat' ?>) </label><br>
                        <progress class="progress is-warning" value="<?php echo ($answer_2 / $total * 100); ?>" max="100"></progress>
                        <?php if (strlen(trim($result[0]['answer_3'])) > 0) {
                        ?>
                            <label class="has-text-weight-bold"> <?php echo ($result[0]['answer_3']); ?> <?php echo ($rel_answer_3); ?> % (<?php echo $answer_3;
                                                                                                                                            echo ($answer_3 == 1) ? ' vastaja' : ' vastajat' ?>) </label><br>
                            <progress class="progress is-danger" value="<?php echo ($answer_3 / $total * 100); ?>" max="100"></progress>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="column box has-background-primary-light">
                        <p class="is-italic"> Küsitluses on osalenud <?php echo $total ?> inimest.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>

<div class="columns is-centered">
    <div class="column is-one-third mt-2">
        <button class="button is-link is-success mt-2 is-fullwidth" onclick="location.href='index.php'">Avalehele</button>
        <?php
        if (!isset($_GET['answer'])) {
        ?>
            <button class="button is-link is-info mt-2 is-fullwidth" onclick="location.href='questions_view.php'">Küsimuste loetellu</button>
        <?php
        }
        ?>
    </div>
</div>

<?php require 'templates/footer.php'; ?>