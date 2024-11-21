<?php
include "../../../config/connect.php";

$title = "About Membership";
$pageHeader = "About Membership";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

$membership_id = $_GET['membership_id'];

$sql = "SELECT * FROM memberships WHERE membership_id = $membership_id";
$memberships = mysqli_query($conn,$sql);
$membership = mysqli_fetch_assoc($memberships);

$membership_id = $membership['membership_id'];
$name = $membership['name'];
$email = $membership['email'];
$contact = $membership['contact'];
$address = $membership['address'];
$age = $membership['age'];
$type = $membership['type'];
$service_type = $membership['service_type'];
$payment_status = $membership['payment_status'];
$expiration_date = $membership['expiration_date'];
$payment_status = $membership['payment_status'];
$amount = $membership['amount'];

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
    <input type="hidden" name="membership_id" value="<?php echo $membership_id ?>">

    <div class="flex items-center space-x-4">
      <p class="text-xl font-semibold whitespace-nowrap">Membership ID:</p>
      <input 
        name="membership_id"
        class="w-full focus:ring-0 focus:outline-none border-b border-black text-xl text-black bg-[#fabf3b] text-black placeholder-gray-600"
        disabled
        value="<?php echo $membership_id ?>"
      />
    </div>

    <div class="flex flex-col items-start w-full space-y-6">
      <input 
        name="name"
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        placeholder="Full Name"
        value="<?php echo $name ?>"
      />

      <input 
        type="email"
        name="email"
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        placeholder="Email"
        value="<?php echo $email ?>"
      />

      <input 
        name="contact"
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        placeholder="Contact"
        value="<?php echo $contact ?>"
      />

      <input 
        name="address"
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        placeholder="Address"
        value="<?php echo $address ?>"
      />

      <input 
        name="age"
        class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
        placeholder="Age"
        value="<?php echo $age ?>"
      />

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Type of Service:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="service_type"
          id="serviceTypeSelect"
        >
          <option value="0" selected>Select Service Type</option>
          <?php foreach($packages as $package): ?>
            <option 
              value="<?php echo htmlspecialchars($package['name']); ?>"
              <?php echo $package['name'] === $service_type ? 'selected' : ''; ?>
            >
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
          <option value="weekly_rate" <?php echo $type === 'weekly_rate' ? 'selected' : ''; ?>>Weekly</option>
          <option value="monthly_rate" <?php echo $type === 'monthly_rate' ? 'selected' : ''; ?>>Monthly</option>
          <option value="yearly_rate" <?php echo $type === 'yearly_rate' ? 'selected' : ''; ?>>Yearly</option>
        </select>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Status:</p>
        <select 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          name="status"
        >
          <option value="deactivate" selected>Deactivate</option>
          <?php if($payment_status === 'paid'): ?>
            <option value="active">Active</option>
          <?php endif; ?>
        </select>

        <?php if($payment_status === 'pending'): ?>
          <span class="text-xs">Cannot set this member as active, the member still need to pay</span>
        <?php endif; ?>
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
                <p class="text-base indent-4" id="outputService"><?php echo $service_type ?></p>
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <p class="text-base indent-4" id="outputmembership"><?php echo $type ?></p>
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <input 
                  type="text" name="expiration_date" class="bg-inherit text-base w-28 text-black indent-4 pointer-events-none" 
                  value="<?php echo $expiration_date ?>"
                />
              </td>
              <td class="py-2 text-base border-b border-r border-black">
                <input 
                  type="text" id="amount" name="amount" class="bg-inherit text-base w-28 text-black indent-4 pointer-events-none" 
                  value="<?php echo $amount ?>"
                />
              </td>
            </tr>
          </tbody>
        </thead>
      </table>

      <div class="flex items-center w-full justify-end">
        <div class="flex items-center space-x-4">
          <div 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm cursor-pointer"
            onclick="window.location.href='../membership.php'"
          >
            Back
          </div>

          <button 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm"
            name="update"
          >
            Update
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