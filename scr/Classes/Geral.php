<?php

namespace Classes;

use Traits\DadosValidos;
use Traits\GeraAleatorio;
use Traits\GeraJogos;
use Traits\VerificaJogoGanhador;

class Geral
{
    use DadosValidos, GeraAleatorio, GeraJogos, VerificaJogoGanhador;

    private int $qtdDezenas, $totalJogos, $maxSorteado = 60;
    private array $jogos, $resultado, $keyVencedor;
    private bool $vencedor = false;

    private $atributosProtegidos = [
        'qtdDezenas' => [6,7,8,9,10]
    ];

    public function __set($atributo, $valor)
    {
        if(property_exists($this, $atributo))
        {
            if ($this->dadosValidos($atributo, $this->$atributo)) {
                $this->$atributo = $valor;
            }
        }
        else
        {
            echo 'Set Atributo inexistente';
        }
    }

    public function __get($atributo)
    {
        if(property_exists($this, $atributo))
        {
            return $this->$atributo;
        }
        else
        {
            echo 'Get Atributo inexistente';
        }
    }

    public function __construct(int $qtdDezenas, int $totalJogos)
    {
        $this->setQtdDezenas($qtdDezenas);
        $this->totalJogos = $totalJogos;
    }

    public function setQtdDezenas($qtdDezenas)
    {
        if ($this->dadosValidos('qtdDezenas', $qtdDezenas)) {
            $this->qtdDezenas = $qtdDezenas;
        }
    }

    public function setResultado()
    {
        $this->resultado = $this->geraAleatorio(6);
    }

    public function handle()
    {
        $this->geraJogos();
        $this->setResultado();
        $this->verificaJogoGanhador();
    }



}