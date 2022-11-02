<div id="sidebar" class="fixed left-0 top-0 bottom-0 {{ App\Models\Setting::all()->find(auth()->user()->id)->theme == 'dark' ? 'bg-black text-white' : 'bg-white text-black' }} p-2 shadow-xl transition-all w-fit z-30">
  <x-icon-bar />
</div>