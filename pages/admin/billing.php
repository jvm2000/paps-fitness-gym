<?php
include "../../config/connect.php";

$title = 'All Billing History';
$pageHeader = 'All Billing History';
$childView = __DIR__ . '/billing.php';

include('../../layouts/admin.php');

$sql = "SELECT * FROM payments";

$result = mysqli_query($conn, $sql);

$billings = [];

if ($result->num_rows > 0) {
  while ($billing = $result->fetch_assoc()) {
    $billings[] = $billing; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-7xl w-full rounded-lg bg-[#fabf3b] flex flex-col items-start space-y-8">
    <table class="w-full table-auto">
      <thead>
        <tr>
          <th class="py-4 border-b border-r border-black">Billing ID</th>
          <th class="py-4 border-b border-r border-black">Member Name</th>
          <th class="py-4 border-b border-r border-black">Type</th>
          <th class="py-4 border-b border-r border-black">Payment Process</th>
          <th class="py-4 border-b border-r border-black">Total Amount</th>
          <th class="py-4 border-b border-r border-black">Billing</th>
          <th class="py-4 border-b border-r border-black">Payment Status</th>
          <th class="py-4 border-b border-r border-black">Next Payment Due</th>
          <th class="py-4 border-b border-black">Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($billings as $billing): ?>
          <tr>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['payment_id'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['name'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black">
              <span class="capitalize whitespace-nowrap"><?php echo str_replace('_', ' ', str_ireplace('rate', '', $billing['transaction_type'])); ?> Membership</span>
            </td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['method'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['total_paid'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['date_paid'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['status'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['payment_due'] ?></td>
            <td class="text-base text-left text-black border-b border-black">
              <p>
                <a href="billing/edit.php?payment_id=<?php echo $billing['payment_id']?>">Edit</a> 
                <span>-</span>

                <form action='../../controllers/paymentController.php' method='POST'>
                  <input type="hidden" name="payment_id" value="<?php echo $billing['payment_id']?>">
                  <input type="hidden" name="membership_id" value="<?php echo $billing['membership_id']?>">
                  
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