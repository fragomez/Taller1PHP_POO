<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"),true);
    class Factura{
        public $codigo;
        public $cantidad;

        public function __construct(int $codigo, int $cantidad){
            $this->codigo = $codigo;
            $this->cantidad = $cantidad;
        }

        public function codigos(){

            $codigo = match($this->codigo){
                100 => 20000,
                200 => 60000,
                300 => 10000,
                400 => 5000,
                500 => 30000,
                default => "Error: por favor ingrese un código correcto"
            };
            return $codigo;
        }
        public function pagar():string{
            $codigo = $this->codigos();
            $pagar = (gettype($codigo) == "string") ? $codigo : $codigo * $this->cantidad;
            return $pagar;
        }
    }
    $factura = new Factura(codigo:$_DATA['codigo'],cantidad:$_DATA['cantidad']);
    echo($factura->pagar());
?>