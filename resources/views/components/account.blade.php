<div id="accountHeader" class="fixed -top-full bottom-full left-0 right-0 pl-24 pr-8 py-24 transition-all duration-500">
  <h1 class="text-4xl font-bold border-b-4 border-blue-500 w-fit">Account</h1>
</div>
<div id="accountSettings" class="fixed -bottom-full top-full left-0 right-0 pl-24 pr-8 pt-36 transition-all duration-500 z-0">
  <div class="my-4 bg-white rounded-xl p-4 border-2 border-gray-300">
    <h1 class="text-3xl font-bold border-b-4 border-indigo-500 w-fit mb-4">Profile Settings</h1>
    <label for="name" class="text-2xl font-bold">Name</label>
    <br>
    <input id="name" type="text" onkeydown="if (event.keyCode == 13) $('#submitAccount').click()" value="{{ auth()->user()->name }}" class="p-2 border-2 border-indigo-500 rounded-xl">
    <br>
    <br>
    <label for="email" class="text-2xl font-bold">Email</label>
    <br>
    <input id="email" type="text" onkeydown="if (event.keyCode == 13) $('#submitAccount').click()" value="{{ auth()->user()->email }}" class="p-2 border-2 border-indigo-500 rounded-xl">
    <br>
    <button id="submitAccount" onclick="fetch('/change-account-settings?name=' + $('#name').val() + '&email=' + $('#email').val()); confirmMessage('Account Updated')" class="p-2 bg-gray-400 rounded-xl mt-4 text-white text-2xl font-bold hover:scale-110 hover:shadow-lg hover:rounded-tr-none shadow-md transform transition-all ease-out duration-300 cursor-pointer">Save</button>
  </div>
  <hr class="border-none h-1 w-60 bg-blue-500">
  <form method="POST" action="/logout">
    @csrf
    <input type="submit" value="Log Out" class="p-2 bg-gradient-to-l from-indigo-500 to-blue-500 rounded-xl mt-4 text-white text-2xl font-bold hover:scale-110 hover:shadow-lg hover:rounded-tr-none shadow-md transform transition-all ease-out duration-300 cursor-pointer"></input>
  </form>
</div>