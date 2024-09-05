function curtirPerfil(trabalhadorId) {
    // Faz uma requisição AJAX para o servidor para curtir o perfil
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "curtir.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Atualiza o número de curtidas no frontend
            document.getElementById('curtidas').innerText = xhr.responseText;
        }
    };
    xhr.send("id=" + trabalhadorId);
}

function curtir() {
    const curtidas = document.getElementById('curtida');
    if (curtidas.type === 'int') {
        olhoIcon.classList.remove('bi bi-heart');
        olhoIcon.classList.add('bi bi-heart-fill');
    } else {
        olhoIcon.classList.remove('bi bi-heart-fill');
        olhoIcon.classList.add('bi bi-heart');
    }
}