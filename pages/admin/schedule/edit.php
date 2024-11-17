<?php
include "../../../config/connect.php";

$title = "Edit Schedule";
$pageHeader = "Edit Schedule";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

$schedule_id = $_GET['schedule_id'];

$sql = "SELECT trainers.*, trainers.name AS trainer_name, users.*, schedules.* 
        FROM schedules 
        LEFT JOIN trainers ON trainers.trainer_id = schedules.trainer_id 
        LEFT JOIN users ON users.user_id = schedules.user_id WHERE schedule_id = $schedule_id
      ";

$schedules = mysqli_query($conn,$sql);
$schedule = mysqli_fetch_assoc($schedules);

$trainer_name = $schedule['trainer_name'];
$status = $schedule['status'];
$name = $schedule['name'];
$specialty = $schedule['specialty'];
$assigned_to = $schedule['firstname'] . ' ' . $schedule['lastname'];
$hourly_rate = $schedule['hourly_rate'];
$day_from = $schedule['day_from'];
$day_to = $schedule['day_to'];
$time_from = $schedule['time_from'];
$time_to = $schedule['time_to'];
?>

<div class="px-52 w-full flex flex-col items-center pb-16">
  <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
          onclick="window.location.href='../schedules.php'"
        >
          Back
        </button>
    </div>

    <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
      <p class="text-3xl text-black font-bold">Edit <?php echo $name ?></p>

      <form action="../../../controllers/scheduleController.php" method="POST" class="w-full relative space-y-6">
        <input type="hidden" name="schedule_id" value="<?php echo $schedule_id ?>">

        <div class="grid grid-cols-2 gap-y-4 items-center w-full">
          <div class="space-y-1.5">
            <p class="text-base font-medium">Appointed by:</p>
            <p class="text-base"><?php echo $assigned_to ?></p>
          </div>

          <div class="space-y-1.5">
            <p class="text-base font-medium">Trainer:</p>
            <p class="text-base"><?php echo $trainer_name ?></p>
          </div>

          <div class="space-y-1.5">
            <p class="text-base font-medium">Specialty:</p>
            <p class="text-base"><?php echo $specialty ?></p>
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

        <select 
          name="status"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        >
          <option value="pending" <?php echo $status === 'pending' ? 'selected' : ''; ?>>Pending</option>
          <option value="active" <?php echo $status === 'active' ? 'selected' : ''; ?>>Accept</option>
        </select>

        <button 
          class="bg-black text-white justify-center w-full py-3 text-black font-medium rounded-lg"
          name="update"
        >
          Update
        </button>
      </form>
    </div>
  </div>
</div>