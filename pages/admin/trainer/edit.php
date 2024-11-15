<?php
session_start();
include "../../../config/connect.php";

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
  exit();
}

$trainer_id = $_GET['trainer_id'];

$sql = "SELECT * FROM trainers WHERE trainer_id = $trainer_id";
$trainers = mysqli_query($conn,$sql);
$trainer = mysqli_fetch_assoc($trainers);

$name = $trainer['name'];
$specialty = $trainer['specialty'];
$experience = $trainer['experience'];
$hourly_rate = $trainer['hourly_rate'];
$day_from = $trainer['day_from'] ;
$day_to = $trainer['day_to'] ;
$time_from = date('H:i:s', strtotime($trainer['time_from']));
$time_to = date('H:i:s', strtotime($trainer['time_to']));
$image = $trainer['image'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Edit Trainer</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">EDIT TRAINER</p>

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
            <input type="hidden" name="trainer_id" value="<?php echo $trainer_id ?>">

            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Trainer Name"
              value="<?php echo $name ?>"
            />

            <input 
              name="specialty"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Specialty"
              value="<?php echo $specialty ?>"
            />

            <input 
              type="number"
              name="experience"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Experience"
              value="<?php echo $experience ?>"
            />

            <input 
              type="number"
              name="hourly_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Hourly Rate"
              value="<?php echo $hourly_rate ?>"
            />

            <div class="relative grid grid-cols-2 items-center gap-x-1">
              <select 
                name="day_from"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="monday" <?php echo $day_from === 'monday' ? 'selected' : ''; ?>>Monday</option>
                <option value="tuesday" <?php echo $day_from === 'tuesday' ? 'selected' : ''; ?>>Tuesday</option>
                <option value="wednesday" <?php echo $day_from === 'wednesday' ? 'selected' : ''; ?>>Wednesday</option>
                <option value="thursday" <?php echo $day_from === 'thursday' ? 'selected' : ''; ?>>Thursday</option>
                <option value="friday" <?php echo $day_from === 'friday' ? 'selected' : ''; ?>>Friday</option>
                <option value="saturday" <?php echo $day_from === 'saturday' ? 'selected' : ''; ?>>Saturday</option>
                <option value="sunday" <?php echo $day_from === 'sunday' ? 'selected' : ''; ?>>Sunday</option>
              </select>

              <select 
                name="day_to"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="monday" <?php echo $day_to === 'monday' ? 'selected' : ''; ?>>Monday</option>
                <option value="tuesday" <?php echo $day_to === 'tuesday' ? 'selected' : ''; ?>>Tuesday</option>
                <option value="wednesday" <?php echo $day_to === 'wednesday' ? 'selected' : ''; ?>>Wednesday</option>
                <option value="thursday" <?php echo $day_to === 'thursday' ? 'selected' : ''; ?>>Thursday</option>
                <option value="friday" <?php echo $day_to === 'friday' ? 'selected' : ''; ?>>Friday</option>
                <option value="saturday" <?php echo $day_to === 'saturday' ? 'selected' : ''; ?>>Saturday</option>
                <option value="sunday" <?php echo $day_to === 'sunday' ? 'selected' : ''; ?>>Sunday</option>
              </select>
            </div>

            <div class="relative grid grid-cols-2 items-center gap-x-1">
              <div class="relative flex items-center">
                <input 
                  type="time"
                  name="time_from"
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-6 rounded-md text-black bg-black text-white"
                  value="<?php echo $time_from ?>"
                />
                <p class="absolute left-4 text-white">F:</p>
              </div>

              <div class="relative flex items-center">
                <input 
                  type="time"
                  name="time_to"
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-6 rounded-md text-black bg-black text-white"
                  value="<?php echo $time_to ?>"
                />
                <p class="absolute left-4 text-white">T:</p>
              </div>
            </div>

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
  </body>
</html>