<div id="groupsHeader" class="fixed -top-full bottom-full left-0 right-0 pl-24 pr-8 py-24 transition-all duration-500">
  <h1 class="text-4xl font-bold border-b-4 border-blue-500 w-fit {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'text-white' : 'text-black' }}">Groups</h1>
</div>
<div id="groupsSettings" class="fixed -bottom-full top-full left-0 right-0 pl-24 pr-8 pt-36 transition-all duration-500 z-0 overflow-y-scroll pb-12 {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'text-white' : 'text-black' }}">
  <div onclick="openChat('All')" class="p-3 my-4 border-4 border-blue-500 rounded-xl cursor-pointer grid grid-cols-2 transition-all duration-300 {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'bg-black hover:bg-gray-700 text-white' : 'bg-white hover:bg-gray-100 text-black' }}">
        <div>
          <div class="text-4xl font-bold">Everyone</div>
          <p>Chat with everyone</p>
        </div>
        <div class="flex justify-end my-auto">
          <div class="transition-all rounded-full {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'hover:bg-blue-500' : 'hover:bg-blue-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
              <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
  @foreach(\App\Models\User::all() as $user)
    @if(auth()->user()->id !== $user->id)
      <div onclick="openChat({{ $user->id }})" class="p-3 my-4 border-4 border-blue-500 rounded-xl cursor-pointer grid grid-cols-2 transition-all duration-300 overflow-x-hidden {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'bg-black hover:bg-gray-700 text-white' : 'bg-white hover:bg-gray-100 text-black' }}">
        <div>
          <div class="text-4xl font-bold">{{ $user->name }}</div>
          <p>{{ $user->email }}</p>
        </div>
        <div class="flex justify-end my-auto">
          <div class="transition-all rounded-full {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'hover:bg-blue-500' : 'hover:bg-blue-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
              <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
    @endif
  @endforeach
</div>