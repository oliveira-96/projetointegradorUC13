<?php
/**
 * arquivos.class [ HELPER ]
 * Realiza a manipulação de arquivos
 * 
 * @copyright (c) 2023.
 */
 
class Arquivos {

	function Arquivos() {
		ini_set('memory_limit', '128M');
		ini_set('upload_max_filesize', '128M');
	}

	/* Valida se um arquivo tem a extenşão e tamanho máximo em megabytes permitidos */
	function validaArquivo($arquivo, $extensoes_permitidas = '', $tamanho_maximo = 1) {
		/* Verifica se houve algum erro com o arquivo */
		if ($_FILES[$arquivo]['error'] > 0) return false;

		/* Pega o tamnho do arquivo */
		$tamanho_arquivo = $this->tamanhoArquivo($arquivo);
		
		/* Transforma o tamanho máximo de megabytes para bytes */
		$tamanho_maximo = $tamanho_maximo * 1048576;

		/* Valida nome do arquivo */		
		if ($this->nomeArquivo($arquivo) == '') return false;		
		
		/* Valida o tamanho do arquivo */
		if ($tamanho_arquivo > $tamanho_maximo or $tamanho_arquivo <= 0) return false;
		
		/* Valida as extensões */
		if ($extensoes_permitidas != '') {
			$extensao_arquivo = '.'.$this->tipoArquivo($arquivo);
			$extensoes = explode(";", strtolower($extensoes_permitidas));
			
			foreach ($extensoes as $ext) {
				if ('.'.$ext == $extensao_arquivo) return true;
			}
			
			return false;
		}
		
		return true;
	}
	
	/* Retorna o tamanho de um arquivo */
	function tamanhoArquivo($arquivo) {
		if ($_FILES[$arquivo]['name'] == '') {
			return 0;
		} else {
			return $_FILES[$arquivo]['size'];
		}
	}

	/* Retorna o nome do arquivo na máquina do usuário */
	function nomeArquivo($arquivo) {
		return $_FILES[$arquivo]['name'];
	}
	
	/* Retorna o tipo de arquivo, baseada na sua extenşão */
	function tipoArquivo($arquivo) {
		$nome = $this->nomeArquivo($arquivo);
		
		if ($nome != '') {
			$extensao = explode(".", $this->nomeArquivo($arquivo));
			return strtolower($extensao[count($extensao) - 1]);
		} else {
			return '';
		}
	}
	
	/* Retorna o próprio arquivo */
	function retornaArquivo($arquivo) {
		return $_FILES[$arquivo]['tmp_name'];
	}

	/* Exibe um arquivo */
	function exibeArquivo($diretorio) {
		if ($diretorio != '') {
			$path = explode("/", $diretorio);
			for ($i = 0; $i < (count($path) - 1); $i++) { $deleta .= $path[$i].'/'; }
			
			$diretorio = glob($diretorio.'*.*');
			$diretorio = $diretorio[count($diretorio) - 1];
			
			$extensao = explode('.', $diretorio);
			$extensao = $extensao[count($extensao) - 1];
			
			$id = $path[count($path) - 2];
			
			if ($diretorio) {
				return '<div id="'.$id.'_remove" class="row" style="margin-left:0px; margin-bottom: 10px;">
				    <div class="thumbnail">
                        <div class="caption" style="text-align:center;">
							<p style="margin: 10px;">Arquivo no formato '.strtoupper($extensao).'</p>
                            <p>
                                <a rel="tooltip" class="btn btn-primary" href="javascript:void(0);" onClick="downloadArquivo(\''.$diretorio.'\');" title="Download do arquivo">Download</a>
                            </p>
                        </div>
                    </div></div>';
			} else {
				return '<div class="row" style="margin-left:0px; margin-bottom: 10px;">
				    <div class="thumbnail">
                        <div class="caption" style="text-align:center;">
							<p style="margin: 10px;">Nenhum arquivo encontrado</p>
                        </div>
                    </div></div>';
			}
		}
	}

	/* Salva um arquivo em disco */
	function salvaArquivo($arquivo_original, $arquivo_final) {
		/* Verifica se é um objeto $_FILES */
		if (isset($_FILES[$arquivo_original]) && isset($_FILES[$arquivo_original]['tmp_name'])) {
			/* Faz a cópia do arquivo para o servidor */
			move_uploaded_file($_FILES[$arquivo_original]['tmp_name'], $arquivo_final);
			// @copy($_FILES[$arquivo_original]['tmp_name'], $arquivo_final);
		} else {
			return false;
		}	
	}
			
	/* Deleta um arquivo baseado no seu path */
	function deletaArquivo($arquivo) {
		if (@is_file($arquivo)) {
			unlink($arquivo);
			return true;
		} else {
			return false;
		}
	}
	
	/* Retorna o número de arquivos de um diretório */
	function contaArquivos($diretorio) {
		$aberto = @opendir($diretorio);

		$arquivos = 0;

		while (false !== ($arquivo = @readdir($aberto))) {
			if ($arquivo != "." && $arquivo != ".." && !(is_dir($diretorio.$arquivo))) {
			  $arquivos++;
			}
		}

		@closedir($aberto);

		return $arquivos;
	}
}
?>