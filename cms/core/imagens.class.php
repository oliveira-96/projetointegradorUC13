<?php
/**
 * imagens.class [ HELPER ]
 * Realiza a manipulação de imagens
 * 
 * @copyright (c) 2023.
 */

/* Classe: Imagens
   Descrição: Classe para tratamento de imagens. */
  
/* Inclue a biblioteca WideImage */
if (file_exists('./core/libs/wideimage/WideImage.php')) {
	//include './core/libs/wideimage/WideImage.php';
}

class Imagens {

	function Imagens() {
		if (!function_exists("ImageCreateTrueColor")) {
			if (!function_exists("ImageCreate")) {
				exit;
			} else {
				ini_set('memory_limit', '128M');
				ini_set('upload_max_filesize', '128M');
			}
		}
	}

	/* Redimensiona uma imagem */
	function redimensionaImagem($imagem_original, $largura, $altura) {
		/* Verifica se é um objeto $_FILES */
		if (@isset($_FILES[$imagem_original]) && @isset($_FILES[$imagem_original]['tmp_name'])) $imagem_original = WideImage::load($imagem_original);

		return $imagem_original->resize($largura, $altura, 'inside', 'down');
	}

	/* Redimensiona uma imagem deixando no tamanho exato e com canvas */
	function canvasImagem($imagem_original, $largura, $altura, $canvas = NULL) {
		/* Verifica se é um objeto $_FILES */
		if (@isset($_FILES[$imagem_original]) && @isset($_FILES[$imagem_original]['tmp_name'])) $imagem_original = WideImage::load($imagem_original);

		return $imagem_original->resizeCanvas($largura, $altura, 'center', 'center', $canvas);
	}

	/* Corta uma imagem apartir do centro */
	function cortaImagem($imagem_original, $largura, $altura) {
		/* Verifica se é um objeto $_FILES */
		if (@isset($_FILES[$imagem_original]) && @isset($_FILES[$imagem_original]['tmp_name'])) $imagem_original = WideImage::load($imagem_original);

		return $imagem_original->crop('center', 'center', $largura, $altura);
	}

	/* Coloca marca d'água em uma imagem */
	function marcaImagem($imagem_original, $imagem_marcadagua, $transicao = 70, $posicao = 5) {	
		/* Verifica se é um objeto $_FILES */
		if (@isset($_FILES[$imagem_original]) && @isset($_FILES[$imagem_original]['tmp_name'])) $imagem_original = WideImage::load($imagem_original);
	
		/* Seta a posição da impressão da marca d'água */
		switch ($posicao) {
			case 1: $posicao_x = 'left'; $posicao_y = 'top'; break;
			case 2: $posicao_x = 'center'; $posicao_y = 'top'; break;
			case 3: $posicao_x = 'right'; $posicao_y = 'top'; break;
			case 4: $posicao_x = 'left'; $posicao_y = 'center'; break;
			case 5: $posicao_x = 'center'; $posicao_y = 'center'; break;
			case 6: $posicao_x = 'right'; $posicao_y = 'center'; break;
			case 7: $posicao_x = 'left'; $posicao_y = 'bottom';	break;
			case 8: $posicao_x = 'center'; $posicao_y = 'bottom'; break;
			case 9: $posicao_x = 'right'; $posicao_y = 'bottom'; break;
			default: $posicao_x = 'center'; $posicao_y = 'center'; break;
		}

		return $imagem_original->merge(WideImage::load($imagem_marcadagua), $posicao_x, $posicao_y, $transicao);
	}

	/* Salva uma imagem */
	function salvaImagem($imagem_original, $imagem_final, $qualidade = 100) {
		$extencao = explode(".", $imagem_final);
		/* Verifica se é um objeto $_FILES */
		if (@isset($_FILES[$imagem_original]) && @isset($_FILES[$imagem_original]['tmp_name'])) $imagem_original = WideImage::load($imagem_original);
		
		if ($extencao[count($extencao) - 1] == 'jpg' or $extencao[count($extencao) - 1] == 'jpeg') {
			$imagem_original->saveToFile($imagem_final, $qualidade);
		} else {
			$imagem_original->saveToFile($imagem_final);
		}		
	}

