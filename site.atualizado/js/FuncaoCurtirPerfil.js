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

function Curtir() {
    const senhaInput = document.getElementById('senha');
    const olhoIcon = document.getElementById('olho');
    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        olhoIcon.classList.remove('bi-eye-slash');
        olhoIcon.classList.add('bi-eye');
    } else {
        senhaInput.type = 'password';
        olhoIcon.classList.remove('bi-eye');
        olhoIcon.classList.add('bi-eye-slash');
    }
}