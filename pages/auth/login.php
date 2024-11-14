<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Login</title>
  </head>

  <body style="background-color: black; position: relative;">
    <div class="w-screen h-screen flex flex-col items-center justify-center">
      <div class="w-full max-w-md bg-[#1f2936] flex flex-col items-center pt-2 pb-6 px-7 rounded-lg space-y-4">
        <p class="text-4xl font-bold text-[#fabf3b] py-3">Login</p>

        <form action="../../controllers/authController.php" method="POST" class="space-y-4">
          <input 
            type="email"
            name="email"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md text-white bg-[#111826]"
            placeholder="Email"
          />

          <input 
            type="password"
            name="password"
            class="w-full px-4 py-2.5 ring-[1px] ring-white text-base rounded-md text-white bg-[#111826]"
            placeholder="Password"
          />

          <button 
            type="submit"
            class="bg-[#fabf3b] w-full py-3 text-black font-bold rounded-lg"
            name="user-login"
          >
            Login
          </button>

          <div class="flex flex-col items-center space-y-2">
            <p class="text-[#fabf3b] text-sm cursor-pointer">Forgot Password?</p>

            <p class="text-[#fabf3b] text-sm">
              Don't have an account? 
              <span 
                class="font-semibold cursor-pointer" 
                onclick="window.location.href='register.php'"
              >Register</span>
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>