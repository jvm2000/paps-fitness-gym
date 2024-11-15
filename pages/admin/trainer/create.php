<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Create Trainer</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">CREATE TRAINER</p>

      <button 
        class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-sm"
        onclick="window.location.href='../../controllers/logoutController.php'"
      >
        Logout
      </button>
    </header>

    <div class="px-52 w-full">
      <div class="grid grid-cols-7 gap-x-10">
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='home.php'"
        >
          Home Page
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='membership.php'"
        >
          Membership Management
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='equipment.php'"
        >
          Manage Equipment
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='package.php'"
        >
          Manage Packages
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='pricing.php'"
        >
          Manage Pricing
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='trainers.php'"
        >
          Manage Trainers
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='billing.php'"
        >
          Manage Billing
        </button>
      </div>
    </div>

    <div class="px-52 w-full flex flex-col items-center py-16">
      <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='../trainers.php'"
          >
            Back
          </button>
        </div>

        <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
          <p class="text-3xl text-black font-bold">Equipment</p>

          <form action="../../../controllers/trainersController.php" method="POST" class="space-y-6 flex flex-col w-full" enctype="multipart/form-data">
            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Trainer Name"
            />

            <input 
              name="specialty"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Specialty"
            />

            <input 
              type="number"
              name="experience"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Experience"
            />

            <input 
              type="number"
              name="hourly_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Hourly Rate"
            />

            <div class="relative grid grid-cols-2 items-center gap-x-1">
              <select 
                name="day_from"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
              </select>

              <select 
                name="day_to"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
                <option value="sunday" selected>Sunday</option>
              </select>
            </div>

            <div class="relative grid grid-cols-2 items-center gap-x-1">
              <div class="relative flex items-center">
                <input 
                  type="time"
                  name="time_from"
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-6 rounded-md text-black bg-black text-white"
                />
                <p class="absolute left-4 text-white">F:</p>
              </div>

              <div class="relative flex items-center">
                <input 
                  type="time"
                  name="time_to"
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-6 rounded-md text-black bg-black text-white"
                />
                <p class="absolute left-4 text-white">T:</p>
              </div>
            </div>

            <div 
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white min-h-24 max-h-full flex items-center justify-center" 
              id="uploadButton"
            >
              <p>Upload Image</p>
              <img id="previewImage" src="" alt="Image Preview" style="display: none;" class="w-full object-cover h-64" />
              <input type="file" id="fileInput" name="image" style="display: none;" />
            </div>

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
  </body>
</html>


<script>
  document.getElementById('uploadButton').addEventListener('click', function () {
    document.getElementById('fileInput').click();
  });

  document.getElementById('fileInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const previewImage = document.getElementById('previewImage');
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      alert('Please select an image file.');
    }
  });
</script>