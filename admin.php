<?php require 'templates/header.php'; ?>

<div class="columns is-centered">
    <div class="column is-one-third mt-2">
        <h1 class="has-text-centered has-text-weight-bold">Haldusmoodul</h1><br>
        <button class="button is-link is-info is-fullwidth" onclick="location.href='questions_view.php'">Küsimuste loetellu</button>
        <button class="button is-link is-warning is-fullwidth mt-2" onclick="location.href='question_create_new.php'">Lisa uus küsimus</button>
        <button class="button is-link is-success is-fullwidth mt-2" onclick="location.href='index.php'">Vaata aktiivset küsimust / Avaleht</button>
    </div>
</div>

<?php require 'templates/footer.php'; ?>