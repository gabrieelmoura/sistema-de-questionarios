<?php 

require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/auth.php';

$questionario = \App\Model\Questionario::with('perguntas')->find($_GET['id']);
$pergunta_atual_id = isset($_GET['p_id']) ? $_GET['p_id'] : $questionario->perguntas->first()->id;
$pergunta_atual = \App\Model\Pergunta::with('opcoes')->find($pergunta_atual_id);
$preenchimento = \App\Model\Preenchimento::firstOrCreate([
    'usuario_id' => $auth->id,
    'questionario_id' => $_GET['id']
]);
$preenchimento->load('respostas.opcao');

$marcadas = $preenchimento->respostas->map(function($resposta) {
    return $resposta->opcao_id;
})->toArray();

$salvas = $preenchimento->respostas->map(function($resposta) {
    return $resposta->opcao->pergunta_id;
})->unique()->toArray();

?>
<?php require_once __DIR__ . '/layout/top.php';  ?>
<div class="container">
    <h1 class="text-center"><?= $questionario->nome ?></h1>
    <h2><?= $pergunta_atual->titulo ?></h2>
    <p><?= $pergunta_atual->descricao ?></p>
    <form method="POST" action="salvar.php" style="display: inline;">
        <input type="hidden" name="preenchimento_id" value="<?= $preenchimento->id ?>">
        <input type="hidden" name="pergunta_id" value="<?= $pergunta_atual->id ?>">
        <table class="table">
            <tbody>
                <?php foreach ($pergunta_atual->opcoes as $opcao): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="opcoes_id[]" value="<?= $opcao->id ?>" <?= in_array($opcao->id, $marcadas) ? 'checked' : '' ?>>
                            <?= $opcao->descricao ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php if (!in_array($pergunta_atual->id, $salvas)): ?>
            <button class="btn btn-primary">Salvar</button>
        <?php else: ?>
            <button class="btn btn-default">Atualizar</button>
        <?php endif ?>
    </form>
    <form method="POST" action="concluir.php" style="display: inline;">
        <input type="hidden" name="preenchimento_id" value="<?= $preenchimento->id ?>">
        <button class="btn btn-primary">Concluir</button>
    </form>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php foreach ($questionario->perguntas as $index => $pergunta): ?>
                <li class="page-item <?= $pergunta->id == $pergunta_atual_id ? 'active' : '' ?>">
                    <a class="page-link" href="?id=<?= $_GET['id'] ?>&p_id=<?= $pergunta->id ?>">
                        <?= $index + 1?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </nav>
</div>
<?php require_once __DIR__ . '/layout/bottom.php'; ?>