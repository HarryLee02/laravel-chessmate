import { onDrop2 } from '../js/gameOnline.js';
import { restartgame } from '../js/gameOnline.js';

const wsUrl = window.location.protocol === 'https:' ? 'wss' : 'ws';
const port = process.env.PORT || 3000; // Use the Heroku-assigned port or a default (e.g., 3000)
const ws = new WebSocket(`${wsUrl}://${window.location.hostname}:${port}`);

ws.onopen = () => {
  console.log("Connected to WebSocket server");
};
ws.onmessage = (event) => {
  const messages_view = document.getElementById("messages");
  const message = JSON.parse(event.data);
  if (message.type === "info") 
  {
    messages_view.innerHTML += `
<p><strong>${message.message}</strong></p>`;
    const userId = document.getElementById("userId").value;
      document.getElementById("roomId").disabled = true;
    document.getElementById("userId").disabled = true;
    var button =  document.getElementById("joinRoomBtn") ;
    button.disabled = true; 
    if(message.color === "white")
      {
        if (userId === message.userId)
          { 
            onDrop2("", "", 0, 1)
          }
      }
    else if(message.color === "black")
      {
        if (userId === message.userId)
          {
            onDrop2("", "", 0, 2)
          }
      }
  } else 
  if (message.type === "chat") 
  {
    messages_view.innerHTML += `
<p>
  <strong>${message.userId}:</strong> ${message.message}
</p>`;
  }else 
  if (message.type === "fail") 
  {
    messages_view.innerHTML += `
    <p>${message.message}</p>`;
      }
      else 
      if (message.type === "game") 
      {
        const userId = document.getElementById("userId").value;
        if (userId === message.userId)
        {
          
          //console.log(message.from, message.to); 
        }
        else 
        {
          onDrop2(message.from, message.to, 0, 0);
        }
      }else 
      if (message.type === "reset")
        {
          messages_view.innerHTML += `
          <p><strong>${message.message}</strong></p>`;
          onDrop2("", "", 1, 0);   
        }else
        if(message.type === "endgame")
        {
          const userId = document.getElementById("userId").value;
          if(message.endgame === 1)
          {
            if (userId === message.userId)
            {
              messages_view.innerHTML += `
            <p><strong>You lose</strong></p>`;
            }

            else 
            {
              messages_view.innerHTML += `
              <p><strong>Your opponent surrendered. You win</strong></p>`;
              restartgame();
            }
          }
          else if(message.endgame === 2)
            {
              if (userId === message.userId)
                {
                  messages_view.innerHTML += `
                <p><strong>Time out. You lose</strong></p>`;
                }
    
                else 
                {
                  messages_view.innerHTML += `
                  <p><strong>Your opponent time out. You win</strong></p>`;
                  restartgame();
                }
            }
        }
        
  messages_view.scrollTop = messages_view.scrollHeight;
};
ws.onclose = () => {
  console.log("Disconnected from WebSocket server");
};

export function sendCoord(from, to) {
  const roomId = document.getElementById("roomId").value;
  const userId = document.getElementById("userId").value;
  if (message && roomId && userId && from && to) {
    ws.send(JSON.stringify({
      type: "game",
      roomId,
      userId,
      from,
      to
    }));
  }
};
export function ggwp(endgame){
  const roomId = document.getElementById("roomId").value;
  const userId = document.getElementById("userId").value;
  if (message && roomId && userId) {
    ws.send(JSON.stringify({
      type: "endgame",
      roomId,
      userId,
      endgame
    }));
  }
};

window.onload=function(){
  document.getElementById("message")
  .addEventListener("keydown", function (event)
  {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("sendMessageBtn").click();
    }
  });
  document.getElementById("joinRoomBtn").onclick = function joinRoom() {
    const roomId = document.getElementById("roomId").value;
    const userId = document.getElementById("userId").value;
    if (roomId && userId) {
      ws.send(JSON.stringify({
        type: "join_room",
        roomId,
        userId
      }));
    }
  }
  document.getElementById("sendMessageBtn").onclick =  function sendMessage()  {
    const roomId = document.getElementById("roomId").value;
    const userId = document.getElementById("userId").value;
    const message = document.getElementById("message").value;
  
    console.log("Sending message to room", roomId, ":", message);
    if (message && roomId && userId) {
      ws.send(JSON.stringify({
        type: "chat",
        roomId,
        userId,
        message
      }));
      
      document.getElementById("message").value = "";
    }
  }
}
