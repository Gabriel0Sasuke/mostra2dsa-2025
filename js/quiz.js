let segundos = 0;

function start_session() {
    document.getElementById("form_nome").style.display = "none";

    setInterval(() => {
        segundos++;
    }, 1000);
}