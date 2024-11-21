<?php
include "../../../config/connect.php";

$title = "Edit Payment";
$pageHeader = "Edit Payment";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

$payment_id = $_GET['payment_id'];

$sql = "SELECT * FROM payments WHERE payment_id = $payment_id";
$payments = mysqli_query($conn,$sql);
$payment = mysqli_fetch_assoc($payments);

$membership_id = $payment['membership_id'];
$name = $payment['name'];
$transaction_type = $payment['transaction_type'];
$method = $payment['method'];
$total_paid = $payment['total_paid'];
$date_paid = $payment['date_paid'];
$payment_due = $payment['payment_due'];
?>

<div class="px-52 w-full flex flex-col items-center pb-16">
  <form 
    action="../../../controllers/paymentController.php" 
    method="POST"
    class="max-w-2xl w-full flex flex-col items-start space-y-6 bg-[#fabf3b] px-6 py-4 rounded-lg"
  >
    <p class="text-3xl text-black font-bold">Payment</p>

    <input type="hidden" name="payment_id" value="<?php echo $payment_id ?>">
    <input type="hidden" name="membership_id" value="<?php echo $membership_id ?>">

    <div class="flex flex-col items-start w-full space-y-6">
      <input 
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        disabled
        value="<?php echo $name ?>"
      />

      <input 
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        disabled
        value="<?php echo $transaction_type ?>"
      />

      <input 
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        disabled
        value="<?php echo $method ?>"
      />

      <input 
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        disabled
        value="<?php echo $total_paid ?>"
      />

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Membership Type:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="status"
          id="membershipTypeSelect"
        >
          <option value="0" selected>Change Payment Status</option>
          <option value="paid" >Paid</option>
        </select>
      </div>

      <div class="flex items-center w-full justify-end">
        <div class="flex items-center space-x-4">
          <div 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm cursor-pointer"
            onclick="window.location.href='../billing.php'"
          >
            Back
          </div>

          <button 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm"
            name="update"
          >
            Submit
          </button>
        </div>
      </div>
    </div>
  </form>
</div>