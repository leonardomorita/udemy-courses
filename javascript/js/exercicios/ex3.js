// 1) Use a função para converter de Celsius para Fahrenheit feita no exercício 2. Só que desta vez, a temperatura em Celsius deve ser digitada pelo usuário no campo apropriado e o cálculo deve ser feito quando o botão "Calcular" for pressionado.
function conversorCelsiusParaFahrenheit(celsius) {
    return ( (9 * celsius) / 5 ) + 32;
}

document.querySelector('#converter').onclick = function () {
    const temperaturaCelsius = parseFloat(document.querySelector('#temp_celsius').value);
    const temperaturaFahrenheit = conversorCelsiusParaFahrenheit(temperaturaCelsius);
    document.querySelector('#temp_fahr').textContent = temperaturaFahrenheit;
};

// 2) Solte dentro do elemento abaixo uma lista de todos os anos em que houve a Copa do Mundo de Futebol, desde 1930 até 2018. Lembre-se que a copa do mundo ocorre de 4 em 4 anos.
let elementos = document.querySelector('#anos_copa');
elementos.innerHTML = "";

for (var i = 1930; i <= 2018; i += 4) {
    elementos.innerHTML += '<li>' + i + '</li>';
}

// 3) Informe nos campos abaixo duas notas e o total de faltas do aluno e depois solte o resultado no local apropriado. Sendo que:
// O aluno para ser aprovado precisa ter, no mínimo 70% de presença (o total de aulas é 20): No mínimo tem que ter 14 aulas
// O aluno para ser aprovado precisa ter média maior ou igual a 6.5
// Caso o aluno não seja aprovado, o programa precisa dizer se foi por motivo de média insuficiente, por faltas ou pelos dois motivos.

document.querySelector('#calcular').onclick = function () {
    const nota1 = parseFloat(document.querySelector('#nota1').value);
    const nota2 = parseFloat(document.querySelector('#nota2').value);
    const media = (nota1 + nota2) / 2;
    let faltas = parseInt(document.querySelector('#n_faltas').value);
    
    let resultado = "";
    let imprimir = document.querySelector('#result');
    imprimir.innerHTML = "";
    
    if (faltas <= 6) {
        if (media >= 6.5) {
            resultado = "O aluno foi aprovado com a média " + media + ". O número de faltas foi de " + faltas;
        } else {
            resultado = "O aluno foi reprovado, devido a média que foi de " + media;
        }
        
    } else {
        if (media < 6.5) {
            resultado = "O aluno foi reprovado, devido a média que foi de " + media + " e também por números de faltas, que teve o total de " + faltas;
        } else {
            resultado = "O aluno foi reprovado, devido as números de faltas, que foi de " + faltas;
        }
    }
    imprimir.innerHTML = resultado;
};

// 4) Temos abaixo uma lista de vendas de um curso. Cada venda é um objeto cujas propriedades guardam informações sobre a venda, como o nome do aluno que comprou, a data, o preço e se houve pedido de reembolso.
let vendas_cursos = [
    {
        'aluno': 'Emmanuel Gomes',
        'data': '10/06/2018',
        'valor': 34.99,
        'reembolso': null
        
    },

    {
        'aluno': 'Carla Dias',
        'data': '10/06/2018',
        'valor': 29.99,
        'reembolso': null
        
    },

    {
        'aluno': 'Rafael Marques',
        'data': '11/06/2018',
        'valor': 39.99,
        'reembolso': '13/06/2018'
        
    },

    {
        'aluno': 'Maria Isabel Pereira',
        'data': '11/06/2018',
        'valor': 29.99,
        'reembolso': null
        
    },

    {
        'aluno': 'Andre Luis Silva',
        'data': '12/06/2018',
        'valor': 34.99,
        'reembolso': null
        
    }
];

let tbody = document.querySelector('#vendas_cursos');
tbody.innerHTML = "";

let total = 0.0;
vendas_cursos.forEach(function (venda) {
    if (!venda.reembolso) {
        tbody.innerHTML +=   '<tr>' +
                                '<td>' + venda.aluno + '</td>' +
                                '<td>' + venda.data + '</td>' +
                                '<td>' + venda.valor + '</td>' +
                            '</tr>';
        total += parseFloat(venda.valor);
    }
});

document.querySelector('#total_vendas').innerHTML = total;
