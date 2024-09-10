document.getElementById('comentarioForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do formulário

    var formData = new FormData(this);

    fetch('processacomentario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Mostrar a mensagem de sucesso/erro
        document.getElementById('comentarios').insertAdjacentHTML('afterbegin', data);

        // Limpar o formulário
        this.reset();
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});
