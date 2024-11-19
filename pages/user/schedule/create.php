<?php
include "../../../config/connect.php";

$title = "Schedule Class";
$pageHeader = "Schedule Class";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/user.php');

$userID = $_SESSION['user_id'];
$hasTrainerSelected = isset($_GET['select_trainer']) && $_GET['select_trainer'] !== '' ? $_GET['select_trainer'] : '';

$name = "";
$specialty = "";
$experience = "";
$hourly_rate = "";
$day_from = "";
$day_to = "";
$time_from = "";
$time_to = "";
$image = "";

$sql = "SELECT * FROM trainers";

$result = mysqli_query($conn, $sql);

$trainers = [];

if ($result->num_rows > 0) {
  while ($trainer = $result->fetch_assoc()) {
    $trainers[] = $trainer; 
  }
} else {
  echo "No trainees are matched.";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $select_trainer = $_POST['select_trainer'];

  $sql = "SELECT * FROM trainers WHERE trainer_id = $select_trainer";
}
$trainers = mysqli_query($conn,$sql);
$selectedTrainer = mysqli_fetch_assoc($trainers);

$name = $selectedTrainer['name'];
$specialty = $selectedTrainer['specialty'];
$experience = $selectedTrainer['experience'];
$hourly_rate = $selectedTrainer['hourly_rate'];
$day_from = $selectedTrainer['day_from'];
$day_to = $selectedTrainer['day_to'];
$time_from = date('g:i A', strtotime($selectedTrainer['time_from']));
$time_to = date('g:i A', strtotime($selectedTrainer['time_to']));
$image = $selectedTrainer['image'];
?>

<div class="px-52 w-full flex flex-col items-center pb-16">
  <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
          onclick="window.location.href='../schedule.php'"
        >
          Back
        </button>
    </div>

    <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
      <p class="text-3xl text-black font-bold">Class Schedule</p>

      <?php if(empty($hasTrainerSelected)): ?>
        <form action="create.php" class="space-y-6 flex flex-col w-full">
          <div class="space-y-1.5 w-full">
            <p class="text-sm text-black font-medium">Select Trainers</p>

            <div class="flex items-center space-x-2">
              <select 
                name="select_trainer"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="0" selected>Select Trainer</option>
                <?php foreach($trainers as $trainer): ?>
                  <option value="<?php echo $trainer['trainer_id'] ?>"><?php echo $trainer['name'] ?></option>
                <?php endforeach; ?>
              </select>

              <button 
                class="bg-black px-5 py-2.5 rounded-lg text-white font-medium"
                type="submit"
              >
                Search
              </button>
            </div>
          </div>
        </form>
      <?php endif; ?>

      <?php if(!empty($hasTrainerSelected)): ?>
        <form action="../../../controllers/scheduleController.php" method="POST" class="w-full relative space-y-6">
          <input type="hidden" name="trainer_id" value="<?php echo $hasTrainerSelected ?>">
          <input type="hidden" name="user_id" value="<?php echo $userID ?>">

          <div class="space-y-1.5 w-full flex flex-col items-center">
            <?php if(!empty($hasTrainerSelected)): ?>
              <div class="border border-black w-36 h-36 relative flex flex-col items-center justify-center relative overflow-hidden">
                <?php if(!empty($image)): ?>
                  <img src="<?php echo '../../' . $image; ?>" class="w-full h-auto object-cover">
                <?php endif; ?>

                <?php if(empty($image)): ?>
                  <p class="text-base font-medium">N/A</p>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <p class="text-base font-medium">Trainer Profile</p>
          </div>

          <div class="space-y-1.5 w-full">
            <p class="text-base font-medium">Class Name:</p>
            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black placeholder-gray-600"
              placeholder="Name"
            />
          </div>

          <div class="grid grid-cols-2 gap-y-4 items-center w-full">
            <div class="space-y-1.5">
              <p class="text-base font-medium">Trainer:</p>
              <p class="text-base"><?php echo $name ?></p>
            </div>

            <div class="space-y-1.5">
              <p class="text-base font-medium">Specialty:</p>
              <p class="text-base"><?php echo $specialty ?></p>
            </div>

            <div class="space-y-1.5">
              <p class="text-base font-medium">Experience:</p>
              <p class="text-base"><?php echo $experience ?> year/s</p>
            </div>

            <div class="space-y-1.5">
              <p class="text-base font-medium">Rate:</p>
              <p class="text-base">P<?php echo $hourly_rate ?> per hour</p>
            </div>

            <div class="space-y-1.5">
              <p class="text-base font-medium">Scheduled Days:</p>
              <p class="text-base"><?php echo $day_from ?> to <?php echo $day_to ?></p>
            </div>

            <div class="space-y-1.5">
              <p class="text-base font-medium">Scheduled Time:</p>
              <p class="text-base"><?php echo $time_from ?> to <?php echo $time_to ?></p>
            </div>
          </div>

          <button 
            class="bg-black text-white justify-center w-full py-3 text-black font-medium rounded-lg"
            name="create"
          >
            Submit
          </button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>