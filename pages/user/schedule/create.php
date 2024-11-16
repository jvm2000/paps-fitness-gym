<?php
session_start();
include "../../../config/connect.php";

if (!isset($_SESSION['user_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/login.php");
  exit();
}

$sql = "SELECT * FROM trainers";

$result = mysqli_query($conn, $sql);

$trainers = [];

if ($result->num_rows > 0) {
  while ($trainer = $result->fetch_assoc()) {
    $trainers[] = $trainer; 
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $select_trainer = $_POST['select_trainer'];

  $sql = "SELECT * FROM trainers WHERE trainer_id = $select_trainer";

  $trainers = mysqli_query($conn,$sql);
  $trainer = mysqli_fetch_assoc($trainers);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Class Schedule</title>
  </head>

  <body style="background-color: black; position: relative;">
  <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">CLASS SCHEDULE</p>

      <button 
        class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-sm"
        onclick="window.location.href='../../controllers/logoutController.php'"
      >
        Logout
      </button>
    </header>

    <div class="px-52 w-full">
      <div class="grid grid-cols-6 gap-x-10">
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='home.php'"
        >
          Home Page
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='profile.php'"
        >
          Profile
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='equipment.php'"
        >
          Equipment
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='membership.php'"
        >
          Membership
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='schedule.php'"
        >
          Class Schedule
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Billing History
        </button>
      </div>
    </div>

    <div class="px-52 w-full flex flex-col items-center py-16">
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

          <form action="create.php" class="space-y-6 flex flex-col w-full">
            <div class="space-y-1.5 w-full">
              <p class="text-sm text-black font-medium">Select Trainers</p>

              <select 
                name="select_trainer"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              >
                <option value="0" selected>Select Trainer</option>
                <?php foreach($trainers as $trainer): ?>
                  <option value="<?php echo $trainer['trainer_id'] ?>"><?php echo $trainer['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <button 
              class="bg-black px-5 py-2.5 rounded-lg text-white font-medium"
              type="submit"
            >
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>