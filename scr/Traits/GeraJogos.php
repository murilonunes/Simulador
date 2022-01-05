<?php

namespace Traits;

trait GeraJogos
{
    public function geraJogos($totalJogos = 0)
    {
        if (!$totalJogos && isset($this->totalJogos))
        {
            $totalJogos = $this->totalJogos;
        }

        $jogos = [];

        do {
            array_push($jogos,$this->geraAleatorio());
        } while (count($jogos) < $totalJogos);

        $this->jogos = array_unique($jogos, SORT_REGULAR);

    }
}