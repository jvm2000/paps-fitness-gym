<?php
include "../../config/connect.php";

$title = "Membership";
$pageHeader = "Membership";
$childView = __DIR__ . '/membership.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}

$sql = "SELECT memberships.*, packages.* FROM memberships LEFT JOIN packages ON packages.package_id = memberships.package_id WHERE user_id = $userID";

$result = mysqli_query($conn, $sql);

$memberships = [];

if ($result->num_rows > 0) {
  while ($membership = $result->fetch_assoc()) {
    $memberships[] = $membership; 
  }
}

$dateToday = date("Y-m-d");

if (is_array($memberships) && !empty($memberships) && $memberships[0]['expiration_date'] === $dateToday) {
  $membershipId = $memberships[0]['membership_id'];
  $renewable = "UPDATE memberships SET status = 'renewable', payment_status='renewable' WHERE membership_id = $membershipId";

  $conn->query($renewable);
}


$membershipCount = 0;
$sql = "SELECT COUNT(*) AS total FROM memberships WHERE user_id = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $membershipCount = $row['total'];
}

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$first_name = $user['firstname'];
$last_name = $user['lastname'];
$email = $user['email'];
$phone = $user['phone'];
$gender = $user['gender'];

$memberID = $membershipCount + 1;
?>

<div class="w-full flex flex-col items-center py-24 space-y-12">
  <p class="text-3xl font-bold text-[#fabf3b]">Join Paps Fitness Gym!</p>

  <p class="text-3xl font-bold text-[#fabf3b]">Affordable Membership</p>

  <?php if(empty($memberships)): ?>
    <form 
      action="../../controllers/membershipController.php" 
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

        <div class="space-y-1.5 w-full">
          <p class="text-base font-medium">With Coach [Y/N]?</p>

          <div class="flex items-center w-full justify-between">
            <div class="flex items-center space-x-4">
              <p class="text-xl font-semibold whitespace-nowrap">Coach Name:</p>

              <input 
                name="coach"
                class="w-full focus:ring-0 focus:outline-none border-b border-black text-xl text-black bg-[#fabf3b] text-black placeholder-gray-600"
              />
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
  <?php endif; ?>

  <?php if(!empty($memberships)): ?>
    <div class="max-w-xl w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
      <div class="flex items-center justify-between w-full">
        <p class="text-2xl font-semibold">Active Membership</p>
        <p class="text-base font-semibold capitalize">
          <?php echo ($memberships[0]['payment_status'] === 'pending' && $memberships[0]['status'] !== 'active') ? 'requires payment' : 'paid' ?>
        </p>
      </div>

      <div class="w-full grid grid-cols-2 gap-y-4">
        <div class="space-y-1.5">
          <p class="text-base">Service Type:</p>
          <p class="text-base"><?php echo $memberships[0]['membership_id'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Service Type:</p>
          <p class="text-base"><?php echo $memberships[0]['type'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Starting at:</p>
          <p class="text-base"><?php echo $memberships[0]['start_date'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Expired on::</p>
          <p class="text-base"><?php echo $memberships[0]['expiration_date'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Amount:</p>
          <p class="text-base"><?php echo $memberships[0]['amount'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Status:</p>
          <p class="text-base"><?php echo $memberships[0]['status'] ?></p>
        </div>
      </div>

      <?php if($memberships[0]['payment_status'] === 'pending' && $memberships[0]['status'] === 'pending'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-red-600 justify-center w-full py-3 text-lg font-medium rounded-lg"
            onclick="window.location.href='payment/create.php?membership_id=<?php echo $memberships[0]['membership_id']?>'"
          >
            Pay Now
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              Cancel
            </button>
          </form>
        </div>
      <?php endif; ?>

      <?php if($memberships[0]['payment_status'] === 'paid'  && $memberships[0]['status'] === 'pending'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-orange-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none"
          >
            Pending
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              Cancel
            </button>
          </form>
        </div>
      <?php endif; ?>

      <?php if($memberships[0]['payment_status'] === 'approve'  && $memberships[0]['status'] === 'active'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-green-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none"
          >
            Active
          </button>

          <button 
            class="text-white bg-blue-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none disabled:bg-gray-500"
            onclick="window.location.href='payment/renew.php?membership_id=<?php echo $memberships[0]['membership_id']?>'"
            disabled="<?php if($memberships[0]['payment_status'] === 'renewable' && $memberships[0]['status'] === 'renewable') ?>"
          >
            <?php if($memberships[0]['payment_status'] === 'renewable' && $memberships[0]['status'] === 'renewable'): ?>
              Renew
            <?php endif ?>

            <?php if($memberships[0]['payment_status'] !== 'renewable' && $memberships[0]['status'] !== 'renewable'): ?>
              <div id="countdown">Loading...</div>
            <?php endif ?>
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              End
            </button>
          </form>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<script>
const expirationDateRaw = "<?php echo $memberships[0]['expiration_date'] ?? ''; ?>";
const expirationDate = expirationDateRaw ? new Date(expirationDateRaw) : null;
const todayDate = new Date("<?php echo $dateToday; ?>");

function startCountdown(expirationDate) {
  function updateCountdown() {
    const now = new Date();
    const remainingTime = expirationDate - now;

    if (remainingTime <= 0) {
      clearInterval(interval);
      document.getElementById("countdown").textContent = "Membership expired";
      return;
    }

    const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

    document.getElementById("countdown").textContent =
      `${days}d ${hours}h ${minutes}m ${seconds}s`;
  }

  const interval = setInterval(updateCountdown, 1000);
  updateCountdown();
}

if (expirationDate > todayDate) {
    startCountdown(expirationDate);
} else {
    document.getElementById("countdown").textContent = "Membership expired";
}
</script>

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