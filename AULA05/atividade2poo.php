<?php
class usuario {
    public $nome;
    public $CPF;
    public $sexo;
    public $email;
    public $EstadoCivil;
    public $Cidade;
    public $Estado;
    public $Endereco;
    public $CEP;

    public function __construct($nome,$CPF,$sexo,$email,$EstadoCivil,$Cidade,$Estado,$Endereco,$CEP){
        $this->nome=$nome;
        $this->CPF=$CPF;
        $this->sexo=$sexo;
        $this->email=$email;
        $this->EstadoCivil=$EstadoCivil;
        $this->Cidade=$Cidade;
        $this->Estado=$Estado;
        $this->Endereco=$Endereco;
        $this->CEP=$CEP;
    }
}
$usuario1 = new usuario(
    "Josenildo Afonso Souza",
    "100.200.300-40",
    "Masculino",
    "josenewdo.souza@gmail.com",
    "Casado",
    "Xique-Xique",
    "Bahia",
    "Rua da amizade, 99",
    "40123-98");
$usuario2 = new usuario(
    "Valentina Passos Scherrer",
    "070.070.060-70",
    "Feminino",
    "scherrer.valen@outlook.com",
    "Divorciada",
    "Iracemápolis",
    "São Paulo",
    "Avenida da saudade, 1942",
    "23456-24");
$usuario3 = new usuario(
    "Claudio Braz Nepumoceno",
    "575.575.242-32",
    "Masculino",
    "Clauclau.nepumoceno@gmail.com",
    "Solteiro",
    "Piripiri",
    "Piauí",
    "Estrada 3, 33",
    "12345-99");
?>