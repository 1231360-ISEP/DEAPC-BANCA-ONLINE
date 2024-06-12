const transacaoForm = document.querySelector('form');
const ibanInput = document.querySelector('#iban');
const montanteInput = document.querySelector('#montante');
const mgsErro = document.querySelector('p.erro');
transacaoForm.addEventListener('submit', event => {
	mgsErro.innerHTML='';
	const iban = ibanInput.value;
	const ibanValido = /^[A-Z]{2}[0-9]{23}$/;
	const montante = montanteInput.value;
	const montanteValido = /^[\-0-9,.]+$/;

	if(!ibanValido.test(iban)){
		event.preventDefault();
		ibanInput.classList.add('erro');
		mgsErro.innerHTML += 'O IBAN é constituído por duas letras inciais e 23 números<br/>';
	}else {
		ibanInput.classList.remove('erro');
	}

	if(!montanteValido.test(montante)){
		event.preventDefault();
		montanteInput.classList.add('erro');
		mgsErro.innerHTML += 'O montante deve ter apenas números, vírgulas ou pontos<br/>';

	}else{
		montanteInput.classList.remove('erro');
	}
});
