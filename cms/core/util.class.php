<?php
	/**
	 * util.class [ HELPER ]
	 * Contém várias funções de manipulação
	 * 
	 * @copyright (c) 2023.
	 */
	 
	class Util {
		/* Contantes da função normalizarNome() */
		const NN_PONTO = '\.';
		const NN_PONTO_ESPACO = '. ';
		const NN_ESPACO = ' ';
		const NN_REGEX_MULTIPLOS_ESPACOS = '\s+';
		const NN_REGEX_NUMERO_ROMANO = '^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$';

		public function util() {}
		
		/* Formata data do padrão brasileiro para timestamp, usada para salvar no banco de dados. */
		function formatDataTimestamp($data) {
			if ($data != "") {
				$dlist = explode('/', $data);
				$data = date("Y-m-d H:i:s", mktime(0, 0, 0, $dlist[1], $dlist[0], $dlist[2]));
			}
			return $data;
		}

		/* Formata data do padrão timestamp do banco de dados para o padrão brasileiro, usada para trazer do banco de dados. */
		function formatTimestampData($data) {
			if ($data != "0000-00-00 00:00:00" && $data != "0000-00-00") {
				return date('d/m/Y', strtotime($data));
			} else {
				return "";
			}
		}

		/* Formata hora do padrão 00:00 para timestamp, usada para salvar no banco de dados. */
		function formatHoraTimestamp($hora) {
			if ($hora != "") {
				$tlist = explode(':', $hora);
				$hora = date("Y-m-d H:i:s", mktime($tlist[0], $tlist[1], $tlist[2], 0, 0, 0));
			}
			return $hora;
		}

		/* Formata hora do padrão timestamp do banco de dados para o padrão 00:00, usada para trazer do banco de dados. */
		function formatTimestampHora($hora) {
			if ($hora != "0000-00-00 00:00:00") {
				return date('H:i', strtotime($hora));
			} else {
				return "";
			}
		}
			
		/* Formata moeda do padrão moeda brasileira para decimal, usada para salvar no banco de dados. */
		function formatMoedaDecimal($valor) {
			$valor = str_replace(".", "", $valor);
			$valor = str_replace(",", ".", $valor);
			return $valor;
		}
		
		/* Formata moeda do padrão decimal do banco de dados para o padrão moeda brasileira, usada para trazer do banco de dados. */
		function formatDecimalMoeda($valor) {
			$valor = number_format($valor, 2, ',', '.');
			return $valor;
		}

		/* Coloca em maúsculas as primeiras letras de uma string */
		function strPrimeirasMaiusculas($palavra) {
			$aux = str_split($palavra);			
			$teste = true;
			$newpalavra = "";
			foreach($aux as $i) {
				if ($teste)
					$newpalavra .= strtoupper($i);
				else 
					$newpalavra .= strtolower($i);
				if ($i == " ")
					$teste=true;
				else 
					$teste=false;
			}
			return $newpalavra;
		}

		/* Retorna um número específico de palavras de um string */
		function strQuebraPalavras($texto, $qtd) {
			$retorno = '';
			if ($total <= $qtd) {
				$retorno = $texto;
			} else {
				$aux = explode(' ', $texto);
				$total = sizeof($aux);
				
				for ($i = 0; $i < $total; $i++) {
					if ($i < $qtd) {
						$retorno .= $aux[$i].' ';
					}
				}
			}
			return $retorno;
		}

		/* Retorna um número específico de letras sem quebrar palavras */
		function strQuebraCaracteres($texto, $qtd) {
			$retorno = '';
			if (strlen($texto) <= $qtd) {
				$retorno = $texto;
			} else {
				$palavras = explode(' ', $texto);
				$total = sizeof($palavras);

				for ($i = 0; $i < $total; $i++) {
					if (strlen($retorno.$palavras[$i]) >= $qtd) {
						$retorno = substr($retorno, 0, strlen($retorno) - 1).'...';
						break;
					} else {
						$retorno .= $palavras[$i].' ';
					}
				}
			}
			return $retorno;
		}

		/* Remove os acentos de uma string */
		function strRemoveAcentos($str, $enc = "UTF-8") {
			$acentos = array(
			'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
			'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
			'C' => '/&Ccedil;/',
			'c' => '/&ccedil;/',
			'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
			'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
			'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
			'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
			'N' => '/&Ntilde;/',
			'n' => '/&ntilde;/',
			'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
			'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
			'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
			'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
			'Y' => '/&Yacute;/',
			'y' => '/&yacute;|&yuml;/',
			'a.' => '/&ordf;/',
			'o.' => '/&ordm;/');
		
			return preg_replace($acentos, array_keys($acentos), htmlentities($str, ENT_NOQUOTES, $enc));
		}

		/* Retorna mês por extenso e em português */
		function mesExtenso($mes) {
			switch ($mes) {
				case 1:
					$mes = "Janeiro";
					break;
				case 2:
					$mes = "Fevereiro";
					break;
				case 3:
					$mes = "Março";
					break;
				case 4:
					$mes = "Abril";
					break;
				case 5:
					$mes = "Maio";
					break;
				case 6:
					$mes = "Junho";
					break;
				case 7:
					$mes = "Julho";
					break;
				case 8:
					$mes = "Agosto";
					break;
				case 9:
					$mes = "Setembro";
					break;
				case 10:
					$mes = "Outubro";
					break;
				case 11:
					$mes = "Novembro";
					break;
				case 12:
					$mes = "Dezembro";
					break;
			}

			return $mes;
		}

		function getIp() {
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			{
		 
				$ip = $_SERVER['HTTP_CLIENT_IP'];
		 
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
		 
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		 
			}
			else{
		 
				$ip = $_SERVER['REMOTE_ADDR'];
		 
			}
		 
			return $ip;
		 
		}

		function idade($nascimento, $formato, $separador) {
			//Data Nascimento
			$nascimento = explode($separador, $nascimento);
			 
			if ($data1>$data2)
			{
			return " ";
			}
			 
			if ($formato=="dma")
			{
			$ano = $nascimento[2];
			$mes = $nascimento[1];
			$dia = $nascimento[0];
			}
			elseif ($formato=="amd")
			{
			$ano = $nascimento[0];
			$mes = $nascimento[1];
			$dia = $nascimento[2];
			}
			 
			$dia1 = $dia;
			$mes1 = $mes;
			$ano1 = $ano;
			 
			$dia2 = date("d");
			$mes2 = date("m");
			$ano2 = date("Y");
			 
			$dif_ano = $ano2 - $ano1;
			$dif_mes = $mes2 - $mes1;
			$dif_dia = $dia2 - $dia1;
			 
			if ( ($dif_mes == 0) and ($dia2 < $dia1) ) {
			$dif_dia = ($this->ultimoDiaMes($data1) - $dia1) + $dia2;
			$dif_mes = 11;
			$dif_ano--;
			} elseif ($dif_mes < 0) {
			$dif_mes = (12 - $mes1) + $mes2;
			$dif_ano--;
			if ($dif_dia<0){
			$dif_dia = ($this->ultimoDiaMes($data1) - $dia1) + $dia2;
			$dif_mes--;
			}
			} elseif ($dif_dia < 0) {
			$dif_dia = ($this->ultimoDiaMes($data1) - $dia1) + $dia2;
			if ($dif_mes>0) {
			$dif_mes--;
			}
			}
			/*
			if ($dif_ano>0) {
			$dif_ano = $dif_ano . " ano" . (($dif_ano>1) ? "s ": " ") ;
			} else { $dif_ano = ""; }
			if ($dif_mes>0) {
			$dif_mes = $dif_mes . " mes" . (($dif_mes>1) ? "es ": " ") ;
			} else { $dif_mes = ""; }
			if ($dif_dia>0) {
			$dif_dia = $dif_dia . " dia" . (($dif_dia>1) ? "s ": " ") ;
			} else { $dif_dia = ""; }
			*/

			if ($dif_ano>0) {
			$dif_ano = $dif_ano . "a" . (($dif_ano>1) ? " ": " ") ;
			} else { $dif_ano = ""; }
			if ($dif_mes>0) {
			$dif_mes = $dif_mes . "m" . (($dif_mes>1) ? " ": " ") ;
			} else { $dif_mes = ""; }
			if ($dif_dia>0) {
			$dif_dia = $dif_dia . "d" . (($dif_dia>1) ? " ": " ") ;
			} else { $dif_dia = ""; }

			return trim($dif_ano . $dif_mes . $dif_dia);
		}

		function ultimoDiaMes($data = "") {
			if (!$data) {
			   $dia = date("d");
			   $mes = date("m");
			   $ano = date("Y");
			} else {
			   $dia = date("d", $data);
			   $mes = date("m", $data);
			   $ano = date("Y", $data);
			}
			$data = mktime(0, 0, 0, $mes, 1, $ano);
			return date("d", $data - 1);
		 }
		 
		   /**
		   * Normaliza o nome próprio dado, aplicando a capitalização correta de acordo
		   * com as regras e exceções definidas no código.
		   * POR UMA DECISÃO DE PROJETO, FORAM UTILIZADAS FUNÇÕES MULTIBYTE (MB_) SEMPRE
		   * QUE POSSÍVEL, PARA GARANTIR SUA USABILIDADE EM STRINGS UNICODE.
		   * @param string $nome O nome a ser normalizado
		   * @return string O nome devidamente normalizado
		   */
		  public static function normalizarNome($nome) {
			/*
			 * A primeira tarefa da normalização é lidar com partes do nome que
			 * porventura estejam abreviadas,considerando-se para tanto a existência de
			 * pontos finais (p. ex. JOÃO A. DA SILVA, onde "A." é uma parte abreviada).
			 * Dado que mais à frente dividiremos o nome em partes tomando em
			 * consideração o caracter de espaço (" "), precisamos garantir que haja um
			 * espaço após o ponto. Fazemos isso substituindo todas as ocorrências do
			 * ponto por uma sequência de ponto e espaço.
			 */
			$nome = mb_ereg_replace(self::NN_PONTO, self::NN_PONTO_ESPACO, $nome);
			
			/*
			 * O procedimento anterior, ou mesmo a digitação errônea, podem ter
			 * introduzido espaços múltiplos entre as partes do nome, o que é totalmente
			 * indesejado. Para corrigir essa questão, utilizamos uma substituição
			 * baseada em expressão regular, a qual trocará todas as ocorrências de
			 * espaços múltiplos por espaços simples.
			 */
			$nome = mb_ereg_replace(self::NN_REGEX_MULTIPLOS_ESPACOS, self::NN_ESPACO,
			  $nome);
			
			/*
			 * Isso feito, podemos fazer a capitalização "bruta", deixando cada parte do
			 * nome com a primeira letra maiúscula e as demais minúsculas. Assim,
			 * JOÃO DA SILVA => João Da Silva.
			 */
			$nome = mb_convert_case($nome, MB_CASE_TITLE, mb_detect_encoding($nome));
			
			/*
			 * Nesse ponto, dividimos o nome em partes, para trabalhar com cada uma
			 * delas separadamente.
			 */
			$partesNome = mb_split(self::NN_ESPACO, $nome);
			
			/*
			 * A seguir, são definidas as exceções à regra de capitalização. Como
			 * sabemos, alguns conectivos e preposições da língua portuguesa e de outras
			 * línguas jamais são utilizadas com a primeira letra maiúscula.
			 * Essa lista de exceções baseia-se na minha experiência pessoal, e pode ser
			 * adaptada, expandida ou mesmo reduzida conforme as necessidades de cada
			 * caso.
			 */
			$excecoes = array(
			  'de', 'di', 'do', 'da', 'dos', 'das', 'dello', 'della',
			  'dalla', 'dal', 'del', 'e', 'em', 'na', 'no', 'nas', 'nos', 'van', 'von',
			  'y'
			);
			
			for($i = 0; $i < count($partesNome); ++$i) {
			
			  /*
			   * Verificamos cada parte do nome contra a lista de exceções. Caso haja
			   * correspondência, a parte do nome em questão é convertida para letras
			   * minúsculas.
			   */
			  foreach($excecoes as $excecao)
				if(mb_strtolower($partesNome[$i]) == mb_strtolower($excecao))
				  $partesNome[$i] = $excecao;
			
			  /*
			   * Uma situação rara em nomes de pessoas, mas bastante comum em nomes de
			   * logradouros, é a presença de numerais romanos, os quais, como é sabido,
			   * são utilizados em letras MAIÚSCULAS.
			   * No site
			   * http://htmlcoderhelper.com/how-do-you-match-only-valid-roman-numerals-with-a-regular-expression/,
			   * encontrei uma expressão regular para a identificação dos ditos
			   * numerais. Com isso, basta testar se há uma correspondência e, em caso
			   * positivo, passar a parte do nome para MAIÚSCULAS. Assim, o que antes
			   * era "Av. Papa João Xxiii" passa para "Av. Papa João XXIII".
			   */
			  if(mb_ereg_match(self::NN_REGEX_NUMERO_ROMANO,
				mb_strtoupper($partesNome[$i])))
				$partesNome[$i] = mb_strtoupper($partesNome[$i]);
			}
			
			/*
			 * Finalmente, basta juntar novamente todas as partes do nome, colocando um
			 * espaço entre elas.
			 */
			return implode(self::NN_ESPACO, $partesNome);
		 
		  }
	}
?>