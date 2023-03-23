<?php
	/**
	 * paginacao.class [ HELPER ]
	 * Realiza a paginação de dados no CMS
	 * 
	 * @copyright (c) 2023.
	 */
	 
	class Paginacao {
		
		public function paginacao() {}

		/* Retorna uma string com a paginação */
		function getPaginacao($page = 1, $totalitems, $limit = 10, $adjacents = 1, $targetpage = "/", $pagestring = "?p=")
		{		
			/* Default */
			if (!$adjacents) $adjacents = 1;
			if (!$limit) $limit = 10;
			if (!$page) $page = 1;
			if (!$targetpage) $targetpage = "/";
			
			/* Outras variáveis */
			$prev = $page - 1;									/* Página anterior = page - 1 */
			$next = $page + 1;									/* Próxima página = page + 1 */
			$lastpage = ceil($totalitems / $limit);				/* Última página = total items / items per page, rounded up. */
			$lpm1 = $lastpage - 1;								/* Última página menos 1 */
			
			/* 
				Agora, nós aplicamos as nossas regras e desenhar o objeto de paginação.
				Na verdade, estamos salvando o código para uma variável, no caso, queremos chamar mais de uma vez. 
			*/
			$pagination = "";
			if ($lastpage > 1)
			{	
				$pagination .= "<div style=\"text-align:right; margin-top: -20px;\">";
				$pagination .= '<ul class="pagination pagination-sm">';
		
				/* Botão de anterior */
				if ($page > 1) 
					$pagination .= "<li><a href=\"$targetpage$pagestring$prev\">«</a></li>";
				else
					$pagination .= "<li class=\"disabled\"><a href=\"javascript:void(0);\">«</a></li>";	
				
				/* Páginas */
				if ($lastpage < 7 + ($adjacents * 2))	/* Páginas não suficientes para quebrar */
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<li class=\"active\"><a href=\"javascript:void(0);\">$counter <span class=\"sr-only\">(current)</span></a></li>";
						else
							$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a></li>";					
					}
				}
				elseif ($lastpage >= 7 + ($adjacents * 2))	/* Páginas suficientes para esconder algumas */
				{
					/* Perto de início, esconder apenas páginas finais */
					if ($page < 1 + ($adjacents * 3))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination .= "<li class=\"active\"><a href=\"javascript:void(0);\">$counter <span class=\"sr-only\">(current)</span></a></li>";
							else
								$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a></li>";
						}
						$pagination .= "<li class=\"disabled\"><a href=\"javascript:void(0);\">...</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a></li>";		
					}
					/* No meio, esconder algumas para frente e para trás. */
					elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination .= "<li><a href=\""  . $targetpage . $pagestring . "1\">1</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . "2\">2</a></li>";
						$pagination .= "<li><a href=\"javascript:void(0);\">...</a></li>";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination .= "<li class=\"active\"><a href=\"javascript:void(0);\">$counter <span class=\"sr-only\">(current)</span></a></li>";
							else
								$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a></li>";
						}
						$pagination .= "<li class=\"disabled\"><a href=\"javascript:void(0);\">...</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a></li>";		
					}
					/* Perto do final, só esconder primeiras páginas */
					else
					{
						$pagination .= "<li><a href=\""  . $targetpage . $pagestring . "1\">1</a></li>";
						$pagination .= "<li><a href=\"" . $targetpage . $pagestring . "2\">2</a></li>";
						$pagination .= "<li class=\"disabled\"><a href=\"javascript:void(0);\">...</a></li>";
						for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination .= "<li class=\"active\"><a href=\"javascript:void(0);\">$counter <span class=\"sr-only\">(current)</span></a></li>";
							else
								$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a></li>";
						}
					}
				}
				
				/* Botão de próximo */
				if ($page < $counter - 1) 
					$pagination .= "<li><a href=\"" . $targetpage . $pagestring . $next . "\">»</a></li>";
				else
					$pagination .= "<li class=\"disabled\"><a href=\"javascript:void(0);\">»</a></li>";

				$pagination .= "</ul>";				
				$pagination .= "</div>\n";
			}
			
			return $pagination;
		
		}
	}
?>