<?php
$title = "Add Package";
$pageHeader = "Add Package";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/admin.php');
?>

<div class="px-52 w-full flex flex-col items-center">
  <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
        class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
        onclick="window.location.href='../package.php'"
      >
        Back
      </button>
    </div>

    <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
      <p class="text-3xl text-black font-bold">Package</p>

      <form action="../../../controllers/packageController.php" method="POST" class="space-y-6 flex flex-col w-full">
        <input 
          name="name"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Package Name"
        />

        <textarea 
          name="description"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Description"
        ></textarea>

        <input 
          name="hourly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Hourly Rate"
        />

        <input 
          name="daily_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Daily Rate"
        />

        <input 
          name="weekly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Weekly Rate"
        />
        
        <input 
          name="monthly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Monthly Rate"
        />

        <input 
          name="yearly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Yearly Rate"
        />

        <button 
          class="bg-black px-5 py-3 text-black text-base font-medium rounded-lg w-full text-white"
          name="create"
        >
          Create
        </button>
      </form>
    </div>
  </div>
</div>