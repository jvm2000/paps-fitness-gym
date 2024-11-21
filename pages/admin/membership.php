<?php
include "../../config/connect.php";

$title = 'Memberships';
$pageHeader = 'Memberships';
$childView = __DIR__ . '/membership.php';

include('../../layouts/admin.php');

$sql = "SELECT * FROM memberships";

$result = mysqli_query($conn, $sql);

$memberships = [];

if ($result->num_rows > 0) {
  while ($membership = $result->fetch_assoc()) {
    $memberships[] = $membership; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-full w-full flex flex-col space-y-8 items-start">
    <div class="flex justify-end w-full">
      <button 
        class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
        onclick="window.location.href='membership/create.php'"
      >
        Add Member
      </button>
    </div>

    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Member ID</th>
            <th class="py-4 border-b border-r border-black">Name</th>
            <th class="py-4 border-b border-r border-black">Email</th>
            <th class="py-4 border-b border-r border-black">Contact</th>
            <th class="py-4 border-b border-r border-black">Address</th>
            <th class="py-4 border-b border-r border-black">Age</th>
            <th class="py-4 border-b border-r border-black">Membership Type</th>
            <th class="py-4 border-b border-r border-black">Service Type</th>
            <th class="py-4 border-b border-r border-black">Start Date</th>
            <th class="py-4 border-b border-r border-black">Expiration Date</th>
            <th class="py-4 border-b border-r border-black">Status</th>
            <th class="py-4 border-b border-r border-black">Payment Process</th>
            <th class="py-4 border-b border-black">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($memberships as $membership): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['membership_id'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['name'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['email'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['contact'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['address'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['age'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['type'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['service_type'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['start_date'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['expiration_date'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['status'] ?></td>
              <td class="py-4 text-base text-center border-b border-r border-black"><?php echo $membership['payment_status'] ?></td>
              <td class="py-4 text-base text-center border-b border-black">
                <p>
                  <a href="membership/edit.php?membership_id=<?php echo $membership['membership_id']?>">Edit</a> 
                  <span>-</span>

                  <form action='../../controllers/membershipController.php' method='POST'>
                    <input type="hidden" name="membership_id" value="<?php echo $membership['membership_id']?>">
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