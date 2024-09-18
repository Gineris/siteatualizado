document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function() {
        const workerId = this.getAttribute('data-id');
        const icon = this.querySelector('.favorite-icon');
        
        // Verifica o estado do favorito
        if (icon.classList.contains('bi-heart')) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill'); // Muda para preenchido
            // Enviar requisição para adicionar aos favoritos
            fetch('favorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_trabalhador: workerId }),
            });
        } else {
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart'); // Muda para vazio
            // Enviar requisição para remover dos favoritos
            fetch('remover_favorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_trabalhador: workerId }),
            });
        }
    });
});
