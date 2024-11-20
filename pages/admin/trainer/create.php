<?php
include "../../../config/connect.php";

$title = "Add Trainer";
$pageHeader = "Add Trainer";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/admin.php');

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center">
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
      <p class="text-3xl text-black font-bold">Add Trainer</p>

      <form action="../../../controllers/trainersController.php" method="POST" class="space-y-6 flex flex-col w-full" enctype="multipart/form-data">
        <input 
          name="name"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Trainer Name"
        />

        <input 
          name="age"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Age"
        />

        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="gender"
        >
          <option value="0" selected>Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="others">Others</option>
        </select>

        <input 
          name="address"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Address"
        />

        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="specialty"
        >
          <option value="0" selected>Select Specialty</option>
          <?php foreach($packages as $package): ?>
            <option value="<?php echo $package['name'] ?>"><?php echo $package['name'] ?></option>
          <?php endforeach; ?>  
        </select>

        <input 
          name="contact"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Contact #"
        />

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