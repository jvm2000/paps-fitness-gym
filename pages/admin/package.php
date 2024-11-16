<?php
include "../../config/connect.php";

$title = 'Packages';
$pageHeader = 'Packages';
$childView = __DIR__ . '/package.php';

include('../../layouts/admin.php');

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-6xl w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
        class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
        onclick="window.location.href='package/create.php'"
      >
        Add Package
      </button>
    </div>
    
    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Name</th>
            <th class="border-b border-r border-black">Description</th>
            <th class="border-b border-r border-black">Daily Price</th>
            <th class="border-b border-r border-black">Monthly Price</th>
            <th class="border-b border-r border-black">Weekly Price</th>
            <th class="border-b border-r border-black">Yearly Price</th>
            <th class="border-b border-black">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($packages as $package): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $package['name'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $package['description'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo !empty($package['daily_rate']) ? $package['daily_rate'] : 'N/A' ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo !empty($package['monthly_rate']) ? $package['monthly_rate'] : 'N/A' ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo !empty($package['weekly_rate']) ? $package['weekly_rate'] : 'N/A' ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo !empty($package['yearly_rate']) ? $package['yearly_rate'] : 'N/A' ?></td>
              <td class="py-4 text-base text-center border-b border-black">
                <p>
                  <a href="package/edit.php?package_id=<?php echo $package['package_id']?>">Edit</a> 
                  <span>-</span>

                  <form action='../../controllers/packageController.php' method='POST'>
                    <input type="hidden" name="package_id" value="<?php echo $package['package_id']?>">
                    <button type="submit" name="delete">Delete</button> 
                  </form>
                </p>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>