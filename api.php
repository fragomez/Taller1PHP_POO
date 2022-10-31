<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));
    class Zodiaco{
        public $dia;
        public $mes;
        public $signos;
        public function __construct(int $dia, int $mes){
            $this->dia = $dia;
            $this->mes = $mes;
            $this->signos = (object)[
                "Aries" => [
                    "0" => [18, 4],
                    "1" => [13, 5]
                ],
                "Tauro" => [
                    "0" => [14, 5],
                    "1" => [19, 6]
                ],
                "Gémenis" => [
                    "0" => [20, 6],
                    "1" => [20, 7]
                ],
                "Cáncer" => [
                    "0" => [27, 7],
                    "1" => [9, 8]
                ],
                "Leo" => [
                    "0" => [10, 8],
                    "1" => [15, 9]
                ],
                "Virgo" => [
                    "0" => [16, 9],
                    "1" => [30, 10]
                ],
                "Libra" => [
                    "0" => [31, 10],
                    "1" => [22, 11]
                ],
                "Escorpio" => [
                    "0" => [23, 11],
                    "1" => [29, 11]
                ],
                "Ofiuco" => [
                    "0" => [30, 11],
                    "1" => [17, 12]
                ],
                "Sagitario" => [
                    "0" => [18, 12],
                    "1" => [18, 1]
                ],
                "Capricornio" => [
                    "0" => [19, 1],
                    "1" => [15, 2]
                ],
                "Acuario" => [
                    "0" => [16, 2],
                    "1" => [11, 3]
                ],
                "Piscis" => [
                    "0" => [12, 3],
                    "1" => [17, 4]
                ]
            ];
        }
        public function buscar():string{
            $resultado = "";
            foreach ($this -> signos as $signo => $valor){
                if(($this -> dia == 28 && 3 == $this -> mes) || ($this -> dia == 29 && 3 == $this -> mes)){
                    $resultado = "Cetus";
                } else if (($this -> dia >= $valor[0][0] && $valor [0][1] == $this -> mes) || ($this -> dia <= $valor[1][0] && $valor[1][1] == $this -> mes)){
                    $resultado = $signo;
                }
            }
            return $resultado;
        }
    }
    $zodiaco = new Zodiaco($_DATA -> dia, $_DATA -> mes);
    echo json_encode(["mensaje" => $zodiaco -> buscar()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>