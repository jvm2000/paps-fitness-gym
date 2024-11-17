<?php
include "../../../config/connect.php";

$title = "Edit Package";
$pageHeader = "Edit Package";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

$package_id = $_GET['package_id'];

$sql = "SELECT * FROM packages WHERE package_id = $package_id";
$packages = mysqli_query($conn,$sql);
$package = mysqli_fetch_assoc($packages);

$name = $package['name'];
$description = $package['description'];
$daily_rate = $package['daily_rate'];
$monthly_rate = $package['monthly_rate'];
$weekly_rate = $package['weekly_rate'];
$yearly_rate = $package['yearly_rate'];
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
      <p class="text-3xl text-black font-bold">Edit Package</p>

      <form action="../../../controllers/packageController.php" method="POST" class="space-y-6 flex flex-col w-full">
        <input type="hidden" name="package_id" value="<?php echo $package_id ?>">
        <input 
          name="name"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Package Name"
          value="<?php echo $name ?>"
        />

        <textarea 
          name="description"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Description"
        ><?php echo $description ?></textarea>

        <input 
          name="daily_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Daily Rate"
          value="<?php echo $daily_rate ?>"
        />

        <input 
          name="monthly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Monthly Rate"
          value="<?php echo $monthly_rate ?>"
        />

        <input 
          name="weekly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Weekly Rate"
          value="<?php echo $weekly_rate ?>"
        />

        <input 
          name="yearly_rate"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
          placeholder="Yearly Rate"
          value="<?php echo $yearly_rate ?>"
        />

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

<script>
  const selectType = document.getElementById('select-type');
  const inputContainer = document.getElementById('input-container');

  function updateInputField() {
    const selectedValue = selectType.value;
    let placeholderText = '';
    let inputName = '';

    if (selectedValue === 'daily') {
      placeholderText = 'Daily Rate';
      inputName = 'daily_rate';
    } else if (selectedValue === 'monthly') {
      placeholderText = 'Monthly Rate';
      inputName = 'monthly_rate';
    } else if (selectedValue === 'hourly') {
      placeholderText = 'Hourly Rate';
      inputName = 'hourly_rate';
    }

    const newInput = document.createElement('input');
    newInput.className = 'w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-yellow-300';
    newInput.placeholder = placeholderText;
    newInput.name = inputName;
    newInput.value = <?php echo $rate ?>;

    inputContainer.innerHTML = '';
    inputContainer.appendChild(newInput);
  }

  updateInputField();

  selectType.addEventListener('change', updateInputField);
</script>