<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-fluid">
            <h2>Simulador para gerar jogos e resultado do sorteio</h2>
            <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="card">
                    <div class="card-header">
                        Preencha os campos
                    </div>
                    <div class="card-body">
                        Quantidade Dezenas: <input type="number" required="required" name="qdezenas"><br/><br/>
                        Quantidade Jogos: <input type="number" required="required" name="qjogos"><br/><br/>
                        <input type="submit">
                    </div>
                </div>
            </form>
            <br/>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('vendor/autoload.php');

    use Classes\Geral;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $qDezenas = $_POST['qdezenas'];
        $qJogos = $_POST['qjogos'];

        $controle = true;
        $texto = '';

        if (($qDezenas < 6 || $qDezenas > 10 || !is_numeric($qDezenas))) {
            $texto = 'Erro! Somente é aceito o valor de dezenas: 6, 7, 8, 9, 10<br/>';
            $controle = false;
        }
        if ($qJogos < 1 || !is_numeric($qJogos)) {
            $texto .= 'Erro! Quantidade de jogos deve ser um número maior que 0<br/>';
            $controle = false;
        }

        if ($controle) {
            echo '<h5>Segue o resultado:</h5><br/>';
            $geral = new Geral($qDezenas, $qJogos);
            $geral->handle();

            if ($geral->vencedor) {
                echo "<h3> <span class='badge bg-success'>Ganhou!!!!!!!!!</span></h3><br/>";
                echo "<h3>Jogo(s) vencedor(es): <br/>". implode(', ', $geral->keyVencedor)."</h3>" ;
            }
            else {
                echo "<h3><span class='badge bg-danger'> Não foi dessa vez, você não ganhou.</span></h3>";
            }

            echo "<br/> <h3>Resultado:<br/>";
            echo implode(', ', $geral->resultado);
            echo "</h3><br/>";
            echo "<br/><h3>Jogos: </h3><br/>";
            ?>

            <table class="table">
                <thead>
                <tr>
                    <th> # </th>
                    <?php
                        $i = 0;
                        do {
                            $i++;
                    ?>
                            <th><?php echo $i; ?>º</th>
                    <?php
                        } while ($i < $qDezenas);
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($geral->jogos as $key => $jogo):
                ?>
                    <tr class="item_row">
                        <td><?php echo $key+1; ?></td>
                        <?php foreach ($jogo as $numero) :?>
                        <td> <?php echo $numero; ?></td>
                        <?php endforeach;?>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>


        <?php
//            var_dump($geral->jogos);

        }
        else
        {
        ?>

            <div class="card">
                <div class="card-header bg-danger text-white">
                    Erro no preenchimento
                </div>
                <div class="card-body">
                    <?php
                        echo $texto;
                    ?>
                </div>
            </div>

        <?php
        }

    }

    ?>
        </div>
    </body>
</html>








