$("#show_password").hover(
  function functionName() {
    $("#pwd").attr("type", "text");
    $("#show_password").attr("src", "./images/eye_open.png");
  },
  function () {
    $("#pwd").attr("type", "password");
    $("#show_password").attr("src", "./images/eye_close.png");
  }
);
