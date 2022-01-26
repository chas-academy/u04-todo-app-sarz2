(function () {
  let buttons = document.getElementsByClassName("done");
  for (let i = 0; i < buttons.length; i++) {
    if (buttons[i]) {
      buttons[i].addEventListener("click", () => changeColor(buttons[i]));
      function changeColor(doneElement) {
        if (doneElement.parentElement) {
          doneElement.parentElement.style.backgroundColor = "green";
        }
      }
    }
  }
})();
