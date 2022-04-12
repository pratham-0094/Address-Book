function close_home() {
  $(".search_box").css("display", "none");
  $(".display_box").css("display", "none");
  $(".add_box").css("display", "block");
}
function close_search() {
  $(".add_box").css("display", "none");
  $(".display_box").css("display", "none");
  $(".search_box").css("display", "flex");
}
function close_contact() {
  $(".search_box").css("display", "none");
  $(".add_box").css("display", "none");
  $(".display_box").css("display", "flex");
}

document.getElementById("home").addEventListener("click", close_home);
document.getElementById("search").addEventListener("click", close_search);
document.getElementById("contact").addEventListener("click", close_contact);
