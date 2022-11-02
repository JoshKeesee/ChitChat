<script>
  var messages = document.getElementById("messages");
  var scrolled = false;
  var isTyping = false;
  var oldName;
  var updatescroll;
  var updatemessages;
  var checktypers;
  var checkfortyping;
  var currentlyChattingWith = "All";
  changeIcon("chat");

  window.onload = function () {
    addIntervals();
  }

  function addIntervals() {
    updatemessages = setInterval(updateMessages, 1000);
    checkfortyping = setInterval(checkForTyping, 0);
  }
  
  function messageScroll() {
    messages.scrollTop = messages.scrollHeight;
  }
  
  function updateScroll() {
      if (!scrolled) {
          messageScroll();
      }
  }
  
  $("#messages").on('scroll', function() {
      var element = document.getElementById("messages");
      scrolled = element.scrollHeight - element.clientHeight >= element.scrollTop + 1;
  });
  
  function sendMessage() {
    if ($("#message").val() === "//clear-all-messages" && {{ auth()->user()->id }} === 1) {
      fetch('/clear-all-messages?to=' + currentlyChattingWith);
    } else if ($("#message").val() === "//reset-message-table" && {{ auth()->user()->id }} === 1) {
      fetch('/reset-message-table');
    } else if ($("#message").val() !== "") {
      fetch('/send-message?message=' + $("#message").val() + "&to=" + currentlyChattingWith);
    }
    $("#message").val("");
  }

  function updateMessages() {
    $("#data").load("/get-messages?to=" + currentlyChattingWith, function () {
      var data = JSON.parse($("#data").html());
      $("#message").attr("placeholder", "Message " + data["to"]);
      $("#messages").html("");
      for (i = 0; i < data["messages"].length; i++) {
        var newMessage = document.createElement("div");
        var name = document.createElement("div");
        newMessage.innerHTML = data["messages"][i]["message"];
        if (data["messages"][i]["users_id"] === JSON.stringify({{ auth()->user()->id }})) {
          newMessage.className = "bg-gradient-to-l from-indigo-500 to-blue-500 ml-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tr-none text-white text-2xl";
          name.className = "ml-auto w-fit max-w-[50%] overflow-x-hidden mx-4 text-2xl text-right";
        } else {
          newMessage.className = "bg-gray-400 mr-auto m-4 w-fit max-w-[50%] overflow-x-hidden p-3 rounded-2xl rounded-tl-none text-white text-2xl";
          name.className = "mr-auto w-fit max-w-[50%] mx-4 text-2xl text-left";
        }
        name.innerHTML = data["from"][data["messages"][i]["users_id"] - 1];
        if (oldName !== name.innerHTML || i === 0) {
          document.querySelector("#messages").appendChild(name);
          oldName = name.innerHTML;
        }
        document.querySelector("#messages").appendChild(newMessage);
      }
      if (document.querySelector("#messages").innerHTML === "") {
        document.querySelector("#messages").innerHTML = "<div class='w-full text-center text-2xl'>No messages posted yet...</div>";
      } 

      if (data["currentlyTyping"].length !== 0) {
        $("#currentlyTyping").html("");
        $("#currentlyTyping").html(data["currentlyTyping"][0]);
        for (i = 1; i < data["currentlyTyping"].length; i++) {
          $("#currentlyTyping").html($("#currentlyTyping").html() + ", " + data["currentlyTyping"][i]);
        }
        $("#currentlyTyping").html($("#currentlyTyping").html() + " is typing...");
        $("#currentlyTyping").slideDown(200);
      } else {
        $("#currentlyTyping").slideUp(200);
      }
      updateScroll();
    });
  }

  function openChat(id) {
    clearInterval(updatemessages);
    currentlyChattingWith = id;
    updatemessages = setInterval(updateMessages, 1000);
    changeIcon("chat");
  }

  function chat() {
    resetToHidden();
    document.querySelector("#message-bar").classList.replace("-bottom-full", "bottom-0");
    document.querySelector("#messages").classList.replace("bottom-full", "bottom-20");
    document.querySelector("#messages").classList.replace("-top-full", "top-0");
    setTimeout(messageScroll, 300);
    setTimeout(addIntervals, 510);
  }

  function account() {
    resetToHidden();
    document.querySelector("#accountHeader").classList.replace("bottom-full", "bottom-0");
    document.querySelector("#accountHeader").classList.replace("-top-full", "top-0");
    document.querySelector("#accountSettings").classList.replace("top-full", "top-0");
    document.querySelector("#accountSettings").classList.replace("-bottom-full", "bottom-0");
  }

  function group() {
    resetToHidden();
    document.querySelector("#groupsHeader").classList.replace("bottom-full", "bottom-0");
    document.querySelector("#groupsHeader").classList.replace("-top-full", "top-0");
    document.querySelector("#groupsSettings").classList.replace("top-full", "top-0");
    document.querySelector("#groupsSettings").classList.replace("-bottom-full", "bottom-0");
  }

  function settings() {
    resetToHidden();
    document.querySelector("#settingsHeader").classList.replace("bottom-full", "bottom-0");
    document.querySelector("#settingsHeader").classList.replace("-top-full", "top-0");
    document.querySelector("#settingsSettings").classList.replace("top-full", "top-0");
    document.querySelector("#settingsSettings").classList.replace("-bottom-full", "bottom-0");
  }

  function resetToHidden() {
    document.querySelector("#message-bar").classList.replace("bottom-0", "-bottom-full");
    document.querySelector("#messages").classList.replace("top-0", "-top-full");
    document.querySelector("#messages").classList.replace("bottom-20", "bottom-full");
    document.querySelector("#accountHeader").classList.replace("bottom-0", "bottom-full");
    document.querySelector("#accountHeader").classList.replace("top-0", "-top-full");
    document.querySelector("#accountSettings").classList.replace("top-0", "top-full");
    document.querySelector("#accountSettings").classList.replace("bottom-0", "-bottom-full");
    document.querySelector("#settingsHeader").classList.replace("bottom-0", "bottom-full");
    document.querySelector("#settingsHeader").classList.replace("top-0", "-top-full");
    document.querySelector("#settingsSettings").classList.replace("top-0", "top-full");
    document.querySelector("#settingsSettings").classList.replace("bottom-0", "-bottom-full");
    document.querySelector("#groupsHeader").classList.replace("bottom-0", "bottom-full");
    document.querySelector("#groupsHeader").classList.replace("top-0", "-top-full");
    document.querySelector("#groupsSettings").classList.replace("top-0", "top-full");
    document.querySelector("#groupsSettings").classList.replace("bottom-0", "-bottom-full");
    clearInterval(updatemessages);
    clearInterval(checkfortyping);
  }

  function confirmMessage(message) {
    $("#confirmation").html(message);
    $("#confirmation").removeClass("opacity-0");
    setTimeout(hideConfirmation, 5000);
  }

  function hideConfirmation() {
    $("#confirmation").addClass("opacity-0");
  }

  function checkForTyping() {
    if ($("#message").val().length > 0) {
      addTyper();
    } else {
      removeTyper();
    }
  }

  function addTyper() {
    if (isTyping === false) {
      fetch("/add-typer");
      isTyping = true;
    }
  }

  function removeTyper() {
    if (isTyping === true) {
      fetch("/remove-typer");
      isTyping = false;
    }
  }
  
  function changeIcon(icon) {
    resetIcons();
    $("#" + icon).toggleClass("bg-blue-500");
    $("#" + icon).html(getIconSelected(icon));
    if (icon === "chat") {
      chat();
    } else if (icon === "account") {
      account();
    } else if (icon === "group") {
      group();
    } else if (icon === "settings") {
      settings();
    }
  }

  function resetIcons() {
    $("#chat").html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>');
    $("#account").html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>');
    $("#group").html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>');
    $("#settings").html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>');
    $("#chat").removeClass("bg-blue-500");
    $("#account").removeClass("bg-blue-500");
    $("#group").removeClass("bg-blue-500");
    $("#settings").removeClass("bg-blue-500");
  }

  function openMenu() {
    $("#openmenu").toggleClass("rotate-180");
    $("#labels").toggleClass("w-56");
    $("#sidebar").toggleClass("border-r-4 border-blue-500");
  }

  function getIconSelected(thisIcon) {
    if (thisIcon === "chat") {
      return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12"><path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z" clip-rule="evenodd" /></svg>';
    } else if (thisIcon === "account") {
      return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12"><path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" /></svg>';
    } else if (thisIcon === "group") {
      return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12"><path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" /><path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" /></svg>';
    } else if (thisIcon === "settings") {
      return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12"><path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" /></svg>';
    }
  }

  window.onbeforeunload = function () {
    fetch("/remove-typer");
  };
</script>