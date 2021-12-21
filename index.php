<?php
require 'config/config.php';
require 'config/common.php';
require 'templates/header.php';

# Tagasiside ja veateated
$note_error = ''; // Kuvatav veateade

# Andmebaasiühendus aktiivse küsimuse leidmiseks (staatus = 1)
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT * FROM questions  WHERE status = 1';
    $statement = $connection->prepare($sql);
    $statement->execute();
    $question = $statement->fetch(PDO::FETCH_ASSOC);
    //show($question); # Testiks
    $id = $question['id_q']; // Aktiivse küsimuse id
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
}

# Andmebaasiühendus aktiivsele küsimusele vastanute arvu leidmiseks
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT COUNT(*) as total FROM answers WHERE id_q =' . $id;
    $statement = $connection->prepare($sql);
    $statement->execute();
    $answers = $statement->fetch(PDO::FETCH_ASSOC);
    $total = $answers['total'];
    //show($answers); # Testiks
} catch (PDOException $error) {
    if (empty($total)) {
        $note_error = 'Hetkel ei ole ühtegi aktiivset küsimust';
    } else {
        $note_error = 'Viga andmebaasist lugemisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
    }
}


if ($note_error != '') { // Kui on olemas veateade, siis see kuvatakse 
?>
    <div class="columns is-centered">
        <div class="column is-one-third mt-2">
            <div class="column box has-background-warning-light">
                <h3 class="has-text-centered has-text-danger "><?php echo $note_error ?></h3>
            </div>
        </div>
    </div>
<?php

} else { // Ühtegi veateadet ei ole, kuvatakse küsimus ja vastusevariandid (radiobutton - valides suunatakse kohe tulemuste lehele (poll_result))
?>

    <div class="columns is-centered">
        <div class="column is-one-third mt-2">
            <div class="card has-background-light">
                <div class="content">

                    <div class="column box has-background-primary-light">
                        <h1 class="is-italic ml-2"><?php echo ($question['question']); ?></h1>
                    </div>

                    <div class="control m-2">
                        <input type="radio" id="answer_1" name="answer_1" value="1" onclick="location.href='poll_result.php?id=<?php echo $question['id_q']; ?>&answer=1'">
                        <label class="radio has-text-weight-bold" for="answer_1"> <?php echo ($question['answer_1']); ?> </label><br>
                        <input type="radio" id="answer_2" name="answer_2" value="2" onclick="location.href='poll_result.php?id=<?php echo $question['id_q']; ?>&answer=2'">
                        <label class="radio has-text-weight-bold" for="answer_2"> <?php echo ($question['answer_2']); ?> </label><br>
                        <!-- Juhul kui on kolme vastusevariandiga küsimus -->
                        <?php if (strlen(trim($question['answer_3'])) != 0) {
                        ?>
                            <input type="radio" id="answer_3" name="answer_3" value="3" onclick="location.href='poll_result.php?id=<?php echo $question['id_q']; ?>&answer=3'">
                            <label class="radio has-text-weight-bold" for="answer_3"> <?php echo ($question['answer_3']); ?> </label>
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
    <div class="column is-one-third ml-2">
        <a href="admin.php" class="has-text-centered">Sisene haldusmoodulisse</a>
    </div>
</div>
<?php require 'templates/footer.php'; ?>