<?php

namespace App\Controller;

use App\Validador;

class ValidatorController
{
    public function validate()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $number = $data['numero'];
        //var_dump($number);

        if ($number) {
            $validador = new Validador();
            $resultados = $validador->validarNumeros($number);

            echo json_encode(["status" => "Success", "resultados" => $resultados]);
        } else {
            echo json_encode(["status" => "Error", "message" => "Numeros nao fornecidos"]);
        }
    }
}
