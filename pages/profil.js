document.getElementById("modification").addEventListener("click", modifier);

function modifier(e) {
  e.preventDefault();
  let informations = document.querySelectorAll(".informations");
  let pdp = document.getElementById("nouvel_pdp");
  pdp.parentElement.removeAttribute("style");

  for (let element of informations) {
    var newElement = document.createElement("input");
    var newLabel = document.createElement("label");
    var newDiv = document.createElement("div");

    newDiv.className = "mb-3 row";
    var text = element.innerText;
    newElement.type = "text";
    newElement.id = text
      .split(":")[0]
      .trim()
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(" ", "_")
      .replace("'", "");
    newElement.name = newElement.id;
    newElement.className = "col-md-8";
    newElement.value = element.innerText.split(":")[1].trim();
    if (
      newElement.id != "nouvel_pdp" &&
      newElement.id != "complement_dadresse"
    ) {
      newElement.setAttribute("required", true);
    }

    newLabel.innerText = element.innerText.split(":")[0].trim();
    newLabel.setAttribute("for", newElement.id);
    newLabel.className = "col-md-4 form-label fw-bold";
    newLabel.style.textAlign = "left";

    newDiv.appendChild(newLabel);
    newDiv.appendChild(newElement);
    element.parentElement.replaceChild(newDiv, element);
  }
  e.target.removeEventListener("click", modifier);
  e.target.innerText = "Enregistrer";

  e.target.addEventListener("click", (e) => {
    for (let element of informations) {
      if (element.required && element.value == "") {
        consolelog(element);
        e.preventDefault();
        return;
      }
    }
  });
}
