<?php
function bestFit(array $processes, array $spaces)
{
    // Array para armazenar a posição de alocação dos processos
    $allocated = array_fill(0, count($processes), -1);

    // Itera sobre todos os processos
    for ($i = 0; $i < count($processes); $i++) {
        // Inicializa variáveis para encontrar o melhor ajuste
        $bestIndex = -1;
        $bestFitSize = PHP_INT_MAX;

        // Itera sobre todos os espaços de memória disponíveis
        for ($j = 0; $j < count($spaces); $j++) {
            // Verifica se o espaço atual pode acomodar o processo e é o menor espaço disponível até agora
            if ($spaces[$j] >= $processes[$i] && $spaces[$j] < $bestFitSize) {
                $bestFitSize = $spaces[$j];
                $bestIndex = $j;
            }
        }

        // Se encontrou um espaço adequado, aloca o processo e ajusta o tamanho do espaço restante
        if ($bestIndex != -1) {
            $allocated[$i] = $bestIndex;
            $spaces[$bestIndex] -= $processes[$i];
        }
    }

    // Verificando se todos os processos foram alocados
    $allAllocated = true;
    $notAllocated = [];
    foreach ($allocated as $i => $pos) {
        // Se algum processo não foi alocado, atualiza o flag e armazena o índice do processo
        if ($pos == -1) {
            $allAllocated = false;
            $notAllocated[] = $i;
        }
    }

    // Preparando o resultado para a saída
    $result = [];
    $result['allAllocated'] = $allAllocated ? 'sim' : 'não';
    $result['notAllocated'] = $notAllocated;
    $result['details'] = [];
    foreach ($allocated as $i => $pos) {
        // Prepara os detalhes de alocação de cada processo
        $result['details'][] = [
            'processNumber' => $i,
            'processSize' => $processes[$i],
            'allocatedPosition' => $pos
        ];
    }

    // Imprimindo os resultados da alocação
    echo "\nExecutando a função Best Fit:\n";
    echo "Todos os processos foram alocados? " . $result['allAllocated'] . "\n";
    if ($result['allAllocated'] == 'não') {
        echo "Processos não alocados: " . implode(', ', $result['notAllocated']) . "\n";
    }
    foreach ($result['details'] as $detail) {
        echo "Processo " . $detail['processNumber'] . " (Tamanho: " . $detail['processSize'] . ") foi alocado na posição " . $detail['allocatedPosition'] . "\n";
    };
}

function firstFit(array $processes, array $spaces)
{
    // Array para armazenar a posição de alocação dos processos
    $allocated = array_fill(0, count($processes), -1);

    // Itera sobre todos os processos
    for ($i = 0; $i < count($processes); $i++) {
        // Itera sobre todos os espaços de memória disponíveis
        for ($j = 0; $j < count($spaces); $j++) {
            // Verifica se o espaço atual pode acomodar o processo e se o espaço não foi alocado anteriormente
            if ($spaces[$j] >= $processes[$i] && !in_array($j, $allocated)) {
                // Se encontrou um espaço adequado, aloca o processo e ajusta o tamanho do espaço restante
                $allocated[$i] = $j;
                $spaces[$j] -= $processes[$i];
                break; // Sai do loop após alocar o processo
            }
        }
    }

    // Verificando se todos os processos foram alocados
    $allAllocated = true;
    $notAllocated = [];
    foreach ($allocated as $i => $pos) {
        // Se algum processo não foi alocado, atualiza o flag e armazena o índice do processo
        if ($pos == -1) {
            $allAllocated = false;
            $notAllocated[] = $i;
        }
    }

    // Preparando o resultado para a saída
    $result = [];
    $result['allAllocated'] = $allAllocated ? 'sim' : 'não';
    $result['notAllocated'] = $notAllocated;
    $result['details'] = [];
    foreach ($allocated as $i => $pos) {
        // Prepara os detalhes de alocação de cada processo
        $result['details'][] = [
            'processNumber' => $i,
            'processSize' => $processes[$i],
            'allocatedPosition' => $pos
        ];
    }

    // Imprimindo os resultados da alocação
    echo "\nExecutando a função First Fit:\n";
    echo "Todos os processos foram alocados? " . $result['allAllocated'] . "\n";
    if ($result['allAllocated'] == 'não') {
        echo "Processos não alocados: " . implode(', ', $result['notAllocated']) . "\n";
    }
    foreach ($result['details'] as $detail) {
        echo "Processo " . $detail['processNumber'] . " (Tamanho: " . $detail['processSize'] . ") foi alocado na posição " . $detail['allocatedPosition'] . "\n";
    };
}

