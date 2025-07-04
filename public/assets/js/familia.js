async function carregar_cliente(valor) {
    if (valor.length >= 3) {
        //console.log("Pesquisar:" + valor);
        const dados = await fetch('/BuscaFamilia?cliente='+valor, {
            method: "get",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
        });
        const resposta = await dados.json();
        
        //console.log(resposta);
        let html = "<ul class='list-group '>";
       const lis= resposta.map(({ nome_responsavel, id }) => "<li class='list-group-item list-group-item-action' data-id='"+id+"'>" + nome_responsavel + "</li>")
        
        html += lis.join('') + "</ul>";
        resultado.innerHTML = html;
        //console.log(resultado)
    }
}
resultado.addEventListener('click', ({ target }) => {
    if (target.matches('li')) {
        cliente.value = target.innerText
        fk_familia.value = target.dataset.id
        resultado.innerHTML=''
        //console.log(target)
    }
    
})