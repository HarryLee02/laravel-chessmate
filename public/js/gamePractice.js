import {Chess} from './chess.js'

var board = null
var game = new Chess()

function onDragStartWhite (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false

  // only pick up White pieces to move
  if (piece.search(/^b/) !== -1) {
    return false
  }
}
function onDragStartBlack (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.isGameOver()) return false
  // only pick up Black pieces to move
  if (piece.search(/^w/) !== -1) {
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
    var audio = new Audio('../sound/move-self.mp3')
    audio.play()
  }
  catch(err)
  {
    return 'snapback'
  }
  updateStatus()
}

function onSnapEnd () {
  board.position(game.fen())
}

function updateStatus() {
  var moveColor = 'White'
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
  if (game.turn() === 'b') {
    moveColor = 'Black'
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
    orientation: 'black',
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

$('#flip').on('click', board.flip)

$('#clear').on('click', board.clear)