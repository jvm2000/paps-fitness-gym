<?php
include "../../../config/connect.php";

$title = "Membership Create";
$pageHeader = "Membership Create";
$childView = __DIR__ . '/create.php';
$noHeader = true;

include('../../../layouts/user.php');

$userID = $_SESSION['user_id'];

$membershipCount = 0;
$sql = "SELECT COUNT(*) AS total FROM memberships WHERE user_id = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $membershipCount = $row['total'];
}

$memberID = $membershipCount + 1;

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$first_name = $user['firstname'];
$last_name = $user['lastname'];
$email = $user['email'];
$phone = $user['phone'];
$gender = $user['gender'];

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center pb-16">
  <form 
    action="../../../controllers/membershipController.php" 
    method="POST"
    class="max-w-2xl w-full flex flex-col items-start space-y-6 bg-[#fabf3b] px-6 py-4 rounded-lg"
  >
    <input type="hidden" name="user_id" value="<?php echo $userID ?>">
    <input type="hidden" name="package_id" value="">
    <input type="hidden" name="status" value="pending">
    <input type="hidden" name="payment_status" value="pending">
    <input type="hidden" name="start_date">
    <input type="hidden" name="created_at">
    
    <div class="flex items-center space-x-4">
      <p class="text-xl font-semibold whitespace-nowrap">Membership ID:</p>

      <div class="border-b text-xl border-black w-24"><?php echo $memberID ?></div>
    </div>

    <div class="flex flex-col items-start w-full space-y-6">
      <div class="flex items-center space-x-4">
        <p class="text-base font-medium">Full Name:</p>
        <p class="text-base font-medium"><?php echo $first_name ?> <?php echo $last_name ?></p>
      </div>

      <div class="flex items-center space-x-4">
        <p class="text-base font-medium">Contact Number:</p>
        <p class="text-base font-medium"><?php echo $phone ?></p>
      </div>

      <div class="flex items-center space-x-4">
        <p class="text-base font-medium">Email:</p>
        <p class="text-base font-medium"><?php echo $email ?></p>
      </div>

      <div class="flex items-center space-x-4">
        <p class="text-base font-medium">Gender:</p>
        <p class="text-base font-medium"><?php echo $gender ?></p>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Type of Service:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="service_type"
          id="serviceTypeSelect"
        >
          <option value="0" selected>Select Service Type</option>
          <?php foreach($packages as $package): ?>
            <option value="<?php echo htmlspecialchars($package['name']); ?>">
                <?php echo htmlspecialchars($package['name']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Membership Type:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="type"
          id="membershipTypeSelect"
        >
          <option value="0" selected>Select Membership Type</option>
          <option value="hourly_rate">Hourly</option>
          <option value="daily_rate">Daily</option>
          <option value="weekly_rate">Weekly</option>
          <option value="monthly_rate">Monthly</option>
          <option value="yearly_rate">Yearly</option>
        </select>
      </div>

      <table class="w-full table-auto border border-black">
        <thead>
          <tr>
            <th class="py-2 text-base border-b border-r border-black">Type of Service</th>
            <th class="py-2 text-base border-b border-r border-black">Type of Membership</th>
            <th class="py-2 text-base border-b border-r border-black">Expiry Date</th>
            <th class="py-2 text-base border-b border-black">Amount</th>
          </tr>

          <tbody>
            <tr>
              <td class="py-2 text-base border-b border-r border-black">
                <p class="text-base indent-4" id="outputService">N/A</p>
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <p class="text-base indent-4" id="outputmembership">N/A</p>
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <input type="text" name="expiration_date" class="bg-inherit text-base w-28 text-black indent-4 pointer-events-none" value="N/A">
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <input type="text" id="amount" name="amount" class="bg-inherit text-base w-28 text-black indent-4 pointer-events-none" value="N/A">
              </td>
            </tr>
          </tbody>
        </thead>
      </table>

      <div class="flex items-center w-full justify-between">
        <div class="flex items-center space-x-4">
          <p class="text-xl font-semibold whitespace-nowrap">Coach Name:</p>

          <input 
            name="coach"
            class="w-full focus:ring-0 focus:outline-none border-b border-black text-xl text-black bg-[#fabf3b] text-black placeholder-gray-600"
          />
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
            Submit
          </button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  const service = document.getElementById('serviceTypeSelect');
  const outputElement = document.getElementById('outputService');

  service.addEventListener('change', () => {
    const selectedValue = service.value;

    outputElement.textContent = `${selectedValue}`;
  });

  const membership = document.getElementById('membershipTypeSelect');
  const outputMembership = document.getElementById('outputmembership');

  membership.addEventListener('change', () => {
    const selectedValue = membership.value;

    outputMembership.textContent = `${selectedValue}`;
  });

  const today = new Date();

  const formattedDate = today.toISOString().split('T')[0];

  document.querySelector('input[name="start_date"]').value = formattedDate;
  document.querySelector('input[name="created_at"]').value = formattedDate;

  document.addEventListener("DOMContentLoaded", () => {
    const selectElement = document.querySelector("select[name='type']");
    const hiddenInput = document.querySelector("input[name='expiration_date']");
    const amountInput = document.getElementById('amount');

    selectElement.addEventListener("change", () => {
      const formattedToday = today.toISOString().split("T")[0];
      hiddenInput.value = formattedToday;

      const expiryDate = selectElement.value;

      const selectedValue = selectElement.value;

      amountInput.value = packageRates[selectedValue] || '';

      let expirationDate = new Date(today);

      switch (expiryDate) {
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

  var packageSelected = null;

  let packageRates = {
    hourly_rate: '',
    daily_rate: '',
    weekly_rate: '',
    monthly_rate: '',
    yearly_rate: ''
  };

  document.getElementById('serviceTypeSelect').addEventListener('change', function() {
    const packageName = this.value;

    if (packageName !== '0') {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'membership_fetch.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            packageSelected = JSON.parse(xhr.responseText);

            packageRates = {
              hourly_rate: packageSelected['hourly_rate'],
              daily_rate: packageSelected['daily_rate'],
              weekly_rate: packageSelected['weekly_rate'],
              monthly_rate: packageSelected['monthly_rate'],
              yearly_rate: packageSelected['yearly_rate']
            };
            console.log(packageRates)
          }
      };
      xhr.send('packageName=' + encodeURIComponent(packageName));
    }
  });
</script>