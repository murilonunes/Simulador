<?php
namespace Traits;

//use Exception;

trait DadosValidos
{
    public function dadosValidos($atributo, $valor)
    {
        if (key_exists($atributo, $this->atributosProtegidos)) {
            if(array_search($valor, $this->atributosProtegidos[$atributo]) >= 0) {
                //echo 'permitido';
                return true;
            } else
            {
                //echo 'Valor não permitido';
                return false;
            }
        }
        else
        {
            //echo "passou";
            return true;
        }
    }

}