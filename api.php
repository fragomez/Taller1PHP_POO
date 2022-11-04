<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
$_DATA = json_decode(file_get_contents("php://input"), true);
class Promedio
{
    public $sumaA;
    public $cantidadA;
    public $sumaB;
    public $cantidadB;
    public $sumaC;
    public $cantidadC;

    public function __construct(int $sumaA, int $cantidadA, int $sumaB, int $cantidadB, int $sumaC, int $cantidadC)
    {
        $this->sumaA = $sumaA;
        $this->cantidadA = $cantidadA;
        $this->sumaB = $sumaB;
        $this->cantidadB = $cantidadB;
        $this->sumaC = $sumaC;
        $this->cantidadC = $cantidadC;
    }

    public function promedioFinal(): string
    {

        $sumaA = $this->sumaA;
        $cantidadA = $this->cantidadA;
        $sumaB = $this->sumaB;
        $cantidadB = $this->cantidadB;
        $sumaC = $this->sumaC;
        $cantidadC = $this->cantidadC;

        $cantidadA < 1 ? $promedioA = 0 : $promedioA = $sumaA / $cantidadA;
        $cantidadB < 1 ? $promedioB = 0 : $promedioB = $sumaB / $cantidadB;
        $cantidadC < 1 ? $promedioC = 0 : $promedioC = $sumaC / $cantidadC;

        if ($promedioA > $promedioB && $promedioA > $promedioC) {
            if ($promedioB > $promedioC) {
                return "C";
            } else {
                return "B";
            }
        } else if ($promedioB > $promedioA && $promedioB > $promedioC) {
            if ($promedioA > $promedioC) {
                return "C";
            } else {
                return "A";
            }
        } else if ($promedioC > $promedioA && $promedioC > $promedioB) {
            if ($promedioA > $promedioB) {
                return "B";
            } else {
                return "A";
            }
        } else {
            return "A, B, C";
        }
    }
}

$promedio = new Promedio(sumaA: $_DATA[0], cantidadA: $_DATA[1], sumaB: $_DATA[2], cantidadB: $_DATA[3], sumaC: $_DATA[4], cantidadC: $_DATA[5]);
echo ($promedio->promedioFinal());
?>