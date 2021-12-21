<?php
require 'config/config.php';
require 'config/common.php';
require 'templates/header.php';

# Tagasiside
$note_error = ''; // Kuvatav veateade
$note_success = ''; // Kuvatav teade - andmebaasi kirjutamine õnnestus

if (isset($_GET['id']) && $_GET['id'] != '') { // Kas URL-il on küsimuse id olemas
    # Andmebaasiühendus, küsimuse kustutamine
    try {
        $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
        $id = $_GET['id']; // URL realt id
        $sql = 'DELETE FROM questions WHERE id_q = :id';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $note_success = 'Küsimus nr: ' . $id . ' edukalt kustutatud!';
    } catch (PDOException $error) {
        $note_error = 'Viga andmebaasi kirjutamisel: <br />' . ($error->getMessage());
    }
} else { // URL-i küsimuse id puudu
    $note_error = 'URL-is küsimuse id puudu';
}
?>
<div class="columns is-centered">
    <div class="column box is-half m-2">
        <!-- Tagasiside, kas kustutamine õnnestus või veateade -->
        <?php if ($note_error != '') { ?>
            <h3 class="has-text-centered  has-text-danger"><?php echo $note_error; ?></h3>
        <?php } else { ?>
            <h3 class="has-text-centered  has-text-success"><?php echo $note_success; ?></h3>
        <?php } ?>
        <div class="has-text-centered">
            <button class="button is-link is-success mt-2" onclick="location.href='questions_view.php'">Tagasi</button>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>