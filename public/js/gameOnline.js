import {BLACK, Chess} from './chess.js'
import { sendCoord } from '../ChatRoomServer/chat.js';

var board = null
var game = new Chess()
var $opening = $('#opening')
var isFirst = 0;
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
export function onDrop2 (source, target, check, color) {
  // see if the move is legal
  if(color === 0)
  {
    if(check === 0)
    {
    
    console.log("da vo ham ondrop2");
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

}


var current_piece_theme

