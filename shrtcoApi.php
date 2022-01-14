	<h2> Encurtador de Link</h2>
	<form id="formSLink" method="post">
		<input type='text' id='inpMLink' name="link" placeholder="Digite seu Link">
		<button id="btnEnc" type="submit">encurtar </button>
	</form>
	<div id="divResFormSL">
		<h3>Resultado : </h3>
	</div>

	<?php
	// definindo quais erros vou ver no meu php 
	error_reporting(E_ERROR /*| E_WARNING*/);

	// criando $arrContexOptions para evitar erro em $pegar data HTTPs
	$arrContextOptions = array(
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);
	// recebendo o url 
	$short = "https://api.shrtco.de/v2/shorten?url=";
	$link = $_POST['link'];
	if (isset($link)) {
		$resultado =  file_get_contents($short . $link, false, stream_context_create($arrContextOptions));
		$json = json_decode($resultado);
		if ($json->ok = "true") {
			$linkC = $json->result->short_link;
			echo 'seu link encurtado de : <br> ' .
				$link . ' é  : <br> ';
		} else if ($json->ok != "true") {
			echo "Tivemos um erro ao processar seu link";
		}
	} // isset $link
	?>

	<b><input id="linkConvRecbd" type="text" value='<?php echo $linkC ?>'></b>
	<button id="copurl">copiar</button>
	<script>
		// usando o botão de copiar para pegar value do input.value
		document.getElementById('copurl').addEventListener('click', function() {
			var textoCopiado = document.querySelector("#linkConvRecbd");
			textoCopiado.select();
			document.execCommand("copy");
		});
	</script>