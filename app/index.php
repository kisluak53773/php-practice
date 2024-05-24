<?php

class SortAlgorithms
{
    public function bubbleSort($array)
    {
        if(sizeof($array) <=0){
            return $array;
        };

        $toSort = true;

        do {
            $toSort = false;

            for ($i = 0; $i < sizeof($array); $i++) {
                if ($i + 1 < sizeof($array) && $array[$i] > $array[$i + 1]) {
                    $toSort = true;
                    $currElem = $array[$i];
                    $array[$i] = $array[$i + 1];
                    $array[$i + 1] = $currElem;
                }
            }
        } while ($toSort);

        return $array;
    }

    public function mergeSort($array)
    {
        if(sizeof($array) <= 1){
            return $array;
        };

        $mid = ceil(sizeof($array)/2);
        
        return $this->merge($this->mergeSort(array_slice($array, 0, $mid)),$this->mergeSort(array_slice($array, $mid)));
    }

    public function quickSort($array)
    {
        $length = count($array);
    
        if ($length <= 1) {
            return $array;
        }
        
        $pivot = $array[0];
        $left = $right = [];

        for ($i = 1; $i < $length; $i++) {
            if ($array[$i] < $pivot) {
                $left[] = $array[$i];
            } else {
                $right[] = $array[$i];
            }
        }
        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    private function merge($left,$right){
        $finalArray = [];

        while(sizeof($left) > 0 && sizeof($right)>0){
            if($left[0]<$right[0]){
                array_push($finalArray, $left[0]);
                array_shift($left);
            }else{
                array_push($finalArray, $right[0]);
                array_shift($right);
            }
        }

        $finalArray = array_merge($finalArray, $left, $right);
        
        return $finalArray;
    }
}

$sortService = new SortAlgorithms();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numbers']) && strlen($_POST['numbers'])>0) {
        $numbers = explode(",", $_POST['numbers']);
        switch($_POST['sort']){
            case 'buble':
                $sortedNumbers = $sortService->bubbleSort($numbers);
                echo "Отсортированный масив путем сортировки пузырьком: " . implode(", ", $sortedNumbers);
                break;
            case 'merge':
                $sortedNumbers = $sortService->mergeSort($numbers);
                echo "Отсортированный масив путем сортировки слиянием " . implode(", ", $sortedNumbers);
                break;
            case 'quick':
                $sortedNumbers = $sortService->quickSort($numbers);
                echo "Отсортированный масив путем , быстрой сортировки: " . implode(", ", $sortedNumbers);
                break;
        }
    }else{
        echo 'Вы должны ввести числа';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Виды сортировки</title>
</head>
<body>
<main class=" w-full h-dvh flex items-center justify-center">
    <form class=" border-2 border-gray-400 rounded-md w-1/3 py-10 flex flex-col items-center justify-center" method="POST">
        <label for="numbers">Введите числа разделенные запятой</label><br>
        <input class=" border-2 border-black my-8 outline-none rounded-md" type="text" id="numbers" name="numbers"><br>
        <div class=" flex items-center justify-center">
            <div class=" mx-2">
                <input type="radio" class="cursor-pointer" id="buble" name="sort" value="buble" checked />
                <label for="buble">Сортировка пузырьком</label>
            </div>
            <div class=" mx-2">
                <input type="radio" class="cursor-pointer" id="merge" name="sort" value="merge" checked />
                <label for="merge">Сортировка слиянием</label>
            </div>
            <div class=" mx-2">
                <input type="radio" class="cursor-pointer" id="quick" name="sort" value="quick" checked />
                <label for="quick">Быстрая сортировка</label>
            </div>
        </div>
        <input class=" bg-black text-white rounded-md w-40 hover:bg-gray-400 mt-10 py-2 cursor-pointer" type="submit" value="Отсортировать">
    </form>
</main>
</body>
</html>