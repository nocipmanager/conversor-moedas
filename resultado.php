<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resultado</title>
</head>

<body>
    <header>
        <h1>Conversor de moedas</h1>
    </header>
    <main>
        <?php
                // Recebe o valor do formulário;
                $numero = $_GET["numero"] ?? 0;
            
                // $inicio recebe a data atual com -7 dias, e o $fim é a data atual.
                $inicio = date("m-d-Y", strtotime("-7 days"));
                $fim = date("m-d-Y");
            
                // Consumo da API no site BCB
                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
            
                // Consumo da API no site BCB
                $dados = json_decode(file_get_contents($url), true);
            
                // Consumo da API no site BCB
                $cotação = $dados["value"][0]["cotacaoCompra"];
                
                // Efetuando a conta;
                $result1 = $numero / $cotação;

                // Imprimi o resultado, formantando os valores;
                echo "Seus R$ " . number_format($numero, 2, ",", ".") . " equivalem a <strong>US$</strong> " . number_format($result1, 2, ",", ".");
        ?>
        <br>
        <br>
        <br>
        <br>

        <!-- Comando para redirecionar para o site do BBC -->
        <p> A cotação é de acordo com o <a href="http://bcb.gov.br">Banco Central do Brasil</a></p>

        <!-- Comando para chamar a página index.html -->
        <button onclick="javascrit:window.location.href='index.html'">Voltar</button>
    </main>
</body>

</html>