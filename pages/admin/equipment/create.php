<?php
$title = "Add Equipment";
$pageHeader = "Add Equipment";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/admin.php');
?>

<div class="px-52 w-full flex flex-col items-center">
  <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
        class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
        onclick="window.location.href='../equipment.php'"
      >
        Back
      </button>
    </div>

    <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
      <p class="text-3xl text-black font-bold">Equipment</p>

      <form action="../../../controllers/equipmentController.php" method="POST" class="space-y-6 flex flex-col w-full" enctype="multipart/form-data">
        <input 
          name="name"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Equipment Name"
        />

        <input 
          name="type"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Type"
        />

        <input 
          type="number"
          name="quantity"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Stock"
        />

        <select 
          name="equipment_condition"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        >
          <option value="poor">Poor</option>
          <option value="good">Good</option>
          <option value="fair">Fair</option>
          <option value="excellent" selected>Excellent</option>
        </select>

        <div class="relative flex items-center">
          <input 
            type="date"
            name="last_maintenance"
            class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-20 rounded-md bg-black text-white"
          />
          <p class="absolute left-4 text-white">Last Maintenance:</p>
        </div>

        <div class="relative flex items-center">
          <input 
            type="date"
            name="due_maintenance"
            class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-20 rounded-md text-black bg-black text-white"
          />
          <p class="absolute left-4 text-white">Due Maintenance</p>
        </div>

        <select 
          name="status"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        >
          <option value="active">Active</option>
          <option value="maintenance">Maintenance</option>
        </select>

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
