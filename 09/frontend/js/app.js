const apiUrlBase = 'http://localhost/uc7/09/api/clientes_api.php'; // Ajuste se necessário
const mensagemDiv = document.getElementById('mensagem');

function exibirMensagem(msg, tipo = 'info') {
    if (mensagemDiv) {
        mensagemDiv.textContent = msg;
        mensagemDiv.className = `mensagem ${tipo}`; // Adiciona classe para estilização
        setTimeout(() => {
            mensagemDiv.textContent = '';
            mensagemDiv.className = 'mensagem';
        }, 3000);
    } else {
        alert(msg); // Fallback se mensagemDiv não existir na página atual
    }
}

// --- LÓGICA PARA clientes.html ---
if (document.getElementById('tabelaClientes')) {
    const tabelaClientesBody = document.getElementById('tabelaClientes');

    function carregarClientes() {
        fetch(`${apiUrlBase}?action=listar`)
            .then(response => response.json())
            .then(clientes => {
                tabelaClientesBody.innerHTML = ''; // Limpa
                if (clientes.length === 0) {
                    tabelaClientesBody.innerHTML = '<tr><td colspan="6">Nenhum cliente encontrado.</td></tr>';
                    return;
                }
                clientes.forEach(cliente => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${cliente.id}</td>
                        <td>${cliente.nome}</td>
                        <td>${cliente.cpf}</td>
                        <td>${cliente.birthDate}</td>  <td>${cliente.active ? 'Sim' : 'Não'}</td> <td>
                            <button onclick="editarCliente(${cliente.id})">Editar</button>
                            <button onclick="excluirCliente(${cliente.id})">Excluir</button>
                        </td>
                    `;
                    tabelaClientesBody.appendChild(tr);
                });
            })
            .catch(error => {
                console.error('Erro ao listar clientes:', error);
                exibirMensagem('Falha ao carregar clientes.', 'erro');
            });
    }

    window.editarCliente = function(id) {
        window.location.href = `cliente-form.html?id=${id}`;
    }

    window.excluirCliente = function(id) {
        if (confirm('Tem certeza que deseja excluir este cliente?')) {
            fetch(`${apiUrlBase}?action=excluir&id=${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        exibirMensagem(`Erro: ${data.error}`, 'erro');
                    } else {
                        exibirMensagem(data.message || 'Cliente excluído!', 'sucesso');
                        carregarClientes(); // Recarrega a lista
                    }
                })
                .catch(error => {
                    console.error('Erro ao excluir:', error);
                    exibirMensagem('Falha ao excluir cliente.', 'erro');
                });
        }
    }
    carregarClientes(); // Carrega ao iniciar a página
}


