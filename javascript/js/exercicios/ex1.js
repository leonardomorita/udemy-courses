// 1) Na pasta js, crie um arquivo Javascript exclusivamente para resolver este exercício e dê-lhe o nome de 'ex1.js'. Faça o link para ele aqui neste arquivo html e solte no console a mensagem: "O arquivo 'ex1.js' está funcionando". Use este arquivo para resolver também o restante dos exercícios.
console.log("Exercício 1");
console.log("O arquivo 'ex1.js' está funcionando");

// 2) Crie variáveis para guardar o seu nome e o seu ano de nascimento. Solte no console a seguinte mensagem: "Olá, eu me chamo _____________, tenho _____ anos e estou estudando Javascript".
console.log("Exercício 2");
var nome = "Leo";
var idade = 20;
console.log("Olá, eu me chamo " + nome + ", tenho "+ idade + " anos e estou estudando Javascript.");

// 3) Crie variáveis para guardar o nome e o número de matrícula de um aluno. Crie também duas variáveis para guardar notas da prova 1 e da prova 2. Calcule a média e solte no console: "O aluno ____________, matrícula _____________, obteve a média final ____".
console.log("Exercício 3");
var nomeAluno = "Lucas";
var matriculaAluno = "10293849";
var notaProva1 = 8;
var notaProva2 = 9;
var mediaProvas = (notaProva1 + notaProva2) / 2;
console.log("O aluno " + nomeAluno + ", matrícula " + matriculaAluno + ", obteve a média final " + mediaProvas + ".");

// 4) Crie uma variável para guardar um número de telefone celular e teste para saber se o número tem 9 dígitos. Se tiver, solte no console: "Resultado do teste: true". Caso contrário, solte: "Resultado do teste: false".
console.log("Exercício 4");
var telefone = "123456789";
console.log("Resultado do teste: " + (telefone.length == 9));

// 5) Solte no console o resultado da operação 32^6.
console.log("Exercício 5");
console.log(Math.pow(32, 6));

// 7) Considere o bloco de código abaixo e responda os valores que aparecerão no console.
console.log("Exercício 7");
var quantidade = "25";
var numero = 6;
var pressao;
var temperatura = 40;
temperatura = null;
console.log(quantidade += quantidade); // 2525
console.log( (7+5) / numero + 2 ); // 4
console.log(pressao); // undefined
console.log(temperatura); // null
console.log(typeof pressao); // undefined
console.log(typeof temperatura); // object

// 8) Indique o que será retornado no console nas comparações abaixo.
console.log("Exercício 8");
var idade = 65;
console.log(idade != 65); // false
console.log(idade >= 65); // true
console.log("65" == idade); // true
console.log(65 !== idade); // false
console.log(typeof (idade > 60)); // boolean
console.log(typeof (idade > 70)); // boolean