<?php 

require_once __DIR__ . '/includes/init.php'; 
require_once __DIR__ . '/includes/auth.php';

$questionariosNaoRespondidos = App\Model\Questionario::whereDoesntHave('preenchimentos', function ($query) use ($auth) {
    $query->whereUsuarioId($auth->id)->whereConcluido(true);
})->get();

$questionariosRespondidos = App\Model\Questionario::whereHas('preenchimentos', function ($query) use ($auth) {
    $query->whereUsuarioId($auth->id)->whereConcluido(true);
})->get();

?>
<?php require_once __DIR__ . '/layout/top.php'; ?>
<div class="container text-center">
    <h1>Questionários</h1>
    <div class="text-left">
        <h2>Não respondidos</h2>
        <ul>
            <?php foreach ($questionariosNaoRespondidos as $questionario): ?>
                <li><a href="questionario.php?id=<?= $questionario->id ?>"><?= $questionario->nome ?></a></li>
            <?php endforeach ?>
        </ul>
        <h2>Respondidos</h2>
        <ul>
            <?php foreach ($questionariosRespondidos as $questionario): ?>
                <li><?= $questionario->nome ?></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<?php require_once __DIR__ . '/layout/bottom.php'; ?>