<?php
require 'config/config.php';
require 'config/common.php';
require 'pagination.php';
require 'templates/header.php';

# Tagasiside ja veateated
$note_error = ''; // Kuvatav veateade
$note_success = ''; // Kuvatav teade - andmebaasi kirjutamine õnnestus

if (!isset($_GET['id'])) { // URL-is ühegi küsimuse id-d ei ole
} else {  // URL-is on olemas id, seega kasutaja tahab küsimuse staatust muuta
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
        $note_error = 'Viga andmebaasist lugemisel!' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
    }

    if ($total == 1) { // URL-is oleva id-ga küsimus on andmebaasis
        if (isset($_GET['status']) && $_GET['status'] != '') { // URL-is on staatus ja selle väärtus olemas

            if ($_GET['status'] == 0) { // Kasutaja tahab "aktiivse" staatuse muuta "ootel"
                # Andmebaasiühendus, staatuse muutmine tabelis
                try {
                    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
                    $connection->exec('SET NAMES utf8');
                    $sql = 'UPDATE questions SET status = 0 WHERE id_q =' . $id;
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $note_success = 'Küsimuse ' . $id . ' staatus muudetud "ootel"!';
                } catch (PDOException $error) {
                    $note_error = 'Viga andmebaasi kirjutamisel!' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
                }
            } else if ($_GET['status'] == 1) { // Kasutaja tahab "ootel" staatuse muuta "aktiivne"
                # Andmebaasiühendus, staatuse muutmine tabelis
                try {
                    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
                    $connection->exec('SET NAMES utf8');
                    $sql = 'UPDATE questions SET status = 0 WHERE status = 1; UPDATE questions SET status = 1 WHERE id_q =' . $id;
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $note_success = 'Küsimuse ' . $id . ' staatus muudetud "aktiivne"!';
                } catch (PDOException $error) {
                    $note_error = 'Viga andmebaasi kirjutamisel!' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
                }
            } else { // URL-il staatuse väärtus midagi muud kui 0 või 1
                $note_error = 'URL-is staatus vigane!';
            }
        } else {
            $note_error = 'URL-is puudub staatus!';
        }
    } else { // URL-il oleva id-ga kuulutust ei ole andmebaasis
        $note_error = 'URL-is oleva id-ga kuulutust ei ole andmebaasis!';
    }
}

# Andmebaasiühendus, loetakse tabelist kõik küsimused
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT * FROM questions ORDER BY id_q DESC LIMIT ' . $start . ', ' . MAXPERPAGE; // Järjestab viimasena lisatud algusesse
    $statement = $connection->prepare($sql);
    $statement->execute();
    $questions = $statement->fetchAll();
    //show($questions); # Testiks
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel!' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
}
?>

<h1 class="title is-4 has-text-centered">Küsimuste loetelu</h1>

<?php require 'templates/pagination.php'; ?>

<!-- Tagasiside või veateade, kuvatakse kui on midagi -->
<?php
if ($note_error != '' || $note_success != '') {
?>
    <div class="columns is-centered">
        <div class="column box m-2">
            <h1 class="has-text-weight-bold has-text-centered has-text-primary"><?php echo $note_success ?></h1>
            <h1 class="has-text-weight-bold has-text-centered has-text-danger"><?php echo $note_error ?></h1>
        </div>
    </div>
<?php
}
?>
<!-- Tabel -->
<div class="columns is-centered">
    <div class="column box m-2">
        <div class="table-container">
            <table class="table is-bordered is-narrow is-hoverable is-fullwidth">
                <thead class="has-text-centered has-background-light">
                    <tr>
                        <th>Jrk nr</th>
                        <th>Küsimuse ID</th>
                        <th>Küsimus</th>
                        <th>Vastus 1</th>
                        <th>Vastus 2</th>
                        <th>Vastus 3</th>
                        <th>Loodud</th>
                        <th>Staatus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $jrk = $start + 1; ?>
                    <?php foreach ($questions as $row) : ?>
                        <tr>
                            <td> <?php echo $jrk ?> </td>
                            <td> <?php echo $row['id_q']; ?> </td>
                            <td> <?php echo escape($row['question']); ?> </td>
                            <td> <?php echo escape($row['answer_1']); ?> </td>
                            <td> <?php echo escape($row['answer_2']); ?> </td>
                            <td> <?php echo escape($row['answer_3']); ?> </td>
                            <td> <?php echo escape($row['created']); ?> </td>
                            <!-- Vastavalt küsimuse staatusele kuvatakse tabelis erinev teade "radiobutton" olemasoleva staatuse muutmiseks -->
                            <?php if ($row['status'] == 0) { ?>
                                <td>

                                    <label for="status_0"> Ootel / aktiveeri </label>
                                    <input id="status_0" type="radio" name="status" onclick="location.href='questions_view.php?id=<?php echo $row['id_q']; ?>&status=1'"><br>

                                    <a href="poll_result.php?id=<?php echo $row['id_q']; ?>" class="button is-small is-warning mt-2"> Tulemused </a>
                                    <a href="question_delete.php?id=<?php echo $row['id_q']; ?>" onclick="return confirm('Kas soovid küsimust: <?php echo $row['question']; ?>  kustutada?')" class="button is-small is-danger mt-2"> Kustuta </a>
                                </td>
                            <?php } elseif ($row['status'] == 1) { ?>
                                <td>

                                    <label for="status_1"> Aktiivne / pane ootele </label>
                                    <input id="status_1" type="radio" name="status" checked onclick="location.href='questions_view.php?id=<?php echo $row['id_q']; ?>&status=0'"><br>

                                    <a href="poll_result.php?id=<?php echo $row['id_q']; ?>" class="button is-small is-warning mt-2"> Tulemused </a>
                                    <a href="question_delete.php?id=<?php echo $row['id_q']; ?>" onclick="return confirm('Kas soovid küsimust: <?php echo $row['question']; ?>  kustutada?')" class="button is-small is-danger mt-2"> Kustuta </a>
                                </td>
                            <?php } else { ?>
                                <td>

                                    <label for="status_3" class="has-text-danger has-text-weight-semibold"> Staatus vigane / pane ootele </label>
                                    <input id="status_3" type="radio" name="status" onclick="location.href='questions_view.php?id=<?php echo $row['id_q']; ?>&status=0'"><br>

                                    <a href="poll_result.php?id=<?php echo $row['id_q']; ?>" class="button is-small is-warning mt-2"> Tulemused </a>
                                    <a href="question_delete.php?id=<?php echo $row['id_q']; ?>" onclick="return confirm('Kas soovid küsimust: <?php echo $row['question']; ?> kustutada?')" class="button is-small is-danger mt-2"> Kustuta </a>
                                </td>
                            <?php
                            } ?>
                        </tr>
                    <?php
                        $jrk++;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <button class="button is-link is-warning mt-2" onclick="location.href='question_create_new.php'">Lisa uus küsimus</button>
            <button class="button is-link is-info mt-2 ml-2" onclick="location.href='admin.php'">Admin menüüsse</button>
            <button class="button is-link is-success mt-2 ml-2" onclick="location.href='index.php'">Avalehele / aktiivne küsimus</button>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>