var timeleft = 10;
var Timer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(Timer);
    updateTimerValue("Finished");
    redirectScore();
  } else {
    updateTimerValue(timeleft);
  }
  timeleft -= 1;
}, 1000);
