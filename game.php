<div id="tablero" style= "line-height: 0.6; font-size: 30px">
<?php
header('Content-Type: text/html; charset=UTF-8');
Class GameOfLife
{
    var $matriz;
    var $counter = 0;
    public function crearTablero()
    {
        for ($i = 0; $i <= 4; $i++) {
            for ($j = 0; $j <= 4; $j++) {
                $this->matriz[$i][$j] = "□";
            }
        }
    }
    
    public function crearVida()
    {
        for ($i = 0; $i <= 4; $i++) {
            $x = rand(0, 4);
            $y = rand(0, 4);
            while ($this->matriz[$x][$y] == "■") {
                $x = rand(0, 4);
                $y = rand(0, 4);
            }
            $this->matriz[$x][$y] = "■";
        }
    }
    
    public function imprimir()
    {
?>
       <script languaje="javascript">document.getElementById("tablero").innerHTML="";</script>
        <?php
        for ($i = 0; $i <= 4; $i++) {
            for ($j = 0; $j <= 4; $j++) {
                echo $this->matriz[$i][$j];
            }
            echo "<br/>";
        }
    }
    
    public function vecinos()
    {
        for ($i = 0; $i <= 4; $i++) {
            for ($j = 0; $j <= 4; $j++) {
                for ($x = -1; $x <= 1; $x++) {
                    for ($y = -1; $y <= 1; $y++) {
                    	//esta funcion se encarga de contar cuantos vecinos en negro tiene
                    	//tambien evita evaluar espacios inexistentes en caso de evaluar celdas de los bordes
                        if (isset($this->matriz[$i + $x][$j + $y]) && $this->matriz[$i + $x][$j + $y] == "■") {
                            $this->counter += 1;
                        }
                    }
                }
                
                //esta seccion necesita saber cuantos vecinos encontro para hacer la evaluacion
                if ($this->counter <= 2 && $this->matriz[$i][$j] == "■") {
                    $this->matriz[$i][$j] = "□";
                } elseif ($this->counter >= 4 && $this->matriz[$i][$j] == "■") {
                    $this->matriz[$i][$j] = "□";
                } elseif ($this->counter == 3 && $this->matriz[$i][$j] == "■") {
                    $this->matriz[$i][$j] = "■";
                } elseif ($this->counter == 3 && $this->matriz[$i][$j] == "□") {
                    $this->matriz[$i][$j] = "■";
                } else if ($this->matriz[$i][$j] == "□") {
                    $this->matriz[$i][$j] = "□";
                }
                $this->counter = 0;
            }
        }
        $this->pausing();
        $this->imprimir();
    }
    
    public function pausing()
    {
        ob_flush();
        flush();
        sleep(1);
    }
}

$start = new GameOfLife;
$start->crearTablero();
$start->crearVida();
$start->imprimir();
for ($i = 0; $i = 10; $i++) {
    $start->vecinos();
}

?>
</div>