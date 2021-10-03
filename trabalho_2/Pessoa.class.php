<?php

class Pessoa {
    public $nome;
    public $idade;
    public $peso;
    public $altura;
    public $imc;
    public $modalidade;

    public function __construct($nome ="", $idade="", $peso="", $altura="", $imc="") {
        $this->nome = $nome;
		$this->idade = (integer)$idade;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->imc = number_format($peso/$altura**2, 2);
        $this->modalidade_imc();
    }

    public function __toString() {
        return $this->nome.", você tem ".$this->idade. " anos. Seu IMC é: ".$this->imc.
        "Kg/m2. O resultado foi obtido a partir do peso: ".$this->peso.
        "Kg e da altura: ".$this->altura."m.".$this->modalidade; 
    }
    
    function modalidade_imc () {

        if ($this->imc < 18.5) {
            $this->modalidade = " Você está na modalidade Abaixo do peso.";
        } elseif ($this->imc >= 18.5 and $this->imc <=24.9) {
            $this->modalidade = " Você está na modalidade Peso normal";
        } elseif($this->imc >= 25.00 and $this->imc <=29.9) {
            $this->modalidade = " Você está na modalidade Sobrepeso";
        } elseif ($this->imc>= 30.00 and $this->imc <= 34.9) {
            $this->modalidade = " Você está na modalidade Obesidade grau I";
        } elseif ($this->imc>= 35.00 and $this->imc <= 39.9) {
            $this->modalidade = " Você está na modalidade Obesidade grau II";
        } elseif ($this->imc > 40.00) {
            $this->modalidade = " Você está na modalidade Obesidade grau III";

  
        } 
    }


}
