let sistemas = [{
    nome: 'Biblioteca - Reservas',
    url: 'http://localhost:8000/api/reservas',
    alvo_cpf: ['cpf_aluno_reservas'],
    alvo_data: ['data_inicial'],
    cor: '#229a41',
    estrutura: {
        local: [{
            campo: 'cpf_aluno_reservas',
            nome: 'CPF Aluno'
        }, {
            campo: 'data_inicial',
            nome: 'Data Inicial'
        }, { 
        campo: 'data_final',
        nome: 'Data Final'
    }],
        estrangeiraMM: [{
            tabela: 'livros',
            nome: 'Livros',
            campo: 'nome_livros'
        }]
    }
}, {
    nome: 'COOPAM - Vendas',
    url: 'http://localhost:8001/api/vendas',
    alvo_cpf: ['cpf_aluno_vendas'],
    alvo_data: ['data_venda'],
    cor: '#9a2222',
    estrutura: {
        local: [{
            campo: 'cpf_aluno_vendas',
            nome: 'CPF Aluno'
        }, {
            campo: 'preco_total_vendas',
            nome: 'Preço Total'
        }],
        estrangeiraM1: [{
            tabela: 'pagamentos',
            nome: 'Tipo Pagamento',
            campo: 'tipo_pagamentos'
        }],
        estrangeiraMM: [{
            tabela: 'produtos',
            nome: 'Produtos',
            campo: 'nome_produtos'
        }]
    }
}, {
    nome: 'NIPE - Projetos',
    url: 'http://localhost:8002/api/projetos',
    alvo_cpf: ['alunos', 'cpf_alunos'],
    alvo_data: ['data_hora_registro_projetos'],
    cor: '#9a7522',
    estrutura: {
        local: [{
            campo: 'protocolo_projetos',
            nome: 'Protocolo'
        }, {
            campo: 'data_hora_registro_projetos',
            nome: 'Data Registro'
        }, {
            campo: 'titulo_projetos',
            nome: 'Título'
        }],
        estrangeiraM1: [{
            tabela: 'area_conhecimento',
            nome: 'Area Conhecimento',
            campo: 'nome_area_conhecimento'
        }, {
            tabela: 'unidades',
            nome: 'Unidade',
            campo: 'nome_unidades'
        }],
        estrangeiraMM: [{
            tabela: 'alunos',
            nome: 'Alunos',
            campo: 'nome_alunos'
        }]
    }
}];

chamadaLogin();

const token = window.localStorage.getItem('access_token');

funcaoPrimaria();

