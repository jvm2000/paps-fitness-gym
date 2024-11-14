<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Register</title>
  </head>

  <body style="background-color: black; position: relative;">
    <div class="w-screen h-screen flex flex-col items-center justify-center">
      <div class="w-full max-w-md bg-[#1f2936] flex flex-col items-center pt-2 pb-6 px-7 rounded-lg space-y-4">
        <p class="text-4xl font-bold text-[#fabf3b] py-3">Register</p>

        <form action="../../controllers/authController.php" method="POST" class="space-y-4">
          <input 
            type="text"
            name="firstname"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md bg-[#111826] text-white"
            placeholder="First Name"
          />

          <input 
            type="text"
            name="lastname"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md bg-[#111826] text-white"
            placeholder="Last Name"
          />

          <input 
            type="text"
            name="phone"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md bg-[#111826] text-white"
            placeholder="Phone Number"
          />

          <input 
            type="email"
            name="email"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md bg-[#111826] text-white"
            placeholder="Email"
          />

          <input 
            type="password"
            name="password"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md bg-[#111826] text-white"
            placeholder="Password"
          />

          <button 
            type="submit"
            class="bg-[#fabf3b] w-full py-3 text-black font-bold rounded-lg"
            name="user-register"
          >
            Register
          </button>

          <div class="flex flex-col items-center space-y-2">
            <p 
              class="text-[#fabf3b] text-sm cursor-pointer"
              onclick="window.location.href='login.php'"
            >Back</p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>