<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
          canvas {
            width: 100%;
            position: fixed;
            top: 0;
          }
          html {
            scroll-behavior: smooth;
            background: black;
          }
          ::-webkit-scrollbar {
            width: 0;
          }
        </style>

        <link rel="icon" type="image/x-icon" href="/storage/ChitChat-logos_transparent.png" />
      
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen select-none relative z-10">

            <!-- Page Content -->
            <main>
              <div onclick="location.href = '/register'" class="cursor-pointer transition-all duration-300 rounded-xl hover:rounded-tr-none hover:scale-110 hover:shadow-lg shadow-md fixed left-4 top-4 bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2 text-white font-bold text-2xl z-10">Get Started</div>
              <img src="/storage/ChitChat-logos.jpeg" class="w-20 h-20 cursor-pointer transition-all duration-300 rounded-[50%] hover:rounded-xl hover:rounded-tr-none fixed right-4 top-2 z-10" />
              <div id="header" class="fixed top-1/3 left-0 right-0 transform text-center lg:text-8xl text-6xl text-white font-bold">
                <h1>ChitChat</h1>
                <p class="text-lg">A simple messaging app.</p>
                <div class="rounded-full bg-opacity-0 backdrop-blur-md w-20 h-20 mx-auto flex justify-center p-2 mt-8 shadow-xl">
                  <div onclick="document.querySelector('#page').scrollIntoView(true);" class="w-4/5 h-4/5 border-b-2 border-l-2 rounded-bl-md border-white transform rotate-[-45deg] hover:border-b-4 hover:border-l-4 cursor-pointer"></div>
                </div>
              </div>
              <div id="page" class="absolute z-10 top-full w-full border-t-4 border-blue-500">
                <div class="bg-gray-100 p-8 grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                  <div class="lg:mx-none lg:mb-none md:mx-none md:mb-none mb-8 mx-auto w-2/3 my-auto fade rounded-md bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-1">
                    <img src="/storage/ChitChat-logos_black.png" class="bg-white" />
                  </div>
                  <div>
                    <div class="fade ml-auto w-fit max-w-[50%] overflow-x-hidden mx-4 text-2xl text-right">ChitChat Creator</div>
                    <div class="fade bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl">Hi!</div>
                    <div class="fade bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl">Welcome to ChitChat!</div>
                    <div class="fade bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl">We are all so excited to see you here!</div>
                    <div class="fade bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl">You may be wondering, what is this??</div>
                    <div class="fade bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl">Well, glad you asked!</div>
                  </div>
                </div>
                <div class="bg-black p-16 text-white">
                  <h1 class="fade border-b-4 border-blue-500 text-5xl w-fit mb-4 font-bold">About ChitChat</h1>
                  <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-4">
                    <p class="fade text-3xl">ChitChat is a messaging app where you can connect to friends, enjoy real-time messaging, and even chat with every one else that is connected! With ChitChat, you can send messages seamlessly through our ultra-fast online servers and get your message accross the way you want!</p>
                    <div>
                      <img src="/storage/ChitChat-logos.jpeg" class="fade lg:mr-0 md:mr-0 ml-auto mr-auto w-[45%]" />
                    </div>
                  </div>
                </div>
                <div class="w-full bg-gray-100 p-16">
                  <div onclick="location.href = '/register'" class="cursor-pointer transition-all duration-300 rounded-xl hover:rounded-tr-none scale-125 hover:scale-150 hover:shadow-lg shadow-md bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2 text-white font-bold text-2xl w-fit mx-auto">Get Started</div>
                </div>
                <div class="w-full bg-black text-white text-4xl font-bold p-16 text-center">
                  &copy; Copyright <?php echo date("Y"); ?> ChitChat, LLC. All rights reserved
                </div>
              </div>
              <x-homepage-script />
            </main>
        </div>
    </body>
</html>
