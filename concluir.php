<?php

require_once __DIR__ . '/includes/init.php';

$preenchimento = \App\Model\Preenchimento::with(['respostas.opcao', 'questionario.perguntas.opcoes'])->find($_POST['preenchimento_id']);
$questionario = $preenchimento->questionario;

$acertos = $questionario->perguntas->reduce(function($acertos, $pergunta) use ($preenchimento, $questionario) {
	$idsCorretas = $pergunta->opcoes->filter(function ($opcao) {
		return $opcao->correta;
	})->map(function ($opcao) {
		return $opcao->id;
	})->toArray();

	$idsMarcadas = $preenchimento->respostas->filter(function($resposta) use ($pergunta) {
		return $resposta->opcao->pergunta_id == $pergunta->id;
	})->map(function($resposta) {
		return $resposta->opcao_id;
	})->toArray();

	sort($idsCorretas);
	sort($idsMarcadas);

	if ($idsCorretas == $idsMarcadas) {
		return $acertos + 1;
	}

	return $acertos;
}, 0);

$preenchimento->acertos = $acertos;
$preenchimento->concluido = true;
$preenchimento->save();

header('Location: result.php?id=' . $preenchimento->id);