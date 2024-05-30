import { createServer } from "http";
import { parse } from "url";
import { WebSocket, WebSocketServer } from "ws";

const server = createServer();
const wss1 = new WebSocketServer({ noServer: true });

const rooms = new Map();
const users = new Map();
wss1.on("connection", function connection(ws, request) {
  const uuuid = Math.random() * 100;
  ws.on("error", console.error);
  ws.on("message", (data, isBinary) => {
    handleMessage(ws, data);
  });
  ws.on("close", () => {
    console.log("user disconnect successfully");
    removeRoom(ws);
  });
});

const removeRoom = (ws) => {
  rooms.forEach((usersInRoom, roomId) => {
    const index = usersInRoom.indexOf(ws);
    if (index !== -1) 
    {
      usersInRoom.splice(index, 1);
      var userLeave = users.get(roomId)[index];
      users.get(roomId).splice(index, 1);
      if (usersInRoom.length === 0) {
        // Nếu không còn người dùng trong phòng, xóa phòng
        rooms.delete(roomId);
        users.delete(roomId);
        console.log("Room", roomId, "has been removed");
      }
      if (usersInRoom.length === 1)
      {
        console.log("Reset board game");
        sendMessage(roomId, {
        type: "reset",
        message: "User " + userLeave + " just left the room " + roomId + ". Game will be reset!",
        });
      } 
    }
  });
};

const handleMessage = (ws, data) => {
  try {
    if (data) {
      const message = JSON.parse(data);
      console.log("call the fuction of the join room", message);
      if (message.type === "join_room") {
        console.log("called the function successfully");
        joinRoom(ws, message.roomId, message.userId);
      } else if (message.type === "leave_room") {
        leaveRoom(ws, message.roomId);
      } else if (message.type === "chat" || message.type === "game" || message.type === "endgame") {
        sendMessage(message.roomId, message);
      }
    }
  } catch (error) {
    console.error("Invalid json format");
  }
};
const sendMessage = (roomId, message) => {
  console.log("send the message", roomId, message);
  if (rooms.has(roomId)) {
    rooms.get(roomId).map((soc) => {
      soc.send(JSON.stringify(message));
    });
  } else {
    return;
  }
};
const joinRoom = (ws, roomId, userId) => {
  if (!rooms.has(roomId)) {
    rooms.set(roomId, []);
    users.set(roomId, []);
  }
  if (rooms.get(roomId).length >= 2) {
    // Phòng đã đầy, không thể thêm người dùng mới
    console.log("Room is full, cannot add new user");
    broadcastFailMSG(ws, {
      type: "fail",
      message: "Room "+ roomId + " is full",
    });

    return;
  }
  else if (rooms.get(roomId).length == 1)
  {
    rooms.get(roomId).push(ws);
    users.get(roomId).push(userId);
    broadcastToRoom(roomId, {
    type: "info",
    color: "black",
    userId,
    message: "User "+ userId + " added successfully",
    });
    return;
  }
  // rooms.get(roomId).add(ws);
  rooms.get(roomId).push(ws);
  users.get(roomId).push(userId);
  broadcastToRoom(roomId, {
    type: "info",
    color: "white",
    userId,
    message: "User "+ userId + " added successfully",
  });
};
function broadcastFailMSG(ws, message) {
    ws.send(JSON.stringify(message));
}
function broadcastToRoom(roomId, message) {
  console.log("broad cast the mesage", message);
  console.log("this is the rooms", rooms);
  if (rooms.has(roomId))
  {
    rooms.get(roomId).map((soc) => {
      soc.send(JSON.stringify(message));
    });
  } else
  {
    return;
  }
}
const leaveRoom = (ws, roomId, userId) => {
  if (rooms.has(roomId))
  {
    rooms.delete(roomId);
    users.delete(roomId); 
  } else {
    return;
  }
};
server.on("upgrade", function upgrade(request, socket, head) {
  // console.log("req headers", request.headers);
  wss1.handleUpgrade(request, socket, head, function done(ws) {
    wss1.emit("connection", ws, request);
  });
});

server.listen(6789, () => {
  console.log("application is listening on the port 6789");
});