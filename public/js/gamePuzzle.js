import {Chess} from './chess.js'

var board = null
var game = new Chess()
var $status = $('#status')
var $fen = $('#fen')
var $pgn = $('#pgn')

function onDragStart (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false
  }
}

function onDrop (source, target) {
  // see if the move is legal
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

  console.log($status)
  $fen.html(game.fen())
  
  $pgn.html(game.pgn())
}


// var current_piece_theme
let string = 'r2r2kb/2q2p1p/n1p3pB/1pn1P1N1/p3P3/2P3NP/PPB3P1/R4QK1 b - - 0 23'
let orientation = string.split(' ')[1]
if (orientation === 'w')
{
  orientation = 'black'
} else {
  orientation = 'white'
}
var config = {
  draggable: true,
  orientation: orientation,
  position: string.split(' ')[0],
  onDragStart: onDragStart,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
}
board = Chessboard('myBoard', config)
game.load('r2r2kb/2q2p1p/n1p3pB/1pn1P1N1/p3P3/2P3NP/PPB3P1/R4QK1 b - - 0 23')
game.move('c7e5')
board.position(game.fen())
updateStatus()

