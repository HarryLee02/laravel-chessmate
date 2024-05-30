import {BLACK, Chess} from './chess.js'
import { sendCoord } from '../ChatRoomServer/chat.js';
import { ggwp } from '../ChatRoomServer/chat.js';
var board = null
var game = new Chess()
var $status = $('#status')
var $fen = $('#fen')
var $pgn = $('#pgn')
var isFirst = 0;
let countdown1;
let time1 = 600;
let isRunning1 = false;
const timerElement1 = document.getElementById('timer1')
let countdown2;
let time2 = 600;
let isRunning2 = false;
const timerElement2 = document.getElementById('timer2')
function onDragStart (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false
  }
}
function onDragStartWhite (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if (( piece.search(/^b/) !== -1)) {
    return false
  }
}
function onDragStartBlack (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if ((piece.search(/^w/) !== -1)) {
    return false
  }
}
function makeRandomMove () {
  var possibleMoves = game.moves()

  // game over
  if (possibleMoves.length === 0) return

  var randomIdx = Math.floor(Math.random() * possibleMoves.length)
  game.move(possibleMoves[randomIdx])
  board.position(game.fen())
  var audio = new Audio('./public/sound/move-opponent.mp3')
  audio.play()
  updateStatus()
}
function oppositePosition(position)
{
  var letter = position.charAt(0);
  var number = parseInt(position.charAt(1));

  var oppositeLetter = String.fromCharCode('h'.charCodeAt(0) - (letter.charCodeAt(0) - 'a'.charCodeAt(0)));

  var oppositeNumber = 8 - (number - 1);

  var oppositePosition = oppositeLetter + oppositeNumber;

  return oppositePosition;
}
export function onDrop2 (source, target, check, color) {
  // see if the move is legal
  if(color === 0)
  {
    if(check === 0)
    {
    /*if(isFirst === 0)
      {
        game._turn = BLACK
        isFirst = 2
      }*/
    console.log("da vo ham ondrop2");
    clearInterval(countdown1);
    isRunning1 = false;
    startCountdown2();
        isRunning2 = true;
    try{
      var move = game.move({
      //from: oppositePosition(source),
      from:source,
      to:target,
      //to: oppositePosition(target),
      promotion: 'q' // NOTE: always promote to a queen for example simplicity
    })
      board.position(game.fen())
      var audio = new Audio('./public/sound/move-self.mp3')
      audio.play()
    }
    catch(err)
    {
      return 'snapback'
    }
    //window.setTimeout(makeRandomMove, 700)
    }
    else if (check === 1)
      {
        clearInterval(countdown2);
        isRunning2 = false;
        clearInterval(countdown1);
        isRunning1 = false;
        timerElement1.innerHTML = `10:00`;
        timerElement2.innerHTML = `10:00`;   
        var config = {
          pieceTheme: current_piece_theme,
          draggable: true,
          position: 'start',
          onDragStart: onDragStartWhite,
          onDrop: onDrop,
          onSnapEnd: onSnapEnd
        }
        board = Chessboard('myBoard', config)
        game.reset()
      }
  }
  // illegal move
  // if (move === null) 
  else if(color === 1)
  {
    var config = {
      draggable: true,
      position: 'start',
      orientation: 'white',
      onDragStart: onDragStartWhite,
      onDrop: onDrop,
      onSnapEnd: onSnapEnd
    }
    board = Chessboard('myBoard', config)
    
  }
  else if(color === 2)
  {
    var config = {
      draggable: true,
      position: 'start',
      orientation: 'black',
      onDragStart: onDragStartBlack,
      onDrop: onDrop,
      onSnapEnd: onSnapEnd
    }
    board = Chessboard('myBoard', config)
    
  }
  updateStatus()
}

function onDrop (source, target) {
  // see if the move is legal
  if(isFirst === 0)
    {
      isFirst = 1;
    }
  try{
    var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  })
    var audio = new Audio('./public/sound/move-self.mp3')
    audio.play()
  }
  catch(err)
  {
    return 'snapback'
  }
  sendCoord(source, target)
  //window.setTimeout(makeRandomMove, 700)
    clearInterval(countdown2);
    isRunning2 = false;
    startCountdown1();
        isRunning1 = true;
  // illegal move
  // if (move === null) 

  updateStatus()
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
function onSnapEnd () {
  board.position(game.fen())
}

