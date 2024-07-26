export const dropdownButton = document.querySelector(".dropdown-btn");
export const dropdown = document.getElementById("dropdown");

/**Handles closing of dropdown menu depending on whethere the click is inside or outside the menu.
 * 
 * @param {Event} event 
 */
export function handleDropdownMenu(event) {
    if (dropdown.contains(event.target) || dropdownButton.contains(event.target)) {
    } else {
        dropdown.classList.remove("active")
        dropdown.classList.add("hidden")
    }
}