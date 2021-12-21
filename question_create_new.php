<?php

# Tagasiside ja veateated
$note_error = ''; // Kuvatav veateade
$note_success = ''; // Kuvatav teade - andmebaasi kirjutamine õnnestus

if (isset($_POST['submit'])) { // Kas Submit nuppu on vajutatud
    require 'config/config.php';
    require 'config/common.php';

    # Vormilt saadud andmete kontroll
    if (strlen(trim($_POST['question'])) <= 3) {
        $note_error = 'Viga! Küsimus on tühi või liiga lühike.';
    } elseif (substr($_POST['question'], -1) != '?') {
        $note_error = 'Viga! Küsimus peab lõppema ? -ga.';
    } elseif (strlen(trim($_POST['answer_1'])) == 0) {
        $note_error = 'Viga! Vastus 1 peab olema täidetud.';
    } elseif (strlen(trim($_POST['answer_2'])) == 0) {
        $note_error = 'Viga! Vastus 2 peab olema täidetud.';
    } else { // Kõik korras - võetakse andmed vormilt
        # Andmebaasiüühendus, tabelisse lisatakse uus küsimus
        try {
            $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
            $connection->exec('SET NAMES utf8'); // SQL lause, et täpitähed oleks korrektselt

            $new_question = array(
                'question' => $_POST['question'],
                'answer_1'  => $_POST['answer_1'],
                'answer_2'  => $_POST['answer_2'],
                'answer_3'  => $_POST['answer_3']
            );

            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                'questions',
                implode(', ', array_keys($new_question)),
                ':' . implode(', :', array_keys($new_question))
            );
            //show($sql); # Testiks
            //show($new_question);
            $statement = $connection->prepare($sql);
            $statement->execute($new_question);
            $note_success = 'Uus küsimus edukalt salvestatud!';
        } catch (PDOException $error) {
            $note_error = 'Viga andmebaasist kirjutamisel: ' . ('<br /> SQL: <strong>' . $sql . '</strong><br />' . $error->getMessage());
        }
    }
}
?>

<?php require 'templates/header.php'; ?>

<div class="columns is-centered">
    <div class="column is-one-third mt-2">
        <h1 class="has-text-centered has-text-weight-bold">Uue küsimuse koostamine</h1><br>
        <form action="" method="POST" class="mb-2">
            <!-- action tühi - leht loetakse peale Submit nupu vajutamist uuesti -->
            <div class="field">
                <label for="question" class="label m-2">Küsimus:*</label>
                <input type="text" name="question" id="question" class="input textarea" rows="2" value="<?php echo (isset($_POST['submit'])) ? $_POST['question'] : null; ?>">

                <label for="answer_1" class="label m-2">Vastus 1:*</label>
                <input type="text" name="answer_1" id="answer_1" class="input" value="<?php echo (isset($_POST['submit'])) ? $_POST['answer_1'] : null; ?>">

                <label for="answer_2" class="label m-2">Vastus 2:*</label>
                <input type="text" name="answer_2" id="answer_2" class="input" value="<?php echo (isset($_POST['submit'])) ? $_POST['answer_2'] : null; ?>">

                <label for="answer_3" class="label m-2">Vastus 3:</label>
                <input type="text" name="answer_3" id="answer_3" class="input" value="<?php echo (isset($_POST['submit'])) ? $_POST['answer_3'] : null; ?>">

                <label class="label m-2">* tähistatud lahtrid on kohustuslikud, küsimus peab lõppema ?-märgiga</label>
            </div>
            <!-- Tagasiside, kas küsimuse sisestamine õnnestus (kiri roheline) või oli mingi viga (kiri punane) -->
            <label name="feedback-success" class="label has-text-primary m-2"> <?php echo $note_success; ?> </label>
            <label name="feedback-feedback$feedback" class="label has-text-danger m-2"> <?php echo $note_error; ?> </label>

            <input type="submit" name="submit" value="Salvesta küsimus" class="button is-link is-fullwidth">
            <button class="button is-link is-warning mt-2 is-fullwidth" onclick="location.href='create_question.php'">Tühjenda</button>

        </form>
        <button class="button is-link is-info is-fullwidth" onclick="location.href='questions_view.php'">Küsimuste loetellu</button>
        <button class="button is-link is-success mt-2 is-fullwidth" onclick="location.href='index.php'">Avalehele</button>
    </div>
</div>

<?php require 'templates/footer.php'; ?>