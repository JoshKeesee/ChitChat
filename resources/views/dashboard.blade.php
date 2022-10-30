<x-app-layout>
  <div class="min-h-screen pl-24">
      <div class="bg-gradient-to-b from-white to-transparent fixed top-0 left-24 right-0 -ml-4 py-2 px-4 text-center flex z-20">
        <h1 class="text-5xl font-bold mx-auto mt-2">ChitChat</h1>
        <img onclick="location.href = '/'" src="/storage/ChitChat-logos.jpeg" class="w-20 h-20 cursor-pointer shadow-xl rounded-full transform hover:-translate-y-1 transition-all" />
      </div>
  
      <x-messages />
      <x-groups />
      <x-account />
      <x-settings />
      <div id="confirmation" class="fixed bottom-4 right-4 p-2 bg-green-500 rounded-xl opacity-0 transition-all shadow-xl text-white font-bold"></div>
  </div>
  <x-message-script />
  <div id="data" class="hidden"></div>
</x-app-layout>