<?php

function formatDateAndTime($value, $format = 'd/m/Y')
{
    return Carbon\Carbon::parse($value)->format($format);
}

/**
 * Função para formatar Telefone, CEP, CPF, CNPJ e RG
 *
 * Escolher tipo de formatação ( fone, cep, cpf, cnpj ou rg) 
 * Lembrar de colocar em lowercase
 * @param $tipo  string
 *   
 * Enviar string que para ser formata ex: 13974208014;
 * @param $string  string   
 *
 * Quantidade de caracteres a serem formatados, 
 * só serve para o telefone 10 para o padrão antigo e 11 para novo padrão com 9
 * @param $size  integer  
 *
 *
 * Valor formatado do padrão escolhido
 * @return $string  string   
 */
function formatString ($tipo = "", $string,  $size = 10)
{
    $string = preg_replace('/[^0-9]/', '', trim($string));
    
    switch ($tipo)
    {
        case 'fone':
            if($size === 10){
             $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) 
             . '-' . substr($string, 6);
         }else
         if($size === 11){
             $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 5) 
             . '-' . substr($string, 7);
         }
         break;
        case 'cep':
            $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
         break;
        case 'cpf':
            $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . 
                '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
         break;
        case 'cnpj':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
                '.' . substr($string, 5, 3) . '/' . 
                substr($string, 8, 4) . '-' . substr($string, 12, 2);
         break;
        default:
         $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
         break;
    }
    return $string;
}

function ageCalculate($data = null)
{
    if(!$data){
        return 100;
    }
    //Data atual
    $day = date('d');
    $month = date('m');
    $year = date('Y');

    //Data de nascimento
    $birth_date = explode('-', $data);
    $day_birth = $birth_date[2];
    $month_birth = $birth_date[1];
    $year_birth = $birth_date[0];

    //Calculando a idade
    $age = $year - $year_birth;
    if($month < $month_birth){
        $age--;
        return $age;
    } else if($month == $month_birth && $day <= $day_birth){
        $age--;
        return $age;
    } else {
        return $age;
    }
}

function checkCPF($cpf = null) 
{
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}