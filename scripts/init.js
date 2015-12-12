$(document).on("ready", function () {
  let t = $("#game").load("./games/testGame.js");
  $("#game-of-life").html(t);
});
