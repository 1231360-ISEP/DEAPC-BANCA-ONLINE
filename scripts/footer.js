const modal = document.querySelector('#modal-footer');
const modalOpenButton = document.querySelector('#abrir-modal-footer');
const modalCloseButton = document.querySelector('#fechar-modal-footer');

modalOpenButton.addEventListener('click', () => {
	modal.showModal();
});

modalCloseButton.addEventListener('click', () => {
	modal.close();
});
