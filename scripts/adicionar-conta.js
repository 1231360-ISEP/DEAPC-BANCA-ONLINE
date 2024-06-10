const clienteForm = document.querySelector('form');
const nomeInput = document.querySelector('#nome-cliente');
const emailInput = document.querySelector('#email');
const telemovelInput = document.querySelector('#telemovel');
const usernameInput = document.querySelector('#username');
const passInput = document.querySelector('#password');
const ibanInput= document.querySelector('#iban-cliente')
const mgsErro = document.querySelector('p.erro');

clienteForm.addEventListener('submit', event => {
	mgsErro.innerHTML = '';

	const nomecliente = nomeInput.value;
	const nomeclienteValido = /^[A-z ]+$/;
	const emailcliente = emailInput.value;
	const emailclienteValido = /^[A-z0-9@._-]+$/;
	const telemovelcliente = telemovel.value;
	const usernamecliente = usernameInput.value;
	const usernameValido = /^[A-z0-9_]+$/;
	const passwordcliente = passInput.value;
	const ibancliente = ibanInput.value;
	const ibanclienteValido = /^[A-Z]{2}[0-9]{23}$/;

	if (!nomeclienteValido.test(nomecliente)) {
		event.preventDefault();

		nomeInput.classList.add('erro');
		mgsErro.innerHTML += 'O nome do cliente não pode conter números, apenas letras e espaços<br/>';
	} else {
		nomeInput.classList.remove('erro');
	}

	if (!emailclienteValido.test(emailcliente)) {
		event.preventDefault();

		emailInput.classList.add('erro');
		mgsErro.innerHTML += 'O email não pode conter espaços nem outros caracteres especiais<br/>';
	} else {
		emailInput.classList.remove('erro');
	}

	if (telemovelcliente.length != 9) {
		event.preventDefault();

		telemovelInput.classList.add ('erro');
		mgsErro.innerHTML += 'O número de telemóvel deve ter 9 digitos<br/>';
	}else {
		telemovelInput.classList.remove('erro');
	}

	if (!usernameValido.test(usernamecliente)) {
		event.preventDefault();

		usernameInput.classList.add('erro');
		mgsErro.innerHTML += 'O username só pode conter letras, números e o símbolo _<br/>';
	}else {
		usernameInput.classList.remove('erro');
	}

	if(passwordcliente.length < 8) {
		event.preventDefault();

		passInput.classList.add('erro');
		mgsErro.innerHTML += 'A password tem que ter pelo menos 8 caracteres<br/>';
	}else {
		passInput.classList.remove('erro');
	}

	if(!ibanclienteValido.test(ibancliente)){
		event.preventDefault();

		ibanInput.classList.add('erro');
		mgsErro.innerHTML += 'O IBAN é constituído por duas letras inciais e 23 números<br/>';
	}else {
		ibanInput.classList.remove('erro');
	}
});
