document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function() {
        const workerId = this.getAttribute('data-id');
        const icon = this.querySelector('.favorite-icon');
        
        if (icon.classList.contains('bi-heart')) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill');

            fetch('registerfavorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_trabalhador: workerId }),
            });
        } else {
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart');

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
