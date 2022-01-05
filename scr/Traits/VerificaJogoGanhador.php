<?php

namespace Traits;

trait VerificaJogoGanhador
{
    public function verificaJogoGanhador()
    {
        $countResultado = count($this->resultado) - 1;

        $keyVencedor = [];

        foreach ($this->jogos as $keyJogo => $jogo)
        {
            foreach ($this->resultado as $keyResultado => $numero)
            {
                if (in_array($numero, $jogo)) {
                    if ($keyResultado === $countResultado) {
                        array_push($keyVencedor, $keyJogo+1);
                        $this->vencedor = true;
                    }
                }
                else
                {
                    break;
                }
            }
        }

        $this->keyVencedor = $keyVencedor;
    }
}