	/* Exibe uma imagem
	   Chamada: html exibeImagem('../uploads/modulo/thumb') */
	function exibeImagem($imagem, $default) {
		if (!empty($imagem) && file_exists($imagem)) {
			//$path = explode("/", $imagem);
			//$deleta = '';
			//for ($i = 0; $i < (count($path) - 1); $i++) { $deleta .= $path[$i].'/'; }

			//$imagem = glob($imagem.'.*');
			//$imagem = $imagem[count($imagem) - 1];

			$id = time();

			//$extensao = explode('.', $imagem);
			//$extensao = $extensao[count($extensao) - 1];

			return '<div id="'.$id.'_remove">
				    <div class="thumbnail">
                        <img id="'.$id.'" src="'.$imagem.'">
                        <div class="caption" style="text-align:center;">
                            <p>
                                <a class="btn btn-primary" href="javascript:void(0);" onClick="downloadArquivo(\''.$imagem.'\');" title="Download">Download</a>
                                <a class="btn btn-danger" href="javascript:void(0);" onClick="deletaArquivo(\''.$imagem.'\', \''.$id.'\');" title="Excluir">Excluir</a>
                            </p>
                        </div>
                    </div></div>';
		} else {
			return '
				<div class="thumbnail">
					<img src="'.$default.'">
				</div>';
		}
	}

	/* Exibe várias imagens
	   Chamada: html exibeImagens('../uploads/modulo/registro/campo', 'modulo', 'campo', '1') */
	function exibeImagens($path, $modulo, $campo, $registro) {
		if ($path != '') {
			$aberto = @opendir($path.'thumb/');
			while ($arq = @readdir($aberto)) {
				if ($arq != '.' && $arq != '..') {
					$extensao = explode('.', $arq);
					$extensao = $extensao[count($extensao) - 1];
					$id = str_replace('.'.$extensao, '', $arq);
					$imagens .= '<li id="'.$id.'">
								<img src="'.$path.'thumb/'.$arq.'" />
								<div id="'.$id.'_remove" class="remove">
									<a href="javascript:void(0);" onClick="downloadArquivo(\''.$path.'original/'.$id.'.'.$extensao.'\');" title="Baixar imagem">
										<img src="../images/icons/download.png" alt="Baixar" border="0" />
									</a>&nbsp;
									<a href="javascript:void(0);" onClick="deletaImagens(\''.$registro.'\', \''.$id.'\', \''.$modulo.'\', \''.$campo.'\', \''.$extensao.'\');" title="Excluir imagem">
										<img src="../images/icons/remove.png" alt="Excluir" border="0" />
									</a>
								</div>
								</li>';
				}
			}
			return '<div><ul class="gallery">'.$imagens.'</ul></div>';
		} else {
			return '';
		}
	}

	/* Retorna a capa de um álbum
	   Chamada: path retornaCapa('../uploads/modulo/registro/campo/thumb/') */
	function retornaCapa($imagem) {
		if ($imagem != '') {
			$imagem = glob($imagem.'*.*');
			$imagem = $imagem[0];

			if ($imagem) {
				return $imagem;
			} else {
				return 'images/default/imagem_indisponivel.png';
			}
		} else {
			return 'images/default/imagem_indisponivel.png';
		}
	}

	/* Retorna uma imagem com sua extensão
	   Chamada: html exibeImagem('../uploads/modulo/thumb') */
	function retornaImagem($imagem, $default) {
		if ($imagem != '') {
			$imagem = glob($imagem.'.*');
			$imagem = $imagem[count($imagem) - 1];

			if ($imagem) {
				return $imagem;
			} else {
				return $default;
			}
		} else {
			return $default;
		}
	}

	/* Retorna as várias imagens de uma galeria.
	   Chamada: arr retornaImagens('../uploads/modulo/registro/campo/') */
	function retornaImagens($path) {
		if ($path != '') {
			$aberto = @opendir($path);
			while ($arq = @readdir($aberto)) {
				if ($arq != '.' && $arq != '..') {
					$imagens[] .= $arq;
				}
			}
			return $imagens;
		} else {
			return '';
		}
	}
}
?>