function worstFit(array $processes, array $spaces)
{
    // Array para armazenar a posição de alocação dos processos
    $allocated = array_fill(0, count($processes), -1);

    // Itera sobre todos os processos
    for ($i = 0; $i < count($processes); $i++) {
        // Inicializa o índice do maior espaço
        $worstIdx = -1;
        // Itera sobre todos os espaços de memória disponíveis
        for ($j = 0; $j < count($spaces); $j++) {
            // Se o espaço atual pode acomodar o processo e é maior que o espaço atualmente selecionado
            if ($spaces[$j] >= $processes[$i]) {
                if ($worstIdx == -1 || $spaces[$worstIdx] < $spaces[$j]) {
                    $worstIdx = $j;
                }
            }
        }

        // Se encontrou um espaço adequado, aloca o processo e ajusta o tamanho do espaço restante
        if ($worstIdx != -1) {
            $allocated[$i] = $worstIdx;
            $spaces[$worstIdx] -= $processes[$i];
        }
    }

    // Verificando se todos os processos foram alocados
    $allAllocated = true;
    $notAllocated = [];
    foreach ($allocated as $i => $pos) {
        // Se algum processo não foi alocado, atualiza o flag e armazena o índice do processo
        if ($pos == -1) {
            $allAllocated = false;
            $notAllocated[] = $i;
        }
    }

    // Preparando o resultado para a saída
    $result = [];
    $result['allAllocated'] = $allAllocated ? 'sim' : 'não';
    $result['notAllocated'] = $notAllocated;
    $result['details'] = [];
    foreach ($allocated as $i => $pos) {
        // Prepara os detalhes de alocação de cada processo
        $result['details'][] = [
            'processNumber' => $i,
            'processSize' => $processes[$i],
            'allocatedPosition' => $pos
        ];
    }

    // Imprimindo os resultados da alocação
    echo "\nExecutando a função Worst Fit:\n";
    echo "Todos os processos foram alocados? " . $result['allAllocated'] . "\n";
    if ($result['allAllocated'] == 'não') {
        echo "Processos não alocados: " . implode(', ', $result['notAllocated']) . "\n";
    }
    foreach ($result['details'] as $detail) {
        echo "Processo " . $detail['processNumber'] . " (Tamanho: " . $detail['processSize'] . ") foi alocado na posição " . $detail['allocatedPosition'] . "\n";
    };
}

function nextFit(array $processes, array $spaces)
{
    // Array para armazenar a posição de alocação dos processos
    $allocated = array_fill(0, count($processes), -1);

    // Inicializa o índice do último espaço alocado
    $lastIdx = 0;

    // Itera sobre todos os processos
    for ($i = 0; $i < count($processes); $i++) {
        // Começa a partir do último espaço alocado
        for ($j = $lastIdx; $j < count($spaces) + $lastIdx; $j++) {
            $idx = $j % count($spaces);
            // Se o espaço atual pode acomodar o processo
            if ($spaces[$idx] >= $processes[$i]) {
                // Aloca o processo e ajusta o tamanho do espaço restante
                $allocated[$i] = $idx;
                $spaces[$idx] -= $processes[$i];
                $lastIdx = $idx;
                break;
            }
        }
    }

    // Verificando se todos os processos foram alocados
    $allAllocated = true;
    $notAllocated = [];
    foreach ($allocated as $i => $pos) {
        // Se algum processo não foi alocado, atualiza o flag e armazena o índice do processo
        if ($pos == -1) {
            $allAllocated = false;
            $notAllocated[] = $i;
        }
    }

    // Preparando o resultado para a saída
    $result = [];
    $result['allAllocated'] = $allAllocated ? 'sim' : 'não';
    $result['notAllocated'] = $notAllocated;
    $result['details'] = [];
    foreach ($allocated as $i => $pos) {
        // Prepara os detalhes de alocação de cada processo
        $result['details'][] = [
            'processNumber' => $i,
            'processSize' => $processes[$i],
            'allocatedPosition' => $pos
        ];
    }

    // Imprimindo os resultados da alocação
    echo "\nExecutando a função Next Fit:\n";
    echo "Todos os processos foram alocados? " . $result['allAllocated'] . "\n";
    if ($result['allAllocated'] == 'não') {
        echo "Processos não alocados: " . implode(', ', $result['notAllocated']) . "\n";
    }
    foreach ($result['details'] as $detail) {
        echo "Processo " . $detail['processNumber'] . " (Tamanho: " . $detail['processSize'] . ") foi alocado na posição " . $detail['allocatedPosition'] . "\n";
    };
}


$processes = [10, 20, 30, 40, 50];
$spaces = [76, 80, 20, 38, 48];
bestFit($processes, $spaces);


$processesFirst = [10, 20, 30, 40, 50];
$spacesFirst = [60, 50, 40, 30, 20];
firstFit($processesFirst, $spacesFirst);


$processesWorst = [10, 20, 30, 40, 50];
$spacesWorst = [70, 30, 10, 35, 20];
WorstFit($processesWorst, $spacesWorst);

$processesNext = [10, 20, 30, 40, 50];
$spacesNext = [70, 30, 10, 35, 20];
nextFit($processesNext, $spacesNext);