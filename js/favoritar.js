document.addEventListener('DOMContentLoaded', function() {
    const favoritarBtn = document.getElementById('favoritar-btn');
    
    if (favoritarBtn) {
        favoritarBtn.addEventListener('click', function() {
            const idTrabalhador = this.getAttribute('data-id-trabalhador');

            // Envio de requisição AJAX para o backend
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../html/favoritar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Sucesso: Atualiza o botão conforme a resposta
                        const response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            const icon = response.favorited ? 'bi-bookmark-star-fill' : 'bi-bookmark-star';
                            favoritarBtn.innerHTML = `<i class="bi ${icon}"></i>`;
                        } else {
                            console.log('Erro: ', response.message);
                        }
                    } else {
                        console.error('Erro na requisição AJAX');
                    }
                }
            };

            // Envia o id_trabalhador para o backend
            xhr.send('id_trabalhador=' + encodeURIComponent(idTrabalhador));
        });
    }
});
