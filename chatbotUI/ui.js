const $chatUI = document.getElementById("chatUI"); //contenedor padre del chat

const $chat_header = document.getElementById("chat_header"); //cabecera del chat

$chat_header.addEventListener("click", ()=>$chatUI.classList.toggle("chat_collapse"));
