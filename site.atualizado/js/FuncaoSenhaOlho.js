function mostrarSenha(){
    var inputPass = document.getElementById('senha')
    var bntShowPass = document.getElementById('olho')

    if(inputPass.type === 'password'){
        inputPass.setAttribute('type','text')
        bntShowPass.classList.replace('bi-eye-slash','bi-eye')
    }else{
        inputPass.setAttribute('type','password')
        bntShowPass.classList.replace('bi-eye','bi-eye-slash')
    }
    
}

function mostrarSenha2(){
    var inputPass = document.getElementById('senha2')
    var bntShowPass = document.getElementById('olho2')

    if(inputPass.type === 'password'){
        inputPass.setAttribute('type','text')
        bntShowPass.classList.replace('bi-eye-slash','bi-eye')
    }else{
        inputPass.setAttribute('type','password')
        bntShowPass.classList.replace('bi-eye','bi-eye-slash')
    }
}
