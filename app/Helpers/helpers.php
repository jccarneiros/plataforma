<?php

function dateBackup($date)
{
    $vart = explode('-', $date['filename']);

    return $vart[2] . '/' . $vart[1] . '/' . $vart[0] . ' ' . $vart[3] . ':' . $vart[4] . ':' . $vart[5];
}

function dateParse($date)
{
    return explode('/', $date);
}

// Função insere somente a primeira palavra da string com a primeira letra em maiúscula
function titleCase($string)
{
    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    $new_string = '';
    foreach ($sentences as $key => $sentence) {
        $new_string .= ($key & 1) == 0 ?
            ucfirst(mb_strtolower(trim($sentence))) :
            $sentence . ' ';
    }

    return trim($new_string);
}

// Função retorna a primeira palavra da string
function firstName($str)
{
    $string = explode(' ', $str);
    $firstName = $string[0];

    return $firstName;
}

// Função retorna a primeira palavra da string
function middleName($str, $exceptions = [' ','da', 'de', 'do', 'das', 'dos'])
{
    $string = explode(' ', $str);
    $middleName = $string[1];

    return $middleName;

}

// Função retorna a última palavra da string
function lastName($str)
{
    $string = explode(' ', $str);
    $lastName = end($string);

    return $lastName;


}

// Função converte a string para a primeira letra em maiúscula
function nameCase(
    $string,
    $delimiters = [' ', '-', '.', "'", "O'", 'Mc'],
    $exceptions = ['e', 'de', 'da', 'dos', 'das', 'do', 'I', 'II', 'III', 'IV', 'V', 'VI']
)
{
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = [];
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, 'UTF-8'), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, 'UTF-8');
            } elseif (in_array(mb_strtolower($word, 'UTF-8'), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, 'UTF-8');
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = implode($delimiter, $newwords);
    }//foreach

    return $string;
}

// Função converte a string para a primeira letra em maiúscula
function contentCase(
    $string,
    $delimiters = [' ', '-', '.', "'", "O'", 'Mc'],
    $exceptions = ['de', 'da', 'dos', 'das', 'do', 'I', 'II', 'III', 'IV', 'V', 'VI']
)
{
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = [];
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, 'UTF-8'), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, 'UTF-8');
            } elseif (in_array(mb_strtolower($word, 'UTF-8'), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, 'UTF-8');
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = implode($delimiter, $newwords);
    }//foreach

    return $string;
}

function intervaloEntreDatas($data_inicial,$data_final) {
    $diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24));
    return $dias;
}
