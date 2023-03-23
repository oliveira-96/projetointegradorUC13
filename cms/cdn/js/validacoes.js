/* Valida Telefone */
function validaTelefone(telefone) {
    var RegExp = /^\([0-9]{2}\) [0-9]{4}-[0-9]{4}|\([0-9]{2}\) [0-9]{5}-[0-9]{4}$/;
	if (telefone.val() == "") {
		return true;
	} else {
		if (RegExp.test(telefone.val())) {
        	return true;
	    } else {
    	    return false;
    	}
	}
}

/* Valida CEP */
function validaCep(cep) {
    var RegExp = /^[0-9]{5}-[0-9]{3}$/;
	if (cep.value == "") {
		return true;
	} else {
		if (RegExp.test(cep.value)) {
        	return true;
	    } else {
    	    return false;
    	}
	}
}

/* Valida e-mail */
function validaEmail(email) {
    var RegExp = /^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/;
	if (email.val() == "") {
		return true;
	} else {
		if (RegExp.test(email.val())) {
        	return true;
	    } else {
    	    return false;
    	}
	}
}

/* Valida URL */
function validaUrl(url) {
    var RegExp = /^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
	if (url.val() == "") {
		return true;
	} else {
		if (RegExp.test(url.val())) {
        	return true;
	    } else {
    	    return false;
    	}
	}
}

/* Valida URL vídeo do Youtube */
function validaYoutube(url) {
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	if (url.val() == "") {
		return true;
	} else {
		return (url.val().match(p)) ? RegExp.$1 : false;
	}
}

/* Valida data */
function validaData(data) {
    var RegExp = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
	if (data.val() == "") {
		return true;
	} else {
		if (RegExp.test(data.val())) {
        	existe = true;
	    } else {
    	    return false;
    	}
	}
	
	dia = (data.val().substring(0,2)); 
	mes = (data.val().substring(3,5)); 
	ano = (data.val().substring(6,10)); 

	/* Verifica o dia válido para cada mês */
	if ((dia < 1)||(dia < 1 || dia > 30) && (  mes == 4 || mes == 6 || mes == 9 || mes == 11 ) || dia > 31) { 
		existe = false; 
	} 
	
	/* Verifica se o mês é válido */
	if (mes < 1 || mes > 12 ) { 
		existe = false;
	} 
	
	/* Verifica se e ano bissexto */
	if (mes == 2 && ( dia < 1 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
		existe = false; 
	} 
	
	/* Somente anos maiores que 1970 - Padrão UTC */
	if (ano < 1800 || ano > 2035) existe = false;

	return existe;
}

/* Valida hora */
function validaHora(hora) {
    var RegExp = /^[0-9]{2}:[0-9]{2}$/;
	if (hora.val() == "") {
		return true;
	} else {
		if (RegExp.test(hora.val())) {
			horas = (hora.val().substring(0,2));  
			minutos = (hora.val().substring(3,5));  
			if ((horas < 0 ) || (horas > 23) || ( minutos < 0) ||( minutos > 59)) { 
				return false;
			} else {
				return true;
			}
	    } else {
    	    return false;
    	}
	}
}

/* Valida Cpf */
function validaCpf(cpf) {
	var vCpf = cpf.val();
	
	if (vCpf == "") {
		return true;
	} else {
		/* Elimina todos os pontos e os traços da formatação. */
		vCpf = vCpf.replace(/\./g, "");
		vCpf = vCpf.replace(/-/g, "");
	}

	if (vCpf.length != 11 || vCpf == "00000000000" || vCpf == "11111111111" || vCpf == "22222222222" || vCpf == "33333333333" || vCpf == "44444444444" || vCpf == "55555555555" || vCpf == "66666666666" || vCpf == "77777777777" || vCpf == "88888888888" || vCpf == "99999999999" || vCpf == "12345678909") return false;

	add = 0;
	for (i=0; i < 9; i ++) add += parseInt(vCpf.charAt(i)) * (10 - i);

	rev = 11 - (add % 11);

	if (rev == 10 || rev == 11) rev = 0;
	if (rev != parseInt(vCpf.charAt(9))) return false;

	add = 0;
	for (i = 0; i < 10; i ++) add += parseInt(vCpf.charAt(i)) * (11 - i);

	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)	rev = 0;
	if (rev != parseInt(vCpf.charAt(10))) return false;
	
	return true;
}

/* Valida Cnpj */
function validaCnpj(cnpj) {
	var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	digitos_iguais = 1;
	
	var vCnpj = cnpj.val();
	
	if (vCnpj == "") {
		return true;
	} else {
		/* Elimina todos os pontos e os traços da formatação. */
		vCnpj = vCnpj.replace(/\./g, "");
		vCnpj = vCnpj.replace(/-/g, "");
		vCnpj = vCnpj.replace(/\//g, "");
	}
	
	if (vCnpj.length < 14 && vCnpj.length < 15) return false;
	for (i = 0; i < vCnpj.length - 1; i++)
		if (vCnpj.charAt(i) != vCnpj.charAt(i + 1)) {
			  digitos_iguais = 0;
			  break;
		}

	if (!digitos_iguais) {
		tamanho = vCnpj.length - 2;
		numeros = vCnpj.substring(0,tamanho);
		digitos = vCnpj.substring(tamanho);
		soma = 0;
		pos = tamanho - 7;

		for (i = tamanho; i >= 1; i--) {
			  soma += numeros.charAt(tamanho - i) * pos--;
			  if (pos < 2) pos = 9;
		}

		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		
		if (resultado != digitos.charAt(0)) return false;
		
		tamanho = tamanho + 1;
		numeros = vCnpj.substring(0,tamanho);
		soma = 0;
		pos = tamanho - 7;

		for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
			if (pos < 2) pos = 9;
		}

		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

		if (resultado != digitos.charAt(1)) return false;

		return true;
	} else {
		return false;
	}
}

/* Valida Arquivo */
function validaArquivo(arquivo, extensoes) {
	/* Pega a extensão do arquivo */
	var extensao = arquivo.val().split('.');	
	extensao = extensao[extensao.length - 1].toLowerCase();
	
	if (arquivo.val() == '' || extensoes == '' && extensao != '') return true;

	extensoes = extensoes.split(';');
	
	for (var i in extensoes) {
		if(extensoes[i] == extensao) return true;
	}
	
	return false;
}