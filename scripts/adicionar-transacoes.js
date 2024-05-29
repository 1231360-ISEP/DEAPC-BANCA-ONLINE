const transacaoForm = document.querySelector('form');
const entidadeInput = document.querySelector('#entidade');
const montanteInput = document.querySelector('#montante');
const mgsErro = document.querySelector('p.erro');
transacaoForm.addEventListener('submit', event => {
	mgsErro.innerHTML='';
	const entidade = entidadeInput.value;
	const entidadeValido = /^[0-9]{5}$/;
	const montante = montanteInput.value;
	const montanteValido = /^[0-9,.]+$/;

	if(!entidadeValido.test(entidade)){
		event.preventDefault();
		entidadeInput.classList.add('erro');
		mgsErro.innerHTML += 'A entidade deve ter extatamente 5 digitos numéricos<br/>';
	}else {
		entidadeInput.classList.remove('erro');
	}

	if(!montanteValido.test(montante)){
		event.preventDefault();
		montanteInput.classList.add('erro');
		mgsErro.innerHTML += 'O montante deve ter apenas numeros, vírgulas ou pontos<br/>';

	}else{
		montanteInput.classList.remove('erro');
	}
});
