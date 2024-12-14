<!--<link rel="stylesheet" href="../assets/css/card_desafio.css">-->
<?php
// Incluir el archivo con la función
include_once '../Core/functions.php';

$funciones = new Functions();
$Challenges = $funciones->getChallenge();

foreach ($Challenges as $Challenge): 
  
?>



<?php endforeach; ?>

<!--<div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-1 items-center gap-y-1 w-10/12">
    <div id="challenge_info" class="flex flex-col w-5/6" >
        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1">Desafío de Cardio</h4>
        <p id="p" class=" font-bold break-all self-center">Etapa 1/5: Correr</p>
        <p class=" font-bold break-all text-xs">Corre por 20min y sin parar</p>
    </div>
    <div id="image_container" class="flex" >
        <img src="../assets/images/runing.webp" alt="" class="h-44 w-44 rounded-lg">
    </div>
    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
</div> -->
