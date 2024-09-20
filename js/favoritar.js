document.getElementById('favoritar-btn').addEventListener('click', function() { 
    var idTrabalhador = this.getAttribute('data-id-trabalhador');
    console.log('ID do trabalhador:', idTrabalhador);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/siteatualizado/html/favoritar.php', true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                console.log('Resposta do servidor:', response);
                if (response.success) {
                    var icon = response.favorited ? 'bi-bookmark-star-fill' : 'bi-bookmark-star';
                    document.getElementById('favoritar-btn').innerHTML = `<i class="bi ${icon}"></i>`;
                } else {
                    alert(response.message);
                }
            } catch (error) {
                console.error('Erro ao processar a resposta JSON:', error);
                console.log('Resposta do servidor que causou erro:', xhr.responseText); // Adicionei para depuração
            }
        } else {
            console.error('Erro na requisição AJAX. Status:', xhr.status);
            console.log('Resposta do servidor:', xhr.responseText); // Adicionei para depuração
        }
    };

    xhr.onerror = function() {
        console.error('Erro na requisição AJAX. Status:', xhr.status, 'Detalhes:', xhr.statusText);
    };

    xhr.send('id_trabalhador= ' + encodeURIComponent(idTrabalhador));
});
