(function (jQuery) {window.$ = jQuery.noConflict();})(jQuery);

console.log('hello');

// const cards = document.querySelectorAll(".content-card");
// cards.forEach(function(card) {
//   const mainLink = card.querySelector(".main-link");
//   const clickableElements = Array.from(card.querySelectorAll("a")); 
//   //we are using 'a' here for simplicity but ideally you should put a class like 'clickable' on every clicable element inside card(a, button) and use that in query selector

//   clickableElements.forEach((ele) =>
//     ele.addEventListener("click", (e) => e.stopPropagation())
//   );

//   function handleClick(event) {
//     const noTextSelected = !window.getSelection().toString();
//     if (noTextSelected) {
//       mainLink.click();
//     }
//   }

//   card.addEventListener("click", handleClick);
// });

function toggleDrawer() {
  if (!($(".drawer-toggle").hasClass("menu-expand"))) {
    $(".drawer-toggle").addClass("menu-expand");
    // actions when menu is toggled on
    $("#mSidebar").css("display", "block");
  } else {
    $(".drawer-toggle").removeClass("menu-expand");
    // actions when menu is toggled off
    $("#mSidebar").css("display", "none");

  }
}