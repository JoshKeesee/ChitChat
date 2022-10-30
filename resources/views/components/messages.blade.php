<div id="messages" class="py-12 pr-4 pl-20 fixed bottom-12 right-0 left-0 overflow-y-auto top-0 pt-24 transition-all duration-300 scroll-smooth">
  <div class="w-16 h-16 border-4 border-t-blue-500 mx-auto rounded-full animate-spin"></div>
  <p class="text-2xl mt-4 w-full text-center">Loading...</p>
</div>

<div id="message-bar" class="fixed bottom-0 right-0 w-full pl-24 pr-2 py-4 flex bg-white border-t-2 border-blue-500 transition-all duration-500 z-10">
    <div id="currentlyTyping" class="absolute -top-8 font-bold"></div>
    <input id="message" onkeydown="if (event.keyCode == 13) sendMessage()"  type="text" class="w-full rounded-full px-2 -py-2 border-2 border-gray-200 text-2xl" placeholder="Message" autofocus />
    <div id="send" onclick="sendMessage()" class="hover:bg-blue-100 p-2 ml-4 rounded-full cursor-pointer transition-all">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
      </svg>
    </div>
</div>