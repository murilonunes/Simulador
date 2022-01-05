<?php

namespace Traits;

trait GeraAleatorio
{
    public function geraAleatorio($qtdDezenas = 0)
    {
        if (!$qtdDezenas && isset($this->qtdDezenas))
        {
            $qtdDezenas = $this->qtdDezenas;
        }

        $numeros = [];

        do {
            array_push($numeros,mt_rand(1, $this->maxSorteado));
            $numeros = array_unique($numeros);
        } while (count($numeros) < $qtdDezenas);

        sort($numeros,SORT_NUMERIC);

        return $numeros;

    }
}