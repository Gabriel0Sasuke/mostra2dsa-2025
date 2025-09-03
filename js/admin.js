let voltar  = 0;
let logout = 0;

function sair(tipo) {
    if (tipo === 1) {
        if (voltar === 0) {
            voltar = 1;
            document.getElementById('voltar').style.background = 'rgba(255, 0, 0, 0.2)';
            document.getElementById('voltar').innerHTML = 'Voltar';
            setTimeout(() => {
                document.getElementById('voltar').style.background = 'rgba(255, 255, 255, 0.1)';
                voltar = 0;
                document.getElementById('voltar').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>';
            }, 10000);
        }else if (voltar === 1){
            location.href = '../../index.php';
            voltar = 0;
            document.getElementById('voltar').style.background = 'rgba(255, 255, 255, 0.1)';
            document.getElementById('voltar').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>';
        }
        document.getElementById('voltar').style.background = 'rgba(255, 0, 0, 0.2)';
    } else if (tipo === 2) {
        if (logout === 0) {
            logout = 1;
            document.getElementById('logout').style.background = 'rgba(255, 0, 0, 0.2)';
            document.getElementById('logout').innerHTML = 'Logout';
            setTimeout(() => {
                document.getElementById('logout').style.background = 'rgba(255, 255, 255, 0.1)';
                document.getElementById('logout').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>';
                logout = 0;
            }, 10000);
        } else if (logout === 1) {
            location.href = 'logout.php';
            logout = 0;
            document.getElementById('logout').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>';
            document.getElementById('logout').style.background = 'rgba(255, 255, 255, 0.1)';
        }
    }
}

function perguntas(abrir_fechar){
    if (abrir_fechar === 1) {
        document.getElementById('perguntafixed').style.display = 'flex';
}else if (abrir_fechar === 2) {
        document.getElementById('perguntafixed').style.display = 'none';
    }
}
function visualizarperguntas(abrir_fechar){
    if (abrir_fechar === 1) {
        document.getElementById('visualizarpergunta').style.display = 'flex';
}else if (abrir_fechar === 2) {
        document.getElementById('visualizarpergunta').style.display = 'none';
    }
}
document.querySelectorAll('.tr-pergunta').forEach(linha => {
            linha.addEventListener('click', () => {
                linha.nextElementSibling.classList.toggle('hidden');
            });
        });