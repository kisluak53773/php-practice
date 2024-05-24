<?php

require_once(__DIR__ . '/algorithms/index.php');

use Algorithms\SearchAlgorithms;
use Algorithms\SortAlgorithms;

$searchService = new SearchAlgorithms;
$sortService = new SortAlgorithms;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strlen($_POST['numbers'])>0 && strlen($_POST['goal'])>0) {
        $numbers = explode(",", $_POST['numbers']);
        $goal = $_POST['goal'];
        switch($_POST['search']){
            case 'linear':
                $index = $searchService->linearSearch($numbers,$goal);
                echo "Найдено с помощью линейного поиска: " . $index;
                break;
            case 'binary':
                $array = $sortService->quickSort($numbers);
                $index = $searchService->binarySearch($array,$goal,0,sizeof($array));
                echo "Найдено с помощью бинарного поиска: " . $index;
                break;
        }
    }else{
        echo 'Вы должны ввести числа и цель поиска';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Алгоритмы и структуры данных</title>
</head>
<body>
<main class=" w-full h-dvh flex items-center justify-center">
    <form class=" border-2 border-gray-400 rounded-md w-1/3 py-10 flex flex-col items-center justify-center" method="POST">
        <label for="numbers">Введите числа разделенные запятой в порядке возростания</label><br>
        <input class=" border-2 border-black my-8 outline-none rounded-md" type="text" id="numbers" name="numbers"><br>
        <label for="goal">Введите цель поиска</label><br>
        <input class=" border-2 border-black my-8 outline-none rounded-md" type="text" id="goal" name="goal"><br>
        <div class=" flex items-center justify-center">
            <div class=" mx-2">
                <input type="radio" class="cursor-pointer" id="linear" name="search" value="linear" checked />
                <label for="linear">Линейный поиск</label>
            </div>
            <div class=" mx-2">
                <input type="radio" class="cursor-pointer" id="binary" name="search" value="binary" checked />
                <label for="binary">Бинарный поиск</label>
            </div>
        </div>
        <input class=" bg-black text-white rounded-md w-40 hover:bg-gray-400 mt-10 py-2 cursor-pointer" type="submit" value="Найти">
    </form>
</main>
</body>
</html>