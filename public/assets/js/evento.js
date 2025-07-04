async function carregar_evento(valor) {
    if (valor.length >= 3) {
        //console.log("Pesquisar:" + valor);
        const dados = await fetch('/BuscaEventoAjax?getevento=' + valor, {
            method: "get",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        const resposta = await dados.json();
        //formata a data do bd
        const formatarData = (dataStr) => {
            const data = new Date(dataStr);
            const dia = String(data.getDate()).padStart(2, '0');
            const mes = String(data.getMonth() + 1).padStart(2, '0'); // meses vão de 0 a 11
            const ano = data.getFullYear();
            return `${dia}/${mes}/${ano}`;
        };

        console.log(resposta);
        let html = "<ul class='list-group '>";
        const lis = resposta.map(({ nomeevento, id, data_inicial }) => {
            const dataFormatada = formatarData(data_inicial);
            return `<li class='list-group-item list-group-item-action' data-id='${id}'>${nomeevento} - ${dataFormatada}</li>`;
        });


        html += lis.join('') + "</ul>";
        resultadoEvento.innerHTML = html;
        //console.log(resultadoEvento);
    }
}
resultadoEvento.addEventListener('click', ({ target }) => {
    if (target.matches('li')) {
        document.getElementById('getevento').value = target.innerText;
        document.getElementById('idEvento').value = target.dataset.id;
        resultadoEvento.innerHTML = '';
    }
});


