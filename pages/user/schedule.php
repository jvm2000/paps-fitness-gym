<?php
include "../../config/connect.php";

$title = "Schedules";
$pageHeader = "Schedules";
$childView = __DIR__ . '/schedule.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$sql = "SELECT 
  schedules.schedule_id AS schedule_id, 
  schedules.name AS schedule_name, 
  schedules.status AS schedule_status, 
  trainers.* FROM schedules 
  LEFT JOIN trainers ON trainers.trainer_id = schedules.trainer_id 
  WHERE user_id = $userID";

$result = mysqli_query($conn, $sql);

$schedules = [];

if ($result->num_rows > 0) {
  while ($schedule = $result->fetch_assoc()) {
    $schedules[] = $schedule; 
  }
}

$membershipCount = 0;
$sql = "SELECT COUNT(*) AS total FROM memberships WHERE user_id = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $membershipCount = $row['total'];
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <?php if($membershipCount < 1): ?>
    <div class="max-w-lg w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
      <p class="text-4xl font-semibold">Notice</p>

      <div class="p-4 bg-black rounded-lg">
        <p class="text-base text-white">
          Accessing this feature is exclusive to our valued members. Apply for membership today to enjoy full access and take advantage of all the benefits we offer!
        </p>
      </div>

      <button 
        class="bg-black px-5 py-4 text-xl text-white w-full font-medium rounded-lg"
        onclick="window.location.href='membership.php'"
      >
        Join Now
      </button>
    </div>
  <?php endif; ?>

  <?php if($membershipCount > 0): ?>
    <div class="max-w-4xl w-full flex flex-col space-y-8 items-start">
      <div class="flex justify-end w-full">
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
          onclick="window.location.href='schedule/create.php'"
        >
          Schedule an Apppointment
        </button>
      </div>

      <div class="flex flex-col items-center space-y-6 w-full">
        <?php foreach ($schedules as $schedule): ?>
          <div class="max-w-xl w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
            <div class="flex items-center space-x-4 w-full">
            <div class="border border-black w-36 h-36 relative flex flex-col items-center justify-center relative overflow-hidden">
                <?php if(!empty($schedule['image'])): ?>
                  <img src="<?php echo '../' . $schedule['image']; ?>" class="w-full h-auto object-cover">
                <?php endif; ?>

                <?php if(empty($schedule['image'])): ?>
                  <p class="text-base font-medium">N/A</p>
                <?php endif; ?>
              </div>

              <div class="space-y-1.5">
                <p class="text-2xl font-semibold">Schedule - <?php echo $schedule['schedule_name'] ?></p>
                <p class="text-xl font-medium"><?php echo $schedule['schedule_status'] ?></p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-y-4 items-center w-full">
              <div class="space-y-1.5">
                <p class="text-base font-medium">Trainer:</p>
                <p class="text-base"><?php echo $schedule['name'] ?></p>
              </div>

              <div class="space-y-1.5">
                <p class="text-base font-medium">Specialty:</p>
                <p class="text-base"><?php echo $schedule['specialty'] ?></p>
              </div>

              <div class="space-y-1.5">
                <p class="text-base font-medium">Experience:</p>
                <p class="text-base"><?php echo $schedule['experience'] ?> year/s</p>
              </div>

              <div class="space-y-1.5">
                <p class="text-base font-medium">Rate:</p>
                <p class="text-base">P<?php echo $schedule['hourly_rate'] ?> per hour</p>
              </div>

              <div class="space-y-1.5">
                <p class="text-base font-medium">Scheduled Days:</p>
                <p class="text-base"><?php echo $schedule['day_from'] ?> to <?php echo $schedule['day_to'] ?></p>
              </div>

              <div class="space-y-1.5">
                <p class="text-base font-medium">Scheduled Time:</p>
                <p class="text-base"><?php echo $schedule['time_from'] ?> to <?php echo $schedule['time_to'] ?></p>
              </div>
            </div>

            <form action='../../controllers/scheduleController.php' method='POST' class="w-full">
              <input type="hidden" name="schedule_id" value="<?php echo $schedule['schedule_id']?>">
              <button 
                class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
                name="delete"
              >
                Cancel
              </button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>