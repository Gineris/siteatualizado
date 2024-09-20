fetch('../html/get_favoritos.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const container = document.getElementById('favoritos-container');
            data.favoritos.forEach(trabalhador => {
                const trabalhadorDiv = document.createElement('div');
                trabalhadorDiv.innerHTML = `
                    <h3>${trabalhador.nome}</h3>
                    <p>Contato: ${trabalhador.contato}</p>
                    <p>Descrição: ${trabalhador.descricao}</p>
                    <img src="../uploads/${trabalhador.foto_perfil || 'default.png'}" alt="${trabalhador.nome}">
                `;
                container.appendChild(trabalhadorDiv);
            });
        } else {
            console.log('Não foram encontrados favoritos.');
        }
    })
    .catch(error => console.error('Erro ao buscar favoritos:', error));
