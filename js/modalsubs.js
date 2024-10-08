// Get modal element
const modal = document.getElementById("addSubjectModal");

// Get open modal button
const addButton = document.querySelector(".add-button");

// Get close button
const closeButton = document.querySelector(".close-button");

// Listen for open click
addButton.addEventListener("click", () => {
  modal.style.display = "block";
});

// Listen for close click
closeButton.addEventListener("click", () => {
  modal.style.display = "none";
});

// Listen for outside click
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});
