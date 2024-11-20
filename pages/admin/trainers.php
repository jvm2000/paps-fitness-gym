<?php
include "../../config/connect.php";

$title = 'Trainers';
$pageHeader = 'Trainers';
$childView = __DIR__ . '/trainers.php';

include('../../layouts/admin.php');

$sql = "SELECT * FROM trainers";

$result = mysqli_query($conn, $sql);

$trainers = [];

if ($result->num_rows > 0) {
  while ($trainer = $result->fetch_assoc()) {
    $trainers[] = $trainer; 
  }
}
?>

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
            <th class="py-4 border-b border-r border-black">Age</th>
            <th class="py-4 border-b border-r border-black">Gender</th>
            <th class="py-4 border-b border-r border-black">Address</th>
            <th class="py-4 border-b border-r border-black">Contact</th>
            <th class="py-4 border-b border-r border-black">Specialty</th>
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
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['age'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['gender'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['address'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['contact'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['specialty'] ?></td>
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