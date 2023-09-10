let buttonColours = ["red", "blue", "green", "yellow"];
let randomChosenColour;
let gamePattern = [];
let userClickedPattern = [];
let gameStarted = false;
let level = 0;


$(document).on('keydown', function()
{
  if(!gameStarted && level == 0){
    gameStarted = true;
    nextSequence();
  }
});


$('.btn').on('click', function(){
  let userChosenColour = ($(this).attr('id'));
  userClickedPattern.push(userChosenColour);
  playSound(userChosenColour);
  animatePress(userChosenColour);
  checkAnswer(userClickedPattern.length-1);
})

function nextSequence(){
  let randomNumber = Math.floor(Math.random()*3);

  randomChosenColour = buttonColours[randomNumber];
  gamePattern.push(randomChosenColour);

  $('#' + randomChosenColour).fadeOut(50).fadeIn(50);
  playSound(randomChosenColour);
  level += 1;
  $('h1').text('Level ' + level);
}

function checkAnswer(currentLevel){
  if(userClickedPattern[currentLevel]!=gamePattern[currentLevel]){
    //gameover
    playSound('wrong');
    $('body').toggleClass('game-over');
    setTimeout(function(){
      $('body').toggleClass('game-over');
    }, 200);
    $('h1').text("Game Over, Press Any Key to Restart");
    startOver();
  }else{
    if(currentLevel == gamePattern.length-1){
      userClickedPattern = [];
      setTimeout(function(){
        nextSequence();
      }, 100);
    }
  }
}

function startOver(){
  gamePattern = [];
  userClickedPattern = [];
  level = 0;
  gameStarted = false;
}

function playSound(colour){
  let sound;
  sound = new Audio('sounds/' + colour +'.mp3');
  sound.play();
}

function animatePress(currentColour){
  $('#' + currentColour).toggleClass('pressed');
  setTimeout(function(){
    $('#' + currentColour).toggleClass('pressed');
  }, 50);
}
