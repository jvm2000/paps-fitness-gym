<?php
include "../../../config/connect.php";

$title = "Membership Create";
$pageHeader = "Membership Create";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/user.php');

$userID = $_SESSION['user_id'];

$package_id = $_GET['package_id'];

$sql = "SELECT * FROM packages WHERE package_id = $package_id";
$packages = mysqli_query($conn,$sql);
$package = mysqli_fetch_assoc($packages);

$name = $package['name'];
$hourly_rate = $package['hourly_rate'] ?? 0;
$daily_rate = $package['daily_rate'];
$monthly_rate = $package['monthly_rate'];
$weekly_rate = $package['weekly_rate'];
$yearly_rate = $package['yearly_rate'];

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$first_name = $user['firstname'];
$last_name = $user['lastname'];
$email = $user['email'];
$phone = $user['phone'];
$gender = $user['gender'];
?>

<div class="px-52 w-full flex flex-col items-center">
  <form 
    action="../../../controllers/membershipController.php" 
    method="POST"
    class="max-w-xl bg-[#fabf3b] w-full px-6 py-5 flex flex-col items-start space-y-10"
  >
    <input type="hidden" name="user_id" value="<?php echo $userID ?>">
    <input type="hidden" name="package_id" value="<?php echo $package_id ?>">
    <input type="hidden" name="status" value="pending">
    <input type="hidden" name="payment_status" value="pending">
    <input type="hidden" name="start_date">
    <input type="hidden" name="expiration_date">
    <input type="hidden" name="created_at">
    
    <p class="text-5xl text-black font-bold">Join <?php echo $name?></p>

    <div class="flex flex-col items-start max-w-full w-full space-y-6">
      <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-4">
          <p class="text-base font-medium">Full Name:</p>
          <p class="text-base font-medium"><?php echo $first_name ?> <?php echo $last_name ?></p>
        </div>

        <div class="flex items-center space-x-4">
          <p class="text-base font-medium">Contact Number:</p>
          <p class="text-base font-medium"><?php echo $phone ?></p>
        </div>
      </div>

      <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-4">
          <p class="text-base font-medium">Email:</p>
          <p class="text-base font-medium"><?php echo $email ?></p>
        </div>

        <div class="flex items-center space-x-4">
          <p class="text-base font-medium">Gender:</p>
          <p class="text-base font-medium"><?php echo $gender ?></p>
        </div>
      </div>

      <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-4">
          <p class="text-base font-medium">Amount:</p>
          <input name="amount" id="amount" class="text-base font-medium outline-none border-0 pointer-events-none bg-inherit" />
        </div>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Service Type:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="type"
        >
          <option value="0" selected>Select Service Type</option>
          <option value="boxing">Boxing</option>
          <option value="yoga">Yoga</option>
          <option value="kick_boxing">Kick Boxing</option>
          <option value="butangi_drop_down">Butangi Drop Down</option>
        </select>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Membership Type:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="membership_type"
          id="membership-type"
        >
          <option value="0" selected>Select Membership Type</option>
          <option value="hourly_rate">Hourly</option>
          <option value="daily_rate">Daily</option>
          <option value="weekly_rate">Weekly</option>
          <option value="monthly_rate">Monthly</option>
          <option value="yearly_rate">Yearly</option>
        </select>
      </div>
    </div>

    <div class="flex items-center space-x-4">
      <div 
        class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm cursor-pointer"
        onclick="window.location.href='../membership.php'"
      >
        Back
      </div>

      <button 
        class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm"
        name="create"
        type="submit"
      >
        Create
      </button>
    </div>
  </form>
</div>

<script>
const packageRates = {
  hourly_rate: <?php echo $hourly_rate ?>,
  daily_rate: <?php echo $daily_rate ?>,
  weekly_rate: <?php echo $weekly_rate ?>,
  monthly_rate: <?php echo $monthly_rate ?>,
  yearly_rate: <?php echo $yearly_rate ?>
};

const today = new Date();

const formattedDate = today.toISOString().split('T')[0];

document.querySelector('input[name="start_date"]').value = formattedDate;
document.querySelector('input[name="created_at"]').value = formattedDate;

document.addEventListener("DOMContentLoaded", () => {
  const selectElement = document.querySelector("select[name='membership_type']");
  const hiddenInput = document.querySelector("input[name='expiration_date']");
  const amountInput = document.getElementById('amount');

  selectElement.addEventListener("change", () => {
    const formattedToday = today.toISOString().split("T")[0];
    hiddenInput.value = formattedToday;

    const selectedValue = selectElement.value;

    amountInput.value = packageRates[selectedValue] || '';

    let expirationDate = new Date(today);

    switch (selectedValue) {
      case "hourly_rate":
        expirationDate = new Date(today.setDate(today.getDate()));
        break;
      case "daily_rate":
        expirationDate = new Date(today.setDate(today.getDate() + 1));
        break;
      case "weekly_rate":
        expirationDate = new Date(today.setDate(today.getDate() + 7));
        break;
      case "monthly_rate":
        expirationDate = new Date(today.setMonth(today.getMonth() + 1));
        break;
      case "yearly_rate":
        expirationDate = new Date(today.setFullYear(today.getFullYear() + 1));
        break;
      default:
        expirationDate = '';
    }

    hiddenInput.value = expirationDate.toISOString().split("T")[0];
  });
});
</script>