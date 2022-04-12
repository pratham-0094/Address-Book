$("#show_password").hover(
  function functionName() {
    $("#pwd").attr("type", "text");
    $("#cfrmpwd").attr("type", "text");
    $("#show_password").attr("src", "./images/eye_open.png");
  },
  function () {
    $("#pwd").attr("type", "password");
    $("#cfrmpwd").attr("type", "password");
    $("#show_password").attr("src", "./images/eye_close.png");
  }
);

function signup(e) {
  console.log("hello world");
  window.location.href =
    "http://localhost/Mini%20Project/AddressBook/AddressBook.html";
}
