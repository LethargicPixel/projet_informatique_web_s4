const toggleBtns = document.getElementsByClassName("toggleMdp");

for (let element of toggleBtns) {
  element.addEventListener("mousedown", (e) => {
    var inputMdp =
      e.target.tagName == "BUTTON"
        ? e.target.previousElementSibling
        : e.target.parentElement.previousElementSibling;
    var icon = inputMdp.parentElement.querySelector("i");

    inputMdp.type = "text";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  });

  element.addEventListener("mouseup", (e) => {
    var inputMdp =
      e.target.tagName == "BUTTON"
        ? e.target.previousElementSibling
        : e.target.parentElement.previousElementSibling;
    var icon = inputMdp.parentElement.querySelector("i");

    inputMdp.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  });

  element.addEventListener("mouseleave", (e) => {
    var inputMdp =
      e.target.tagName == "BUTTON"
        ? e.target.previousElementSibling
        : e.target.parentElement.previousElementSibling;
    var icon = inputMdp.parentElement.querySelector("i");

    inputMdp.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  });
}
