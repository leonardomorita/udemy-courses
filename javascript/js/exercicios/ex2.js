// 1) Resolva o cálculo abaixo e mostre o resultado na caixa reservada para isto. Os ids das caixas são "num_1", "num_2" e "resultado". Para que o resultado saia em negrito, coloque-o dentro da tag <strong>.
const numeroUm = parseInt(document.querySelector('#num_1').textContent);
const numeroDois = parseInt(document.querySelector('#num_2').textContent);

const resultado = numeroUm + numeroDois;
document.querySelector('#resultado').innerHTML = '<strong>' + resultado + '</strong>';

// 2) Crie uma função para converter graus Celsius para Fahrenheit, depois invoque a função usando o valor que está na caixa azul e solte o resultado na caixa amarela. Os ids são "caixa_azul" e "caixa_amarela".
function conversorCelsiusParaFahrenheit(celsius) {
    return ( (9 * celsius) / 5 ) + 32;
}

const celsius = parseFloat(document.querySelector('#caixa_azul').textContent);
const fahrenheit = conversorCelsiusParaFahrenheit(celsius);
document.querySelector('#caixa_amarela').textContent = fahrenheit;

// 3) Forme um novo array composto pelos 2 últimos elementos do array abaixo. Em seguida adicione ao final do novo array mais um grupo composto pelos alunos "Mariana", "Felipe" e "Carla".
var grupos = [ 
    [ "João" , "Maria" ],
    [ "Pedro" , "Joana", "André", "Júlio" ],
    [ "Carolina" , "Helena", "Marcelo" ]
];

const novosGrupos = grupos.slice(1, grupos.length);
novosGrupos.push([ "Mariana", "Felipe" , "Carla" ]);
console.log(novosGrupos);

// 4) Considere o objeto abaixo:
var curso = {
    'titulo': "Aprenda programação em Python",
    'categoria': ['programação', 'tecnologia', 'python'],
    'n_aval_5_estrelas': 420,
    'n_aval_4_estrelas': 80,
    'n_aval_3_estrelas': 33,
    'n_aval_2_estrelas': 20,
    'n_aval_1_estrela': 4,
    'total_avaliacoes': function () {
        return curso.n_aval_1_estrela + curso.n_aval_2_estrelas + curso.n_aval_3_estrelas + curso.n_aval_4_estrelas + curso.n_aval_5_estrelas;
    },
    'media_estrelas': function () {
        return ( (5 * this.n_aval_5_estrelas) + (4 * this.n_aval_4_estrelas) + (3 * this.n_aval_3_estrelas) + (2 * this.n_aval_2_estrelas) + (1 * this.n_aval_1_estrela) ) / this.total_avaliacoes();
    }
}
// a) A categoria principal do curso é o primeiro elemento da lista associada à chave 'categoria'. Solte esta categoria abaixo, no span que tem id "categoria_principal"
const categoria = curso.categoria[0];
document.querySelector('#categoria_principal').innerHTML = categoria;

// b) As propriedades n_aval... representam a quantidade de avaliações do curso, de 1 até 5 estrelas. Crie dois métodos: um para retornar o total de avaliações do curso e um para retornar a média de estrelas que tem o curso (exemplo: 4.5). Depois utilize-os para soltar estas informações nas caixas abaixo, que tem os ids "total_aval" e "media_aval".
document.querySelector('#total_aval').innerHTML = curso.total_avaliacoes();
document.querySelector('#media_aval').innerHTML = curso.media_estrelas().toFixed(2);

// 5) Crie um objeto para guardar nome, sobrenome e e-mail de uma pessoa. Em seguida, crie uma função que receba o objeto como argumento e retorne um string com o html de uma tabela conforme o modelo abaixo. Em seguida Solte o html da tabela dentro elemento que tem id="tabela".
const pessoa = {
    'nome': 'Pessoa Um',
    'sobrenome': 'Sobrenome Um',
    'email': 'email_um@mail'
};

function gerarTabelaPessoa(pessoa) {
    const table = 
        '<div class="tableBox">' +
            '<table>' +
                '<tr>' +
                    '<th>Nome Completo</th>' +
                    '<th>Email</th>' +
                '</tr>' +

                '<tr>' +
                    '<td>' + pessoa.nome + ' ' + pessoa.sobrenome + '</td>' +
                    '<td>' + pessoa.email + '</td>' +
                '</tr>' +
            '</table>' +
        '</div>';
    return table;
}

document.querySelector('#tabela').innerHTML = gerarTabelaPessoa(pessoa);