function funcaoPrimaria(){
    let checkboxs = document.querySelector('.checkboxs');
    checkboxs.style['color'] = 'white';
    checkboxs.innerHTML = 'Sistemas: ';

    let contadores = document.querySelector('.contadores');
    contadores.innerHTML = '';
    var container = document.createElement('div');
    container.className = 'container';
    var row = document.createElement('div');
    row.className = 'row';

    for(var i = 0; i < sistemas.length; i++){
        var div = document.createElement('div');
        div.className = 'form-check form-check-inline';

        var input = document.createElement('input');
        input.className = 'form-check-input';
        input.type = 'checkbox';
        input.id = `${sistemas[i].nome}-checkbox`;
        input.value = i;

        var label = document.createElement('label');
        label.className = 'form-check-label';
        label.for = `${sistemas[i].nome}-checkbox`;
        label.innerText = sistemas[i].nome;

        div.appendChild(input);
        div.appendChild(label);
        checkboxs.appendChild(div);

        var dados = getAPI(sistemas[i].url);

        let contador = [{
            nome: 'Dia',
            valor: 0
        }, {
            nome: 'Mês',
            valor: 0
        }, {
            nome: 'Ano',
            valor: 0
        }];

        let alvos = sistemas[i].alvo_data;
        const cor = sistemas[i].cor;
        const nome = sistemas[i].nome;

        dados.then(resultado => {
            //console.log(resultado);

            var col = document.createElement('div');
            col.className = 'col-4';
            col.innerText = nome;

            var data = new Date();
            var dia = data.getDay(), mes = data.getMonth(), ano = data.getFullYear();

            for(var j = 0; j < resultado.length; j++){
                var valorNewData;

                if(alvos.length == 1){
                    valorNewData = resultado[j][alvos[0]];
                } else if(alvos.length == 2){
                    valorNewData = resultado[j][alvos[0]][alvos[1]];
                }

                var dataResult = new Date(valorNewData);
                var newDia = dataResult.getDay(), newMes = dataResult.getMonth(), newAno = dataResult.getFullYear();

                console.log(data);
                console.log(dataResult);

                console.log(newDia);
                console.log(newMes);

                console.log(dia);
                console.log(mes);

                if(dia == newDia + 1 && mes == newMes && ano == newAno){
                    contador[0].valor = contador[0].valor + 1;
                } if(mes == newMes && ano == newAno){
                    contador[1].valor = contador[1].valor + 1;
                } if(ano == newAno){
                    contador[2].valor = contador[2].valor + 1;
                }
            }

            for(var j = 0; j < contador.length; j++){          
                var div1 = document.createElement('div');
                div1.innerText = contador[j].nome;
                div1.style['margin-bottom'] = '2.5%';
        
                var div2 = document.createElement('div');
                div2.innerText = String(contador[j].valor);
                div2.style['background-color'] = cor;
                div2.style['padding'] = '5%';
                div2.style['border-radius'] = '4px';
                div2.style['font-weight'] = 'bold';
                div2.style['font-size'] = '25px';
        
                div1.appendChild(div2);
                col.appendChild(div1);
            }

            row.appendChild(col);
        });
    }

    container.appendChild(row);
    contadores.appendChild(container);
}

function contar_data(){
    //let botaoData = document.querySelector('#botaoData');
    let dataInicial = document.querySelector('#dataInicial').value;
    let dataFinal = document.querySelector('#dataFinal').value;

    let contadores2 = document.querySelector('.contadores2');
    contadores2.innerHTML = '';
    var container = document.createElement('div');
    container.className = 'container';
    var row = document.createElement('div');
    row.className = 'row';

    for(var i = 0; i < sistemas.length; i++){
        var dados = getAPI(sistemas[i].url);

        let contador2 = 0;

        let alvos = sistemas[i].alvo_data;
        const cor = sistemas[i].cor;
        const nome = sistemas[i].nome;

        dados.then(resultado => {
            //console.log(resultado);

            var col = document.createElement('div');
            col.className = 'col-4';
            col.innerText = nome;

            var dataI = dataInicial.split('-'), dataF = dataFinal.split('-');
            var diaI = dataI[2], mesI = dataI[1], anoI = dataI[0];
            var diaF = dataF[2], mesF = dataF[1], anoF = dataF[0];

            for(var j = 0; j < resultado.length; j++){
                var valorNewData;

                if(alvos.length == 1){
                    valorNewData = resultado[j][alvos[0]];
                } else if(alvos.length == 2){
                    valorNewData = resultado[j][alvos[0]][alvos[1]];
                }

                var dataResult = valorNewData.split('-');
                var newDia = dataResult[2], newMes = dataResult[1], newAno = dataResult[0];

                if((newDia >= diaI && newMes == mesI && newAno == anoI) && (newDia <= diaF && newMes == mesF && newAno == anoF)){
                    contador2 = contador2 + 1;
                }
            }

            var div1 = document.createElement('div');
            div1.innerText = dataInicial + ' até ' + dataFinal;
            div1.style['margin-bottom'] = '2.5%';
    
            var div2 = document.createElement('div');
            div2.innerText = String(contador2);
            div2.style['background-color'] = cor;
            div2.style['padding'] = '5%';
            div2.style['border-radius'] = '4px';
            div2.style['font-weight'] = 'bold';
            div2.style['font-size'] = '25px';
    
            div1.appendChild(div2);
            col.appendChild(div1);
            row.appendChild(col);
        });
    }

    container.appendChild(row);
    contadores2.appendChild(container);
}

