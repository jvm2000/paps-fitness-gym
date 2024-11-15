<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Manage Trainers</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">MANAGE TRAINERS</p>

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
      <div class="max-w-full w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='trainer/create.php'"
          >
            Add Trainer
          </button>
        </div>

        <div class="w-full rounded-md bg-[#fabf3b]">
        <table class="w-full table-auto">
            <thead>
              <tr>
                <th class="py-4 border-b border-r border-black">Trainer ID</th>
                <th class="py-4 border-b border-r border-black">Image</th>
                <th class="py-4 border-b border-r border-black">Name</th>
                <th class="py-4 border-b border-r border-black">Specialty</th>
                <th class="py-4 border-b border-r border-black">Experience</th>
                <th class="py-4 border-b border-r border-black">Hourly Rate</th>
                <th class="py-4 border-b border-r border-black">Availability</th>
                <th class="py-4 border-b border-black">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($trainers as $trainer): ?>
                <tr>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['trainer_id'] ?></td>
                  <td class="text-base text-left text-black indent-4 border-b border-r border-black">
                    <img src="<?php echo '../' . $trainer['image']; ?>" class="w-full h-24 object-cover">
                  </td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['name'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['specialty'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['experience'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['hourly_rate'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-black text-center">
                    <?php echo $trainer['day_from'] ?> - <?php echo $trainer['day_to'] ?> : <?php echo $trainer['time_from'] ?> <?php echo $trainer['time_to'] ?>
                  </td>
                  <td class="py-4 text-base text-center border-b border-l border-black">
                    <p>
                      <a href="trainer/edit.php?trainer_id=<?php echo $trainer['trainer_id']?>">Edit</a> 
                      <span>-</span>

                      <form action='../../controllers/trainersController.php' method='POST'>
                        <input type="hidden" name="trainer_id" value="<?php echo $trainer['trainer_id']?>">
                        <button type="submit" name="delete">Delete</button> 
                      </form>
                    </p>
                  </td>
                </tr>
              <?php endforeach;  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>