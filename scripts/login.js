const loginForm = document.querySelector('form');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');
const mensagemErro = document.querySelector('p.erro');

loginForm.addEventListener('submit', event => {
	mensagemErro.innerHTML = '';

	const username = usernameInput.value;
	const usernameValido = /^[A-z0-9_]+$/;
	const password = passwordInput.value;

	if(!usernameValido.test(username)) {
		event.preventDefault();

		usernameInput.classList.add('erro');

		mensagemErro.innerHTML += 'O username só pode conter letras, números e o símbolo _<br/>';
	}else {
		usernameInput.classList.remove('erro');
	}

	if(password.length < 8) {
		event.preventDefault();

		passwordInput.classList.add('erro');

		mensagemErro.innerHTML += 'A password tem que ter pelo menos 8 caracteres<br/>';
	}else {
		passwordInput.classList.remove('erro');
	}
});
