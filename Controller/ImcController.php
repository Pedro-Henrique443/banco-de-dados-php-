<?php

namespace Controller;

use Model\Imcs;

use Exception;

class ImcController
{
    private $imcsModel;

    public function __construct(Imcs $imcsModel)
    {
        $this->imcsModel = new Imcs();
    }

    // Calculo e Classificação
    public function calculateImc()
    {
        try {
            $result = [];
            if (isset($weight) or isset($height)) {
                if ($weight > 0 and $height > 0) {
                    $imc = round($weight / ($height * $height), 2);
                    $result['imc'] = $imc;

                    switch (true){

                    }

                    $result['BMIresult'] = match(true){
                        $imc < 18.5 => 'Baixo peso',
                        $imc >= 18.5 and $imc < 25 => 'Peso normal',
                        $imc >= 25 and $imc < 30 => 'Sobrepeso',
                        $imc >= 30 and $imc < 35 => 'Obesidade grau I',
                        $imc >= 35 and $imc < 40 => 'Obesidade grau II',
                        default => 'Obesidade grau III'
                    };
                } else{
                    $result['BMIrange'] = 'O peso e a altura devem conter valores positivos.';
                }
            } else {
                $result['BMIrange'] = 'Por favor, informe peso e altura para obter o seu IMC.';
            }
            return $result;

        } catch (Exception $error) {
            echo "Erro ao calcular IMC: " . $error->getMessage();
            return false;
        }
    }

    //Salvar IMC na tabela imcs 
    public function saveImc($weight, $height, $IMCresult){
        return $this -> imcsModel ->createImc($weight, $height, $IMCresult);
    }
}






?>