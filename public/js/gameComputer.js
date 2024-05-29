import {Chess} from './chess.js'

var board = null
var game = new Chess()
function onDragStartWhite (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if (piece.search(/^b/) !== -1) {
    return false
  }
}
function onDragStartBlack (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up pieces for the side to move
  if (piece.search(/^w/) !== -1) {
    return false
  }
}

function makeRandomMove () {
  var possibleMoves = game.moves()

  // game over
  if (possibleMoves.length === 0) return

  var randomIdx = Math.floor(Math.random() * possibleMoves.length)
  game.move(possibleMoves[randomIdx])
  var audio = new Audio('../sound/move-opponent.mp3')
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
  var audio = new Audio('../sound/move-self.mp3')
  audio.play()
  }
  catch(err)
  {
      return 'snapback'
  }
  window.setTimeout(makeRandomMove, 700)

  updateStatus()
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
function onSnapEnd () {
  board.position(game.fen())
}

function updateStatus() {
  var moveColor = 'White'
if (game.turn() === 'b') {
    moveColor = 'Black'
  }
  
  // checkmate?
  if (game.isCheckmate()) {
    var audio1 = new Audio('../sound/game-end.mp3')
    audio1.play()
    $('.modal_placeholder').html(moveColor+' won!<br><span>Checkmate</span>')
    var modal = new bootstrap.Modal(document.getElementById('Modal'))
    modal.show()
  }

  // draw?
  else if (game.isDraw()) {
    var audio = new Audio('../sound/game-end.mp3')
    audio.play()
    if (game.isStalemate()) {
      $('.modal_placeholder').html('Draw!<br><span>Stalemate!</span>')
    } else if (game.isInsufficientMaterial()) {
      $('.modal_placeholder').html('Draw!<br><span>Insufficient Material!</span>')
    } else if (game.isThreefoldRepetition()) {
      $('.modal_placeholder').html('Draw!<br><span>Threefold Repetition!</span>')
    }
    var modal = new bootstrap.Modal(document.getElementById('Modal'))
    modal.show()
  }

  // game still on
  else {

    // check?
    if (game.isCheck()) {
      var audio = new Audio('../sound/move-check.mp3')
      audio.play()
    }
  }
  $('#pgn').val(game.pgn())
}

var config = {
  draggable: true,
  position: 'start',
  orientation:'white',
  onDragStart: onDragStartWhite,
  onDrop: onDrop,
  onSnapEnd: onSnapEnd
}
board = Chessboard('myBoard', config)

updateStatus()

$('#black').on('click', function () {
  var config = {
    orientation:'black',
    draggable: true,
    position: 'start',
    onDragStart: onDragStartBlack,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
  }
  board = Chessboard('myBoard', config)
  game.reset()
  makeRandomMove()
  updateStatus()
})

$('#white').on('click', function () {
  var config = {
    orientation:'white',
    draggable: true,
    position: 'start',
    onDragStart: onDragStartWhite,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
  }
  board = Chessboard('myBoard', config)
  game.reset()
  updateStatus()
})

$('#resign').on('click', function () {
  var audio = new Audio('../sound/game-end.mp3')
  audio.play()
  $('.modal_placeholder').html('You lost!<br><span>Resigned</span>')
  var modal = new bootstrap.Modal(document.getElementById('Modal'))
  modal.show()
  var config = {
    draggable: true,
    position: 'start',
    onDragStart: onDragStartWhite,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
  }
  board = Chessboard('myBoard', config)
  game.reset()
  updateStatus()
})
