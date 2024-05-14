<?php

function bestFit($processes, $spaces) {
    $allocated = array_fill(0, count($processes), -1); // Array para armazenar a posição de alocação dos processos

    for ($i = 0; $i < count($processes); $i++) {
        $bestIndex = -1;
        $bestFitSize = PHP_INT_MAX;

        for ($j = 0; $j < count($spaces); $j++) {
            if ($spaces[$j] >= $processes[$i] && $spaces[$j] < $bestFitSize) {
                $bestFitSize = $spaces[$j];
                $bestIndex = $j;
            }
        }

        if ($bestIndex != -1) {
            $allocated[$i] = $bestIndex;
            $spaces[$bestIndex] -= $processes[$i];
        }
    }

    // Verificando se todos os processos foram alocados
    $allAllocated = true;
    $notAllocated = [];
    foreach ($allocated as $i => $pos) {
        if ($pos == -1) {
            $allAllocated = false;
            $notAllocated[] = $i;
        }
    }

    // Resultado
    $result = [];
    $result['allAllocated'] = $allAllocated ? 'sim' : 'não';
    $result['notAllocated'] = $notAllocated;
    $result['details'] = [];
    foreach ($allocated as $i => $pos) {
        $result['details'][] = [
            'processNumber' => $i,
            'processSize' => $processes[$i],
            'allocatedPosition' => $pos
        ];
    }

    return $result;
}

// Exemplo de uso
$processes = [10, 20, 30, 40, 50];
$spaces = [76, 80, 20, 38, 48];

$result = bestFit($processes, $spaces);

// Saída
echo "Todos os processos foram alocados? " . $result['allAllocated'] . "\n";
if ($result['allAllocated'] == 'não') {
    echo "Processos não alocados: " . implode(', ', $result['notAllocated']) . "\n";
}
foreach ($result['details'] as $detail) {
    echo "Processo " . $detail['processNumber'] . " (Tamanho: " . $detail['processSize'] . ") foi alocado na posição " . $detail['allocatedPosition'] . "\n";
}
?>
