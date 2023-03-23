jQuery(document).ready(function($) {
	$('input[data-type="telefone"]').on('focusout focusin', function(event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	});
	
	$('input[data-type="cpf_cnpj"]').on('focusout focusin', function(event) {
		var target, cpf_cnpj, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		cpf_cnpj = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(cpf_cnpj.length > 11) {
			element.mask("99.999.999/9999-99");
		} else {
			element.mask("999.999.999-99?999");
		}
	});

	$('input[data-type="cpf"]').mask('999.999.999-99');

	$('input[data-type="cnpj"]').mask('99.999.999/9999-99');

	$('input[data-type="data"]').mask("99/99/9999");

	$('input[data-type="hora"]').mask("99:99");

	$('input[data-type="cep"]').mask("99999-999");

	$('input[data-type="inteiro"]').priceFormat({prefix: '', centsSeparator: '', thousandsSeparator: '.', limit: 10, centsLimit: 0});
	
	$('input[data-type="moeda"]').priceFormat({prefix: '', centsSeparator: ',', thousandsSeparator: '.', limit: 10, centsLimit: 2});
	
	$('input[data-type="ano"]').priceFormat({prefix: '', centsSeparator: '', thousandsSeparator: '', limit: 4, centsLimit: 0});
});

/* Remover um arquivo */
function deletaArquivo(imagem, id) {
	if(window.confirm("Deseja realmente excluir o arquivo?")) {
		$.ajax({
			url:'inc/deleta_arquivo.php?arquivo=../'+imagem,
			success:function(data){
				if (data == 0 || data == 1) {
					$("#" + id).attr("src", "../imgs/indisponivel.png");
					$("#" + id + "_remove").remove();
				} else {
					var erro = $.parseJSON(data);
					alert(erro.notificacao);
				}
			},
		});
	}
}

/* Download de um arquivo */
function downloadArquivo(arquivo) {
	location.href = "inc/download.php?arquivo=../"+arquivo;
}

/* Deleta um registro */
function deletaRegistro(id, modulo) {
	if (window.confirm("Deseja realmente excluir este registro?")) {
		location.href = "?m=" + modulo + "&a=delete&id=" + id;
	}
}