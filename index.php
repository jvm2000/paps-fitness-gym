<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Welcome to PAP's Fitness Gym</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="flex items-center justify-between px-56 py-4">
      <div class="w-14 h-14 overflow-hidden">
        <img src="public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <div class="flex items-center space-x-6">
        <button 
          class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-lg"
          onclick="window.location.href='pages/auth/login.php'"
        >
          Login
        </button>

        <a href="#about" class="text-base text-[#fabf3b]">About</a>

        <a href="#pricing" class="text-base text-[#fabf3b]">Pricing</a>

        <a href="#equipment" class="text-base text-[#fabf3b]">Equipment</a>

        <a href="#contact" class="text-base text-[#fabf3b]">Contact</a>
      </div>
    </header>

    <div class="relative flex flex-col items-center justify-center h-full">
      <img src="public/images/home-bg.png" alt="Background" class="w-full h-[56rem] object-fit opacity-60 blur-[1px] z-[0] object-cover">

      <div class="flex flex-col items-center space-y-6 absolute z-[1]">
        <div class="w-72 h-72 overflow-hidden">
          <img src="public/images/logo.png" alt="Logo" class="w-full h-auto">
        </div>

        <p class="text-4xl font-bold text-[#fabf3b]">Welcome to PAP's Fitness Gym</p>

        <p class="text-base text-[#f49e2b]">
          Join us to emark on your fitness journey with top-tier equipment, professional trainers, and the best workout experience.
        </p>

        <button class="bg-[#fabf3b] px-6 py-2.5 text-black text-xl font-medium rounded-lg font-medium">
          Get Started
        </button>

        <button 
          class="bg-[#f49e2b] px-6 py-2.5 text-black text-xl font-medium rounded-lg font-medium"
          onclick="window.location.href='pages/auth/login.php'"
        >
          Login
        </button>
      </div>
    </div>

    <div class="flex flex-col items-center justify-between px-56 py-48 space-y-40">
      <div class="flex flex-col items-center space-y-8" id="about">
        <p class="text-4xl text-[#fabf3b] font-semibold">About PAP's Fitness Gym</p>

        <p class="text-base text-[#f49e2b]">
          Located in Talisay, Cebu, PAP's Fitness Gym is dedicated to helping you achieve your fitness goals. We offer a variety of equipment, classes, and personalized training options to meet your fitness needs.
        </p>

        <button class="bg-[#fabf3b] px-6 py-2.5 text-black text-base font-medium rounded-lg font-medium">
          Contact Us
        </button>
      </div>

      <div class="flex flex-col items-center space-y-8 w-full" id="pricing">
        <p class="text-4xl text-[#fabf3b] font-semibold">Our Membership Plans</p>

        <div class="grid grid-cols-3 items-center w-full max-w-full gap-x-12">
          <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] py-8">
            <p class="text-[#fabf3b] font-semibold text-lg">Daily Pass</p>

            <p class="text-[#f49e2b] text-base">P35 per day</p>

            <p class="text-[#f49e2b] text-base">Perfect for occasional visitors.</p>

            <button class="bg-[#fabf3b] px-8 py-1 text-black text-base font-medium rounded-xs font-medium">
              Join Now!
            </button>
          </div>

          <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] py-8">
            <p class="text-[#fabf3b] font-semibold text-lg">Monthly Membership</p>

            <p class="text-[#f49e2b] text-base">P600 per month</p>

            <p class="text-[#f49e2b] text-base">Ideal for committed gym-goers</p>

            <button class="bg-[#fabf3b] px-8 py-1 text-black text-base font-medium rounded-xs font-medium">
              Join Now!
            </button>
          </div>

          <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] py-8">
            <p class="text-[#fabf3b] font-semibold text-lg">Boxing Session</p>

            <p class="text-[#f49e2b] text-base">P100 per hour</p>

            <p class="text-[#f49e2b] text-base">One-on-one boxing training</p>

            <button class="bg-[#fabf3b] px-8 py-1 text-black text-base font-medium rounded-xs font-medium">
              Join Now!
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center justify-between px-56 py-48 space-y-10" id="equipment">
      <div class="flex flex-col items-center space-y-8">
        <p class="text-4xl text-[#fabf3b] font-semibold">Our Equipment</p>

        <p class="text-base text-[#f49e2b]">
          We offer a wide variety of equipment to help you achieve your fitness goals, including strength training and cardio equipment.
        </p>
      </div>

      <div class="grid grid-cols-3 items-center w-full max-w-full gap-12">
        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-12 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/bench-press.png" alt="Bench Press" class="w-full h-64 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Bench Press</p>

            <p class="text-[#fabf3b] text-sm">
              A must-have for building upper body strength, the bench press is a classic exercise for chest and tricep development.
            </p>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-7 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/cable-machine.png" alt="Cable Machine" class="w-full h-64 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Cable Machine</p>

            <p class="text-[#fabf3b] text-sm text-center">
              Versatile and effective for a full-body workout. The cable machine allows for various exercises to target multiple muscle groups.
            </p>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-12 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/dumbbells.png" alt="Dumbbells" class="w-full h-64 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Dumbbells</p>

            <p class="text-[#fabf3b] text-sm text-center">
              An essential for strength training, dumbbelss help improve muscle tone and strength. Available in various weights.
            </p>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-7 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/exercise-bike.png" alt="Exercise Bike" class="w-full h-64 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Exercise Bike</p>

            <p class="text-[#fabf3b] text-sm text-center">
              Perfect for cardio workouts, our exercise bikes offer a low-impact way to improve cardiovascular health and burn calories.
            </p>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-12 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/jump-rope.png" alt="Jump Rope" class="w-full h-56 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Jump Rope</p>

            <p class="text-[#fabf3b] text-sm text-center">
              A simple yet effective cardio tool for improving endurance, coordination, and burning fat.
            </p>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-4 rounded-lg bg-[#1f2936] pt-4 pb-7 px-4">
          <div class="w-full h-48 overflow-hidden rounded-lg relative">
            <img src="public/images/equipment/kettlebells.png" alt="Kettlebells" class="w-full h-64 object-cover">
          </div>

          <div class="space-y-4 flex flex-col items-center px-6">
            <p class="text-[#fabf3b] text-lg font-bold">Kettlebells</p>

            <p class="text-[#fabf3b] text-sm text-center">
              Ideal for full-body workouts, kettlebells are great for building strength, improving endurances, and enhancing coordination.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center justify-between px-56 py-48 space-y-4" id="contact">
      <div class="flex flex-col items-center space-y-8">
        <p class="text-4xl text-[#fabf3b] font-semibold">Contact Us</p>

        <p class="text-base text-[#f49e2b]">
          We'd love to hear from you! Reach out for any questions or inquiries you have.
        </p>
      </div>

      <div class="w-full max-w-md rounded-lg p-7 bg-[#1f2936] flex flex-col items-start space-y-6">
        <input 
          type="text" 
          class="px-4 py-2.5 bg-[#374150] text-base w-full rounded-lg"
          placeholder="Your Name"
        >

        <input 
          type="email" 
          class="px-4 py-2.5 bg-[#374150] text-base w-full rounded-lg"
          placeholder="Your Email"
        >

        <textarea
          class="px-4 py-2.5 bg-[#374150] text-base w-full rounded-lg h-28"
          placeholder="Your Message"
        ></textarea>

        <button class="bg-[#fabf3b] px-6 py-2.5 text-black text-base font-medium rounded-lg font-medium w-full">
          Send Message
        </button>
      </div>
    </div>

    <footer class="flex flex-col items-center space-y-3 w-full pb-6">
      <p class="text-sm text-[#fabf3b]">© 2024 PAP's Fitness Gym. All rights reserved</p>

      <div class="flex items-center space-x-3">
        <span class="bg-[#fabf3b] w-6 h-6 rounded-full"></span> 
        <span class="bg-[#fabf3b] w-6 h-6 rounded-full"></span> 
        <span class="bg-[#fabf3b] w-6 h-6 rounded-full"></span> 
      </div>
    </footer>

    <button 
      class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-lg absolute top-6 right-4"
      onclick="window.location.href='pages/auth/admin-login.php'"
    >
      Admin
    </button>
  </body>
</html>