function updateStatus () {
  var status = ''

  var moveColor = 'White'
  if (game.turn() === 'b') {
    moveColor = 'Black'
  }
  
  // checkmate?
  if (game.isCheckmate()) {
    var audio = new Audio('./public/sound/move-check.mp3')
    var audio1 = new Audio('./public/sound/game-end.mp3')
    audio.play()
    setTimeout(()=>{
      audio1.play()
    },700);
    status = 'Game over, ' + moveColor + ' is in checkmate.'
    var config = {
      pieceTheme: current_piece_theme,
      draggable: true,
      position: 'start',
      onDragStart: onDragStart,
      onDrop: onDrop,
      onSnapEnd: onSnapEnd
    }
    board = Chessboard('myBoard', config)
    game.reset()
  }

  // draw?
  else if (game.isDraw()) {
    var audio = new Audio('./public/sound/game-end.mp3')
    audio.play()
    status = 'Game over, drawn position'
  }

  // game still on
  else {
    status = moveColor + ' to move'

    // check?
    if (game.isCheck()) {
      var audio = new Audio('./public/sound/move-check.mp3')
      audio.play()
      status += ', ' + moveColor + ' is in check'
    }
  }

  $status.html(status)
  $fen.html(game.fen())
  // pgn = pgn.split(/\s(?=[^\d\.\s]*\d\.)/);
  // pgn = pgn.join('\n')
  $pgn.html(game.pgn())
}
export function restartgame(){
  clearInterval(countdown2);
    isRunning2 = false;
    clearInterval(countdown1);
        isRunning1 = false;
        timerElement1.innerHTML = `10:00`;
        timerElement2.innerHTML = `10:00`;   
  var config = {
    pieceTheme: current_piece_theme,
    draggable: true,
      position: 'start',
      orientation: 'black',
      onDragStart: onDragStartBlack,
      onDrop: onDrop,
      onSnapEnd: onSnapEnd
  }
  board = Chessboard('myBoard', config)
  game.reset()
  updateStatus()
}
function startCountdown1() {
  countdown1 = setInterval(() => {
      time1--;
      let second = time1 % 60;
      let min = Math.floor(time1/60);
      timerElement1.innerHTML = `${min}:${second}`;
      }, 1000);
      if (time2 === 0) {
        clearInterval(countdown1);
            isRunning1 = false;
      }
}
function startCountdown2() {
  countdown2 = setInterval(() => {
      time2--;
      let second = time2 % 60;
      let min = Math.floor(time2/60);
      timerElement2.innerHTML = `${min}:${second}`;
      if (time2 === 0) {
          ggwp(2)
          clearInterval(countdown2);
          isRunning2 = false;
          clearInterval(countdown1);
          isRunning1 = false;
          timerElement1.innerHTML = `10:00`;
          timerElement2.innerHTML = `10:00`;   
          var config = {
          pieceTheme: current_piece_theme,
          draggable: true,
          position: 'start',
          orientation: 'white',
          onDragStart: onDragStartWhite,
          onDrop: onDrop,
          onSnapEnd: onSnapEnd
          }
          board = Chessboard('myBoard', config)
          game.reset()
          updateStatus()
      }
  }, 1000);
}
var current_piece_theme
var config = {
  pieceTheme: current_piece_theme,
  draggable: true,
  position: 'start',
  onDragStart: onDragStart,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
}
board = Chessboard('myBoard', config)


// $('#setRuyLopezBtn').on('click', function () {
//   var config = {
//     draggable: true,
//     position: 'r1bqkbnr/pppp1ppp/2n5/1B2p3/4P3/5N2/PPPP1PPP/RNBQK2R',
//     onDragStart: onDragStart,
//     onDrop: onDrop,
//     onSnapEnd: onSnapEnd
//   }
//   board = Chessboard('myBoard', config)
//   game.load('r1bqkbnr/pppp1ppp/2n5/1B2p3/4P3/5N2/PPPP1PPP/RNBQK2R w KQkq d6 0 2')
// })


$('#changeTheme').on('click', function () {
  var randomNumber = Math.floor(Math.random()*8);
  var randomTheme = theme_array[randomNumber%8];
  var config = {
    pieceTheme: randomTheme,
    draggable: true,
    position: game.fen(),
    onDragStart: onDragStart,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
  }
  current_piece_theme = randomTheme
  board = Chessboard('myBoard', config)
  game.load(game.fen())
  // game.load('r1bqkbnr/pppp1ppp/2n5/1B2p3/4P3/5N2/PPPP1PPP/RNBQK2R w KQkq d6 0 2')
})
$('#restart').on('click', function () {
  ggwp(1)
  clearInterval(countdown2);
    isRunning2 = false;
    clearInterval(countdown1);
        isRunning1 = false;
        timerElement1.innerHTML = `10:00`;
        timerElement2.innerHTML = `10:00`;   
  var config = {
    pieceTheme: current_piece_theme,
    draggable: true,
    position: 'start',
    orientation: 'white',
    onDragStart: onDragStartWhite,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
  }
  board = Chessboard('myBoard', config)
  game.reset()
  updateStatus()
}
)