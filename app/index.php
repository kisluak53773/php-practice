<?php

require_once(__DIR__ . '/algorithms/index.php');
require_once(__DIR__ . '/datastructures/index.php');

use Datastructure\Stack;
use Datastructure\Deque;

$stackService = new Stack();
$dequeService = new Deque();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strlen($_POST['text']) > 0) {
        $array = mb_str_split($_POST['text']);
        for($i = 0;$i < sizeof($array);$i++) {
            $stackService->addToStack($array[$i]);
        }
        while($stackService->isStackNotEmpty()) {
            echo $stackService->returnStackData();
        }
    } else {
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
		<form class=" border-2 border-gray-400 rounded-md w-1/3 py-10 flex flex-col items-center justify-center"
			method="POST">
			<label for="text">Введите строку для проверки stack </label><br>
			<input class=" border-2 border-black my-8 outline-none rounded-md" type="text" id="text" name="text"><br>
			<input class=" bg-black text-white rounded-md w-40 hover:bg-gray-400 mt-10 py-2 cursor-pointer"
				type="submit" value="Найти">
		</form>
	</main>
</body>

</html>