function buscar_cpf(){
    let checkboxResult = document.querySelector('.checkboxs');
    let tables = document.querySelector('.tables');
    tables.innerHTML = '';
    tables.style['color'] = 'white';

    [].forEach.call(checkboxResult.children, function(el) {
        if(el.children[0].checked){
            var pos = el.children[0].value;
            var dados = getAPI(sistemas[pos].url);

            var table = document.createElement('table');
            table.className = 'table table-striped table-dark';
            table.style['margin-top'] = '2.5%';
            var caption = document.createElement('caption');
            caption.style['color'] = 'white';
            caption.style['font-weight'] = 'bold';
            caption.style['padding'] = '15%';
            caption.innerText = sistemas[pos]['nome'];
            var thead = document.createElement('thead');
            var tr = document.createElement('tr');
            var tds = '';

            if(sistemas[pos]['estrutura']['local']){
                for(var i = 0; i < sistemas[pos]['estrutura']['local'].length; i++){
                    tds += `<td>${sistemas[pos]['estrutura']['local'][i]['nome']}</td>`;
                }
            }

            if(sistemas[pos]['estrutura']['estrangeiraM1']){
                for(var i = 0; i < sistemas[pos]['estrutura']['estrangeiraM1'].length; i++){
                    tds += `<td>${sistemas[pos]['estrutura']['estrangeiraM1'][i]['nome']}</td>`;
                }
            }

            if(sistemas[pos]['estrutura']['estrangeiraMM']){
                for(var i = 0; i < sistemas[pos]['estrutura']['estrangeiraMM'].length; i++){
                    tds += `<td>${sistemas[pos]['estrutura']['estrangeiraMM'][i]['nome']}</td>`;
                }
            }

            tr.innerHTML += tds;
            thead.appendChild(caption);
            thead.appendChild(tr);
            table.appendChild(thead);

            var tbody = document.createElement('tbody');

            dados.then(resultado => {
                //console.log(resultado);

                var valorPesquisado = document.querySelector('#valorPesquisado').value;

                for(var i = 0; i < resultado.length; i++){
                    if(sistemas[pos].alvo_cpf.length == 1){
                        var alvo_cpf = sistemas[pos].alvo_cpf[0];
    
                        if(valorPesquisado == resultado[i][alvo_cpf]){
                            var tr2 = document.createElement('tr');
                            var tds2 = '';

                            if(sistemas[pos]['estrutura']['local']){
                                for(var j = 0; j < sistemas[pos]['estrutura']['local'].length; j++){
                                    var campo = sistemas[pos]['estrutura']['local'][j]['campo'];
    
                                    tds2 += `<td>${resultado[i][campo]}</td>`;
                                }
                            } if(sistemas[pos]['estrutura']['estrangeiraM1']){
                                for(var j = 0; j < sistemas[pos]['estrutura']['estrangeiraM1'].length; j++){
                                    var tabela = sistemas[pos]['estrutura']['estrangeiraM1'][j]['tabela'];
                                    var campo = sistemas[pos]['estrutura']['estrangeiraM1'][j]['campo'];
    
                                    tds2 += `<td>${resultado[i][tabela][campo]}</td>`;
                                }
                            } if(sistemas[pos]['estrutura']['estrangeiraMM']){
                                for(var j = 0; j < sistemas[pos]['estrutura']['estrangeiraMM'].length; j++){
                                    var tabela = sistemas[pos]['estrutura']['estrangeiraMM'][j]['tabela'];
                                    var campo = sistemas[pos]['estrutura']['estrangeiraMM'][j]['campo'];
                                    var nomes = '';

                                    for(var k = 0; k < resultado[i][tabela].length; k++){
                                        nomes += resultado[i][tabela][k][campo];

                                        if(k < resultado[i][tabela].length - 1) nomes += ', ';
                                    }
    
                                    tds2 += `<td>${nomes}</td>`;
                                }
                            }
                
                            tr2.innerHTML += tds2;
                            tbody.appendChild(tr2);
                        }
                    } else {
                        var alvo_cpf1 = sistemas[pos].alvo_cpf[0];
                        var alvo_cpf2 = sistemas[pos].alvo_cpf[1];
    
                        for(var j = 0; j < resultado[i][alvo_cpf1].length; j++){
                            if(valorPesquisado == resultado[i][alvo_cpf1][j][alvo_cpf2]){
                                var tr2 = document.createElement('tr');
                                var tds2 = '';

                                if(sistemas[pos]['estrutura']['local']){
                                    for(var j = 0; j < sistemas[pos]['estrutura']['local'].length; j++){
                                        var campo = sistemas[pos]['estrutura']['local'][j]['campo'];
        
                                        tds2 += `<td>${resultado[i][campo]}</td>`;
                                    }
                                } if(sistemas[pos]['estrutura']['estrangeiraM1']){
                                    for(var j = 0; j < sistemas[pos]['estrutura']['estrangeiraM1'].length; j++){
                                        var tabela = sistemas[pos]['estrutura']['estrangeiraM1'][j]['tabela'];
                                        var campo = sistemas[pos]['estrutura']['estrangeiraM1'][j]['campo'];
        
                                        tds2 += `<td>${resultado[i][tabela][campo]}</td>`;
                                    }
                                } if(sistemas[pos]['estrutura']['estrangeiraMM']){
                                    for(var j = 0; j < sistemas[pos]['estrutura']['estrangeiraMM'].length; j++){
                                        var tabela = sistemas[pos]['estrutura']['estrangeiraMM'][j]['tabela'];
                                        var campo = sistemas[pos]['estrutura']['estrangeiraMM'][j]['campo'];
                                        var nomes = '';
    
                                        for(var k = 0; k < resultado[i][tabela].length; k++){
                                            nomes += resultado[i][tabela][k][campo];

                                            if(k < resultado[i][tabela].length - 1) nomes += ', ';
                                        }
        
                                        tds2 += `<td>${nomes}</td>`;
                                    }
                                }
                    
                                tr2.innerHTML += tds2;
                                tbody.appendChild(tr2);
                            }
                        }
                    }
                }

                table.appendChild(tbody);
                tables.appendChild(table);
            });
        }
    });

    //document.querySelector('#botao').disabled = true;
}

