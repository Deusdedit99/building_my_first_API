<?php

namespace App;

class Validador
{
    public function limparNumero($numero)
    {
        // Remove qualquer coisa que não seja dígito
        return preg_replace('/\D/', '', $numero);
    }

    public function validarCPF($cpf)
    {
        $cpf = $this->limparNumero($cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function validarCNPJ($cnpj)
    {
        $cnpj = $this->limparNumero($cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        $sum = 0;
        $weight = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $weight[$i];
        }

        $remainder = $sum % 11;
        if ($remainder < 2) {
            $digit1 = 0;
        } else {
            $digit1 = 11 - $remainder;
        }

        $sum = 0;
        $weight = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $weight[$i];
        }

        $remainder = $sum % 11;
        if ($remainder < 2) {
            $digit2 = 0;
        } else {
            $digit2 = 11 - $remainder;
        }

        if ($cnpj[12] == $digit1 && $cnpj[13] == $digit2) {
            return true;
        }

        return false;
    }

    public function validarNumeros($numero)
    {
        $resultados = [];

            $numero = trim($numero, "\"'");
            $numero = $this->limparNumero($numero);

            if (strlen($numero) == 11 && $this->validarCPF($numero)) {
                $resultados[] = ["numero informado" => $numero, "tipo" => "CPF", "valido" => "Sim"];
            } elseif (strlen($numero) == 14 && $this->validarCNPJ($numero)) {
                $resultados[] = ["numero informado" => $numero, "tipo" => "CNPJ", "valido" => "Sim"];
            } else {
                $resultados[] = ["numero" => $numero, "valido" => "Nao"];
            }

        return $resultados;
    }
}

?>
