const savedDarkMode = localStorage.getItem("darkMode");
let darkMode = savedDarkMode === "true";

const mode = document.getElementById("mode_icon");
const container = document.getElementById("container");
const image = document.getElementById("dev-image");

function applyDarkMode() {
  if (darkMode) {
    container.classList.add("container-dark");
    mode.classList.add("fa-sun");
    mode.classList.remove("fa-moon");
    image.src = "../../assets/devchallenges-light.svg";
  } else {
    container.classList.remove("container-dark");
    mode.classList.remove("fa-sun");
    mode.classList.add("fa-moon");
    image.src = "../../assets/devchallenges.svg";
  }
}

function toggleDarkMode() {
  darkMode = !darkMode;
  localStorage.setItem("darkMode", darkMode);

  applyDarkMode();
}

mode.addEventListener("click", toggleDarkMode);

applyDarkMode();
