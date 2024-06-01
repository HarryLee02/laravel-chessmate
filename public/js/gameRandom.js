import {Chess} from './chess.js'

var board = null
var game = new Chess()

function makeRandomMove () {
    var possibleMoves = game.moves()
  
    // game over
    if (possibleMoves.length === 0) return
  
    var randomIdx = Math.floor(Math.random() * possibleMoves.length)
    game.move(possibleMoves[randomIdx])
    board.position(game.fen())
    var audio = new Audio('../sound/move-self.mp3')
    audio.play()
    updateStatus()
    if (!game.isGameOver())
    {
      window.setTimeout(makeRandomMove, 1000)
    } else
    {
      return
    }
}

function updateStatus () {
    var moveColor = 'White'
    if (game.turn() === 'b') {
      moveColor = 'Black'
    }
    
    // checkmate?
    if (game.isCheckmate()) {
      var audio1 = new Audio('../sound/game-end.mp3')
      audio1.play()
    }
  
    // draw?
    else if (game.isDraw()) {
      var audio = new Audio('../sound/game-end.mp3')
      audio.play()
    }
    // game still on
    else {
      // check?
      if (game.isCheck()) {
          var audio = new Audio('../sound/move-check.mp3')
          audio.play()
      }
    }
}

board = Chessboard('myBoard', 'start')
makeRandomMove()