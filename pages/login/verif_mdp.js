function verifMdp() {
  if (inputMdp.value === confirmMdp.value) {
    confirmMdp.style.border = "1px solid green";
    liste_verif_informations.set(confirmMdp, true);
  } else {
    confirmMdp.style.border = "1px solid red";
    liste_verif_informations.set(confirmMdp, false);
  }
  verifSubmit();
}

function verifSubmit() {
  var compte_valide = 0;
  for (let valeur of liste_verif_informations.values()) {
    compte_valide += valeur;
  }
  submit.disabled = compte_valide !== liste_verif_informations.size;
}

let inputMdp = document.getElementById("motdepasse");
let submit = (btn = document.getElementById("confirmation"));
submit.disabled = true;

let liste_input = document.getElementsByTagName("input");

liste_input = Array.from(liste_input).filter(
  (element) => element.type !== "password"
);

let liste_verif_informations = new Map();

for (let element of liste_input) {
  if (element.required) {
    element.style.border = "1px solid red";
    liste_verif_informations.set(element, false);

    element.addEventListener("input", () => {
      if (element.value.length > 0) {
        element.style.border = "1px solid green";

        liste_verif_informations.set(element, true);
      } else {
        element.style.border = "1px solid red";

        liste_verif_informations.set(element, false);
      }
      verifSubmit();
    });
  }
}

const li8caractere = document.getElementById("8caractere");
const liMaj = document.getElementById("maj");
const liMin = document.getElementById("min");
const liChiffre = document.getElementById("chiffre");
const liSpeciale = document.getElementById("speciale");
const liEspace = document.getElementById("espace");

let liste_verif_mdp = document.getElementsByClassName("verif");
let valide = Array(liste_verif_mdp.length).fill(false);

for (let element of liste_verif_mdp) {
  element.style.color = "red";
}
liEspace.style.color = "green";

let confirmMdp = document.getElementById("confirmation_motdepasse");

liste_verif_informations.set(inputMdp, false);
liste_verif_informations.set(confirmMdp, false);

verifMdp();
inputMdp.style.border = "1px solid red";

confirmMdp.addEventListener("input", verifMdp);

inputMdp.addEventListener("input", () => {
  var mdp = inputMdp.value;

  if (mdp.length >= 8) {
    if (mdp.length > 20) {
      inputMdp.value = mdp.slice(0, 20);
    }
    valide[0] = true;
    li8caractere.style.color = "green";
  } else {
    valide[0] = false;
    li8caractere.style.color = "red";
  }

  if (/[A-Z]/.test(mdp)) {
    valide[1] = true;
    liMaj.style.color = "green";
  } else {
    valide[1] = false;
    liMaj.style.color = "red";
  }

  if (/[a-z]/.test(mdp)) {
    valide[2] = true;
    liMin.style.color = "green";
  } else {
    valide[2] = false;
    liMin.style.color = "red";
  }

  if (/\d/.test(mdp)) {
    valide[3] = true;
    liChiffre.style.color = "green";
  } else {
    valide[3] = false;
    liChiffre.style.color = "red";
  }

  if (/[!@#$%^&*(),.?":{}|<>]/.test(mdp)) {
    valide[4] = true;
    liSpeciale.style.color = "green";
  } else {
    valide[4] = false;
    liSpeciale.style.color = "red";
  }

  if (/\s/.test(mdp)) {
    valide[5] = false;
    liEspace.style.color = "red";
  } else {
    valide[5] = true;
    liEspace.style.color = "green";
  }
  verifMdp();

  for (let i = 0; i < valide.length; i++) {
    if (!valide[i]) {
      inputMdp.style.border = "1px solid red";
      liste_verif_informations.set(inputMdp, false);
      return;
    }
  }
  liste_verif_informations.set(inputMdp, true);
  inputMdp.style.border = "1px solid green";
});