function limpar(){
    document.location.reload(true);
}

async function getAPI(apiURL){
    try {
        const chamada = await get_api(apiURL);

        return chamada;
    } catch (error) {
        console.log(error);
    }
}

function get_api(apiURL) {
    return new Promise(async (next, reject) => {
        try {
            const chamada = await fetch(apiURL, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            });
            const dados = await chamada.json();
        
            next(dados);
        } catch(error) {
            console.log(error);
        }
    });
}

async function chamadaLogin() {
    try {
        const apiURLLogin = 'http://localhost:8002/api/auth/login';
        const cpfLogin = '12345678900';
        const senhaLogin = '123';

        const dados = await loginAPI({
            cpf_pessoas: cpfLogin,
            senha_pessoas: senhaLogin
        }, apiURLLogin);

        window.localStorage.removeItem('access_token');
        window.localStorage.removeItem('user_cpf');

        window.localStorage.setItem('access_token', dados.access_token);
        window.localStorage.setItem('user_cpf', cpfLogin);

        let data = new Date();
        data.setDate(data.getDate() + 1);
        window.localStorage.setItem('expires_in', data);
        
    } catch (error) {
        console.log(error);
    }
}

function loginAPI(dadosParaLogin, apiURLLogin){
    return new Promise(async (next, reject) => {
    const body = JSON.stringify(dadosParaLogin);

    try {
        const chamada = await fetch(apiURLLogin, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body
        });

        const dados = await chamada.json();

        next(dados);
    } catch(erro) {
        console.log(erro);
    }
    });
}