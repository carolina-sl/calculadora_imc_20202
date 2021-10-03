
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dados</title>

</head>
    
    <style>
        body {
            background-color: #836FFF;
            font-size: 20px;
        }

    </style>


    <body>

    <div id="info" align="center">
<?php

    require_once('Pessoa.class.php');
    
    if(!isset($_SESSION["usuarios"])){
        session_start();
        
    }

if(isset($_POST)) 
{

    if($_POST["nome"] && $_POST["idade"] && $_POST["peso"] && $_POST["altura"]){
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
        $peso = $_POST["peso"];
        $altura = $_POST["altura"];
    
        $pessoa = new Pessoa($nome, $idade, $peso, $altura);
       
        adicionar_usuarios_sessao($pessoa);
        exibir_pessoas_array_sessao();
        exibir_modalide_media();
    } else {
        echo '<b>Não foram enviados todos os dados para cálculo do IMC!</b>';
    }   
}

function retornar_modalidade_imc($imc){
    $modalidade = "";
    if ($imc < 18.5) {
        $modalidade = "Abaixo do peso.";
    }elseif ($imc >= 18.5 and $imc <=24.9) {
        $modalidade = "Peso normal";
    }elseif($imc >= 25.00 and $imc <=29.9) {
        $modalidade = "Sobrepeso";
    }elseif ($imc>= 30.00 and $imc <= 34.9) {
        $modalidade = "Obesidade Grau I";
    }elseif ($imc>= 35.00 and $imc <= 39.9) {
        $modalidade = "Obesidade Grau II";
    }elseif ($imc>= 40.00) {
        $modalidade = "Obesidade Grau III";
    }

    return $modalidade;
}

function adicionar_usuarios_sessao($pessoa){
    if(isset($_SESSION['usuarios'])){
        if(count($_SESSION['usuarios']) > 2){
          
            array_shift($_SESSION['usuarios']);
        }
        
    }
    
    $_SESSION['usuarios'][]= $pessoa;
    
}

function exibir_pessoas_array_sessao(){
    $dados = $_SESSION['usuarios'];
    $total_imc = 0;

    foreach($_SESSION['usuarios'] as $indice => $pessoa){
        
        echo '<pre>';
        echo (string)$pessoa;
        echo '<pre>';

        $total_imc += $pessoa->imc;   
    }
}

function exibir_modalide_media() {
    $soma_idade = 0;
    $soma_imc = 0;
    $total_pessoas = 0;
    
    foreach($_SESSION['usuarios'] as $indice =>$pessoa){
       
        $soma_idade += $pessoa->idade;
        $soma_imc += $pessoa->imc;
        $total_pessoas += 1;
    }
    
    echo '<pre>';
    echo '<b>Total de pessoas:</b> '. $total_pessoas;
    echo '<b><br />Soma idades:</b> '.$soma_idade." anos.";
    echo '<b><br />Soma imc\'s: </b>'.$soma_imc." Kg/m2";
    echo '<b><br />Média idades: </b>'.number_format($soma_idade / $total_pessoas, 2)." anos.";
    echo '<b><br />Média imc\'s: </b>'.number_format($soma_imc / $total_pessoas, 2)." Kg/m2";
    echo '</pre>';

    $media_imc = $soma_imc / $total_pessoas;

    echo 'Modalidade média: '.retornar_modalidade_imc($media_imc); 
}

?>

</div>

        <div align="center">

    <p>Interpretação do IMC</p>
    <table border="2">
        <tr>
            <td> <b> IMC </b> </td>
            <td> <b> CLASSIFICAÇÃO </b> </td>
            <td> <b> OBESIDADE (grau) </b></td>
        </tr>
        <tr>
            <td> Menor que 18,5</td>
            <td> Abaixo do peso</td>
            <td> 0 </td>
        </tr>
        <tr>
            <td> Entre 18,5 e 24,9 </td>
            <td> Peso Normal</td>
            <td> 0 </td>
        </tr>
        <tr>
            <td> Entre 25,00 e 29,9 </td>
            <td> Sobrepeso</td>
            <td> I </td>

        </tr>
        <tr>
            <td> Entre 30,0 e 34,9 </td>
            <td> Obesidade Grau I</td>
            <td> I </td>
        </tr>
        <tr>
            <td> Entre 35 e 39,9 </td>
            <td> Obesidade Grau II</td>
            <td> II</td>
        </tr>
        <tr>
            <td> Maior que 40 </td>
            <td> Obesidade Grau III</td>
            <td> III</td>
        </tr>


    </table>

    <a href="index.html">VOLTAR</a> 
    
</div>

</body>
</html>