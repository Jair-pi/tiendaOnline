const $btn_sendMsg = document.getElementById("btn_sendMsg");
const $input_msg = document.getElementById("input_msg");



//escucha tanto click como al evento de ctrl + enter
$btn_sendMsg.addEventListener("click", enviarMsg);
$input_msg.addEventListener("keydown", (ev)=>{
    if(ev.code === "Enter"){
        enviarMsg();
    }
});

//memoria del bot (lado del cliente)
const memory = [];

function randomErrorMsg(){
    const messages = [
        "Ocurrió un error al intentar conectarse con el servidor :(",
        "Ups.. parece que algo salió mal",
        "Lo lamento, parece que hay un error en el servidor, intentaré corregirlo por mi cuenta, sino regreso, llama a un humano 😨",
        "Ocurrió un error, intenta de nuevo más tarde",
        "Lamento decirte que no puedo responder a tu pregunta, parece que hay un error en el servidor 😢",
        "Recórcholis! algo anda mal en el servidor"
    ];
    const index = Math.floor(Math.random() * messages.length);
    return messages[index]
}

//función que envía mensaje
async function enviarMsg(){
    const mensaje = $input_msg.value;
    if(mensaje == null || mensaje == ""){
        return;
    }

    //determinamos la hora actual
    const date = new Date();

    let hours = date.getHours();
    const minutes = date.getMinutes();

    const AmOrPm = hours >= 12 ? ' pm' : ' am';
    hours = (hours % 12) || 12; //una forma sencilla de convertir el formato de 24 a 12 horas
    let time = hours + ":" + minutes;
    time += AmOrPm;

    //mandamos a imprimir el mensaje del usuario
    printMessage({
        msg: mensaje, time
    }, 'user');


    //se obtiene la respuesta del bot
    const response = await getResponse(mensaje, memory);
    if(response.status == "error"){
        console.log(response);

        //imprimos un mensaje de error en el chat
        printMessage({
            msg: randomErrorMsg(), time
        }, 'bot');

        return;
    }

    //mandamos a imprimir el mensaje del bot
    printMessage({
        msg: response.msg.content,time
    }, 'bot');

    if(response.msg.content != undefined){
        //guardamos el dialogo en la memoria
        memory.push(
            {
                role: "user",
                content: mensaje,
            },
            {
                role: "assistant",
                content: response.msg.content,
            }
        );
    }
}

//función para hacer que el scroll siempre apunte hacia abajo
function ScrollBottom() {
    var chat = document.querySelector(".chat-history");
    chat.scrollTop = chat.scrollHeight;
}


function printMessage(content = {msg, time}, rol){
    //contenedor del chat
    const $chat_cont = document.getElementById("chat_cont");

    const fragment = new DocumentFragment();
    const li = document.createElement("li");

    if(rol === "user"){
        li.innerHTML = `
            <div class="message-data text-end">
                <span class="message-data-time">${content.time}, Today</span>
                <img src="chatbotUI/src/user_img.jpg" alt="avatar">
            </div>
            <div class="message other-message float-right">${content.msg}</div>
        `;
        $input_msg.value = ""; //vaciamos el mensaje escrito por el usuario

    }else if(rol == 'bot'){
        li.innerHTML = `
            <div class="message-data">
                <span class="message-data-time">${content.time}, Today</span>
            </div>
            <div class="message my-message">${content.msg}</div>
        `;
    }
    li.classList.add("clearfix");
    fragment.appendChild(li);

    $chat_cont.appendChild(fragment);
    //apuntamos el scroll al último chat
    ScrollBottom();
}



async function getResponse(msg, memory){
    const init = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        mode: "cors",
        body: JSON.stringify({prompt: msg, memory: memory}),
    }
    try{
        const response = await fetch("http://localhost:3000/api/chatbot", init);
        return await response.json();
    }catch(err){
        return {status: "error", msg: err};
    }
    
}



