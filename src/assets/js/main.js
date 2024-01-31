$(document).ready(function () {
  $(".menu").click(function () {
    $(".header-mobile-nav").toggleClass("open");
    $(this).toggleClass("open");
  });
});