// --- LÓGICA PARA cliente-form.html ---
if (document.getElementById('formCliente')) {
    const formCliente = document.getElementById('formCliente');
    const formTitulo = document.getElementById('formTitulo');
    const clienteIdInput = document.getElementById('clienteId');
    const nomeInput = document.getElementById('nome');
    const cpfInput = document.getElementById('cpf');
    const dataNascInput = document.getElementById('dataDeNascimento');
    const ativoInput = document.getElementById('ativo');

    const urlParams = new URLSearchParams(window.location.search);
    const idEdicao = urlParams.get('id');

    if (idEdicao) {
        formTitulo.textContent = 'Editar Cliente';
        // Carregar dados do cliente para edição
        fetch(`${apiUrlBase}?action=buscar&id=${idEdicao}`)
            .then(response => response.json())
            .then(cliente => {
                if (cliente.error) {
                    exibirMensagem(`Erro: ${cliente.error}`, 'erro');
                    return;
                }
                clienteIdInput.value = cliente.id;
                nomeInput.value = cliente.nome;
                cpfInput.value = cliente.cpf;
                dataNascInput.value = cliente.dataDeNascimento;
                ativoInput.checked = cliente.ativo;
            })
            .catch(error => {
                console.error('Erro ao buscar cliente para edicao:', error);
                exibirMensagem('Nao foi possivel carregar dados do cliente.', 'erro');
            });
    }

    formCliente.addEventListener('submit', function(event) {
        event.preventDefault();
        const dados = {
            nome: nomeInput.value,
            cpf: cpfInput.value,
            birthDate: dataNascInput.value, // Nome do campo ajustado para a API
            active: ativoInput.checked // Nome do campo ajustado para a API
        };

        let url = `${apiUrlBase}?action=cadastrar`;
        let method = 'POST';

        if (clienteIdInput.value) { // Se tem ID, é atualização
            url = `${apiUrlBase}?action=atualizar&id=${clienteIdInput.value}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        })
        .then(response => {
            // Verifica se a resposta tem conteúdo (não é 204 No Content)
            if (response.status === 204) {
                return { message: 'Cliente atualizado com sucesso!' }; // Retorna uma mensagem de sucesso padrão
            }
            return response.json(); // Se não for 204, tenta analisar como JSON
        })
        .then(data => {
            if (data.error) {
                exibirMensagem(`Erro: ${data.error}`, 'erro');
            } else {
                exibirMensagem(data.message || 'Operacao realizada com sucesso!', 'sucesso');
                // Limpar form apenas se for cadastro novo e bem sucedido
                if (method === 'POST') { // Não verificar data.error aqui, já tratado acima
                    formCliente.reset();
                }
                setTimeout(() => { window.location.href = 'clientes.html'; }, 1500);
            }
        })
        .catch(error => {
            console.error('Erro ao salvar:', error);
            exibirMensagem('Falha ao salvar dados.', 'erro');
        });
    });
}

const apiUrlProdutos = 'http://localhost/uc7/09/api/produtos_api.php'; // Ajuste se necessário

// --- LÓGICA PARA produtos.html ---
if (document.getElementById('tabelaProdutos')) {
    const tabelaProdutosBody = document.getElementById('tabelaProdutos');

    function carregarProdutos() {
        fetch(`${apiUrlProdutos}?action=listar`)
            .then(response => response.json())
            .then(produtos => {
                tabelaProdutosBody.innerHTML = ''; // Limpa
                if (produtos.length === 0) {
                    tabelaProdutosBody.innerHTML = '<tr><td colspan="7">Nenhum produto encontrado.</td></tr>';
                    return;
                }
                produtos.forEach(produto => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${produto.id}</td>
                        <td>${produto.nome}</td>
                        <td>R$ ${parseFloat(produto.preco).toFixed(2)}</td>
                        <td>${produto.dataDeCadastro}</td>
                        <td>${produto.dataDeValidade || 'N/A'}</td>
                        <td>${produto.ativo ? 'Sim' : 'Não'}</td>
                        <td>
                            <button onclick="editarProduto(${produto.id})">Editar</button>
                            <button onclick="excluirProduto(${produto.id})">Excluir</button>
                        </td>
                    `;
                    tabelaProdutosBody.appendChild(tr);
                });
            })
            .catch(error => {
                console.error('Erro ao listar produtos:', error);
                exibirMensagem('Falha ao carregar produtos.', 'erro');
            });
    }

    window.editarProduto = function(id) {
        window.location.href = `produto-form.html?id=${id}`;
    }

    window.excluirProduto = function(id) {
        if (confirm('Tem certeza que deseja excluir este produto?')) {
            fetch(`${apiUrlProdutos}?action=excluir&id=${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        exibirMensagem(`Erro: ${data.error}`, 'erro');
                    } else {
                        exibirMensagem(data.message || 'Produto excluído!', 'sucesso');
                        carregarProdutos(); // Recarrega a lista
                    }
                })
                .catch(error => {
                    console.error('Erro ao excluir produto:', error);
                    exibirMensagem('Falha ao excluir produto.', 'erro');
                });
        }
    }
    carregarProdutos(); // Carrega ao iniciar a página de produtos
}

// --- LÓGICA PARA produto-form.html ---
if (document.getElementById('formProduto')) {
    const formProduto = document.getElementById('formProduto');
    const formProdutoTitulo = document.getElementById('formProdutoTitulo');
    const produtoIdInput = document.getElementById('produtoId');
    const produtoNomeInput = document.getElementById('produtoNome');
    const produtoPrecoInput = document.getElementById('produtoPreco');
    const produtoDataCadastroInput = document.getElementById('produtoDataCadastro');
    const produtoDataValidadeInput = document.getElementById('produtoDataValidade');
    const produtoAtivoInput = document.getElementById('produtoAtivo');

    const urlParamsProduto = new URLSearchParams(window.location.search);
    const idEdicaoProduto = urlParamsProduto.get('id');

    if (idEdicaoProduto) {
        formProdutoTitulo.textContent = 'Editar Produto';
        // Carregar dados do produto para edição
        fetch(`${apiUrlProdutos}?action=buscar&id=${idEdicaoProduto}`)
            .then(response => response.json())
            .then(produto => {
                if (produto.error) {
                    exibirMensagem(`Erro: ${produto.error}`, 'erro');
                    return;
                }
                produtoIdInput.value = produto.id;
                produtoNomeInput.value = produto.nome;
                produtoPrecoInput.value = parseFloat(produto.preco).toFixed(2);
                produtoDataCadastroInput.value = produto.dataDeCadastro;
                produtoDataValidadeInput.value = produto.dataDeValidade || ''; // Campo pode ser vazio
                produtoAtivoInput.checked = produto.ativo;
            })
            .catch(error => {
                console.error('Erro ao buscar produto para edicao:', error);
                exibirMensagem('Nao foi possivel carregar dados do produto.', 'erro');
            });
    }

    formProduto.addEventListener('submit', function(event) {
        event.preventDefault();
        const dadosProduto = {
            nome: produtoNomeInput.value,
            preco: parseFloat(produtoPrecoInput.value),
            dataDeCadastro: produtoDataCadastroInput.value,
            dataDeValidade: produtoDataValidadeInput.value || null, // Envia null se vazio
            active: produtoAtivoInput.checked // Alteração: Nome do campo ajustado para a API
        };

        // Validação mínima
        if (!dadosProduto.nome || isNaN(dadosProduto.preco) || !dadosProduto.dataDeCadastro) {
            exibirMensagem('Nome, Preço e Data de Cadastro são obrigatórios.', 'erro');
            return;
        }


        let url = `${apiUrlProdutos}?action=cadastrar`;
        let method = 'POST';

        if (produtoIdInput.value) { // Se tem ID, é atualização
            url = `${apiUrlProdutos}?action=atualizar&id=${produtoIdInput.value}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dadosProduto)
        })
        .then(response => {
            // Verifica se a resposta tem conteúdo (não é 204 No Content)
            if (response.status === 204) {
                return { message: 'Produto atualizado com sucesso!' }; // Retorna uma mensagem de sucesso padrão
            }
            return response.json(); // Se não for 204, tenta analisar como JSON
        })
        .then(data => {
            if (data.error) {
                exibirMensagem(`Erro: ${data.error}`, 'erro');
            } else {
                exibirMensagem(data.message || 'Operacao realizada com sucesso!', 'sucesso');
                if (method === 'POST') { // Não verificar data.error aqui, já tratado acima
                    formProduto.reset();
                }
                setTimeout(() => { window.location.href = 'produtos.html'; }, 1500);
            }
        })
        .catch(error => {
            console.error('Erro ao salvar produto:', error);
            exibirMensagem('Falha ao salvar dados do produto.', 'erro');
        });
    });
}