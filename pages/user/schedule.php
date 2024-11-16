<?php
$title = "Schedules";
$pageHeader = "Schedules";
$childView = __DIR__ . '/schedule.php';

include('../../layouts/user.php');
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-4xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
          onclick="window.location.href='schedule/create.php'"
        >
          Schedule an Apppointment
        </button>
    </div>
  </div>
</div>