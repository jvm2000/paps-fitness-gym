<?php
include "../../config/connect.php";

$title = 'Billing History';
$pageHeader = 'Billing History';
$childView = __DIR__ . '/billing.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM payments WHERE user_id = $userID";

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
          <th class="py-4 border-b border-r border-black">Email</th>
          <th class="py-4 border-b border-r border-black">Date</th>
          <th class="py-4 border-b border-r border-black">Transaction</th>
          <th class="py-4 border-b border-r border-black">Status</th>
          <th class="py-4 border-b border-r border-black">Payment Method</th>
          <th class="py-4 border-b border-r border-black">Total Paid</th>
          <th class="py-4 border-b border-black">Receipt Uploaded</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($billings as $billing): ?>
          <tr>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['email'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['date_paid'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['transaction_type'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['method'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['status'] ?></td>
            <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $billing['total_paid'] ?></td>
            <td class="text-base text-left text-black border-black">
              <img src="<?php echo '../' . $billing['receipt_image']; ?>" class="w-full h-24 object-cover">
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>