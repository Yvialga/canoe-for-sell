import './styles/app.css';
import { handleDropdownMenu, dropdown, dropdownButton } from "./libs/navbar.js";

// https://stackoverflow.com/questions/47095433/how-to-use-event-target-matches-to-match-div-element

if (dropdown) {
    dropdownButton.addEventListener('click', (event) => {
        dropdown.classList.toggle("hidden")
        dropdown.classList.toggle("active")
    })
}

window.addEventListener("click", (event) => {
    if (dropdown && dropdown.classList.contains("active")) handleDropdownMenu(event);
})