<?php
include "../../../config/connect.php";

$title = "Renew Membership Payment";
$pageHeader = "Renew Membership Payment";
$childView = __DIR__ . '/renew.php';
$noHeader = true;

include('../../../layouts/user.php');

$membership_id = $_GET['membership_id'];

$sql = "SELECT memberships.*, packages.* FROM memberships LEFT JOIN packages ON packages.package_id = memberships.package_id WHERE membership_id = $membership_id";

$memberships = mysqli_query($conn,$sql);
$membership = mysqli_fetch_assoc($memberships);

$name = $membership['name'];
$amount = $membership['amount'];
?>

<div class="px-52 w-full flex flex-col items-center pb-16">
  <form 
    action="../../../controllers/paymentController.php" 
    method="POST"
    class="max-w-2xl bg-[#fabf3b] w-full px-6 py-5 flex flex-col items-start space-y-10"
    enctype="multipart/form-data"
  >
    <input type="hidden" name="membership_id" value="<?php echo $membership_id ?>" />
    <input type="hidden" name="transaction_type" value="Membership - <?php echo $name ?>" />
    <input type="hidden" name="status" value="paid" />
    <input type="hidden" name="date_paid" />

    <p class="text-5xl text-black font-bold">Renew Membership Payment</p>

    <div class="flex flex-col items-start max-w-full w-full space-y-6">
      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Email:</p>
        <input 
          name="email"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black placeholder-gray-600"
          placeholder="Email"
        />
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Payment Method:</p>
        <select 
          name="method"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-white bg-black text-black"
        >
          <option value="gcash" selected>GCash</option>
          <option value="cash">Cash</option>
        </select>
      </div>

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Total Paid:</p>
        <input 
          name="total_paid"
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black pointer-events-none"
          value="<?php echo $amount ?>"
        />
      </div>
    </div>

    <div 
      class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white min-h-24 max-h-full flex items-center justify-center" 
      id="uploadButton"
    >
      <p>Upload Receipt</p>
      <img id="previewImage" src="" alt="Image Preview" style="display: none;" class="w-full object-cover h-64" />
      <input type="file" id="fileInput" name="receipt_image" style="display: none;" />
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
        name="renew"
        type="submit"
      >
        Renew
      </button>
    </div>
  </form>
</div>

<script>
  const today = new Date();

  const formattedDate = today.toISOString().split('T')[0];

  document.querySelector('input[name="date_paid"]').value = formattedDate;

  document.getElementById('uploadButton').addEventListener('click', function () {
    document.getElementById('fileInput').click();
  });

  document.getElementById('fileInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const previewImage = document.getElementById('previewImage');
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      alert('Please select an image file.');
    }
  });
</script>