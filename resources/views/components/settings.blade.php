<div id="settingsHeader" class="fixed -top-full bottom-full left-0 right-0 pl-24 pr-8 py-24 transition-all duration-500">
  <h1 class="text-4xl font-bold border-b-4 border-blue-500 w-fit {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'text-white' : 'text-black' }}">Settings</h1>
</div>
<div id="settingsSettings" class="fixed -bottom-full top-full left-0 right-0 pl-24 pr-8 pt-36 transition-all duration-500 z-0 overflow-y-scroll pb-12 {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'text-white' : 'text-black' }}">
  <br>
  <label class="text-2xl font-bold border-b-4 border-indigo-500">Theme</label>
  <br>
  <br>
  <div class="flex">
    <button id="theme" value="light" onclick="changeIcon('chat'); fetch('/update-settings?theme=light'); confirmMessage('Settings Updated'); $('#pageDiv').load(location.href);" class="flex bg-white p-2 border-blue-500 border-2 text-black mr-2 rounded-xl hover:rounded-tr-none hover:scale-110 hover:shadow-lg shadow-md transition-all duration-300 font-bold">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
      </svg>
      Light Mode
    </button>
    <button id="theme" value="dark" onclick="changeIcon('chat'); fetch('/update-settings?theme=dark'); confirmMessage('Settings Updated'); $('#pageDiv').load(location.href);" class="flex bg-black p-2 border-blue-500 border-2 text-white ml-2 rounded-xl hover:rounded-tr-none hover:scale-110 hover:shadow-lg shadow-md transition-all duration-300 font-bold">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
      </svg>
      Dark Mode
    </button>
  </div>
</div>