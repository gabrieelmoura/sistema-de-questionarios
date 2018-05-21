<?php

require_once __DIR__ . '/includes/init.php';

$ids = \App\Model\Pergunta::with('opcoes')->find($_POST['pergunta_id'])->opcoes->map(function($opcao) {
	return $opcao->id;
})->toArray();

\App\Model\Resposta::query()
    ->whereIn('opcao_id', $ids)
    ->wherePreenchimentoId($_POST['preenchimento_id'])
    ->delete();

$data = [];

foreach ($_POST['opcoes_id'] as $opcaoId) {
    $data[] = [
        'opcao_id' => $opcaoId,
        'preenchimento_id' => $_POST['preenchimento_id']
    ];
}

\App\Model\Resposta::insert($data);

header('Location: ' . $_SERVER['HTTP_REFERER']);