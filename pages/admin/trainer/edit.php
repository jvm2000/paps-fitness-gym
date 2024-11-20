<?php
include "../../../config/connect.php";

$title = "Edit Trainer";
$pageHeader = "Edit Trainer";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

$trainer_id = $_GET['trainer_id'];

$sql = "SELECT * FROM trainers WHERE trainer_id = $trainer_id";
$trainers = mysqli_query($conn,$sql);
$trainer = mysqli_fetch_assoc($trainers);

$name = $trainer['name'];
$age = $trainer['age'];
$gender = $trainer['gender'];
$address = $trainer['address'];
$contact = $trainer['contact'];
$specialty = $trainer['specialty'];
$image = $trainer['image'];

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
      <p class="text-3xl text-black font-bold">Equipment</p>

      <form action="../../../controllers/trainersController.php" method="POST" class="space-y-6 flex flex-col w-full" enctype="multipart/form-data">
        <input type="hidden" name="trainer_id" value="<?php echo $trainer_id ?>">

        <input 
          name="name"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Trainer Name"
          value="<?php echo $name ?>"
        />

        <input 
          name="age"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Age"
          value="<?php echo $age ?>"
        />

        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="gender"
        >
          <option value="0" selected>Select Gender</option>
          <option value="male" <?php echo $gender === 'male' ? 'selected' : ''; ?>>Male</option>
          <option value="female" <?php echo $gender === 'female' ? 'selected' : ''; ?>>Female</option>
          <option value="others" <?php echo $gender === 'others' ? 'selected' : ''; ?>>Others</option>
        </select>

        <input 
          name="address"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Address"
          value="<?php echo $address ?>"
        />

        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="specialty"
        >
          <option value="0" selected>Select Specialty</option>
          <?php foreach($packages as $package): ?>
            <option 
              value="<?php echo $package['name'] ?>"
              <?php echo $package['name'] === $specialty ? 'selected' : ''; ?>
            ><?php echo $package['name'] ?></option>
          <?php endforeach; ?>  
        </select>

        <input 
          name="contact"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Contact #"
          value="<?php echo $contact ?>"
        />

        <div 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white min-h-24 max-h-full flex items-center justify-center" 
          id="uploadButton"
        >
          <p>Image</p>
          <img 
            src="<?php echo '../../' . $image; ?>"
            class="w-full object-cover h-64" \
          />
          <input type="file" id="fileInput" name="image" style="display: none;" />
        </div>

        <button 
          class="bg-black px-5 py-3 text-black text-base font-medium rounded-lg w-full text-white"
          name="update"
        >
          Update
        </button>
      </form>
    </div>
  </div>
</div>