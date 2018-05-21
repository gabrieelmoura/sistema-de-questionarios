<?php 

require_once __DIR__ . '/includes/init.php'; 
require_once __DIR__ . '/includes/auth.php'; 

$preenchimento = \App\Model\Preenchimento::with('questionario.perguntas')->find($_GET['id']);

?>
<?php require_once __DIR__ . '/layout/top.php'; ?>
<div class="container text-center">
    <h1>Questionário Respondido</h1>
    <p>
        Você acertou <?= $preenchimento->acertos ?> de <?= $preenchimento->questionario->perguntas->count() ?>
    </p>
    <a href="questionarios.php" class="btn btn-primary">Voltar</a>
</div>
<?php require_once __DIR__ . '/layout/bottom.php'; ?>