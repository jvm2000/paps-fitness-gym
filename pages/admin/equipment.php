<?php
include "../../config/connect.php";

$title = 'Equipments';
$pageHeader = 'Equipments';
$childView = __DIR__ . '/equipment.php';

include('../../layouts/admin.php');

$sql = "SELECT * FROM equipments";

$result = mysqli_query($conn, $sql);

$equipments = [];

if ($result->num_rows > 0) {
  while ($equipment = $result->fetch_assoc()) {
    $equipments[] = $equipment; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-full w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
        class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
        onclick="window.location.href='equipment/create.php'"
      >
        Add Equipment
      </button>
    </div>

    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Equipment ID</th>
            <th class="py-4 border-b border-r border-black">Image</th>
            <th class="py-4 border-b border-r border-black">Name</th>
            <th class="py-4 border-b border-r border-black">Type</th>
            <th class="py-4 border-b border-r border-black">Quantity</th>
            <th class="py-4 border-b border-r border-black">Condition</th>
            <th class="py-4 border-b border-r border-black">Last Maintenance</th>
            <th class="py-4 border-b border-r border-black">Next Maintenance Due</th>
            <th class="py-4 border-b border-r border-black">Status</th>
            <th class="py-4 border-b border-black">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($equipments as $equipment): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['equipment_id'] ?></td>
              <td class="text-base text-left text-black indent-4 border-b border-r border-black">
                <img src="<?php echo '../' . $equipment['image']; ?>" class="w-full h-24 object-cover">
              </td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['name'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['type'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['quantity'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['equipment_condition'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['last_maintenance'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['due_maintenance'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['status'] ?></td>
              <td class="py-4 text-base text-center border-b border-black">
                <p>
                  <a href="equipment/edit.php?equipment_id=<?php echo $equipment['equipment_id']?>">Edit</a> 
                  <span>-</span>

                  <form action='../../controllers/equipmentController.php' method='POST'>
                    <input type="hidden" name="equipment_id" value="<?php echo $equipment['equipment_id']?>">
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