import {Chess} from './chess.js'

var board = null
var game = new Chess()
// var $status = $('#status')
// var $fen = $('#fen')
// var $pgn = $('#pgn')
function onDragStart (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if (piece.search(/^b/) !== -1) {
    return false
  }
}
function makeRandomMove () {
  var possibleMoves = game.moves()

  // game over
  if (possibleMoves.length === 0) return

  var randomIdx = Math.floor(Math.random() * possibleMoves.length)
  game.move(possibleMoves[randomIdx])
  var audio = new Audio('public/sound/move-opponent.mp3')
  audio.play()
  $('#pgn').val(game.pgn())
  board.position(game.fen())
}

function onDrop (source, target) {
  // see if the move is legal
  try{
    var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  })
  var audio = new Audio('public/sound/move-self.mp3')
  audio.play()
  }
  catch(err)
  {
      return 'snapback'
  }
  window.setTimeout(makeRandomMove, 1000)

  updateStatus()
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
function onSnapEnd () {
  board.position(game.fen())
}

function updateStatus() {
  var status = ''
  var moveColor = 'White'
  
  
  // checkmate?
  if (game.isCheckmate()) {
    var audio = new Audio('public/sound/move-check.mp3')
    var audio1 = new Audio('public/sound/game-end.mp3')
    audio.play()
    setTimeout(()=>{
      audio1.play()
    },700);
    status = 'Game over, ' + moveColor + ' won.'
    $('.modal_placeholder').html(moveColor+' won!<br><span>Checkmate</span>')
    var modal = new bootstrap.Modal(document.getElementById('Modal'))
    modal.show()
  }

  // draw?
  else if (game.isDraw()) {
    var audio = new Audio('public/sound/game-end.mp3')
    audio.play()
    status = 'Game over, drawn position'
    $('.modal_placeholder').html('Draw!<br><span>Checkmate</span>')
    var modal = new bootstrap.Modal(document.getElementById('Modal'))
    modal.show()
  }

  // game still on
  else {

    // check?
    if (game.isCheck()) {
      var audio = new Audio('public/sound/move-check.mp3')
      audio.play()
    }
  }
  if (game.turn() === 'b') {
    moveColor = 'Black'
  }
  $('#pgn').val(game.pgn())
}


var current_piece_theme

var config = {
  draggable: true,
  position: 'start',
  orientation:'white',
  onDragStart: onDragStart,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
}
board = Chessboard('myBoard', config)

updateStatus()

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
  updateStatus()
}
)