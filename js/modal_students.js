const modals = document.getElementById("editStudentModal");
const editBtn = document.querySelectorAll(".edit-button");
const closeBtn = document.querySelector(".close-buttons");

editBtn.forEach((btn) => {
  // Open the modal
  btn.addEventListener("click", () => {
    modals.style.display = "block";
  });
});

// Close the modal
closeBtn.addEventListener("click", () => {
  modals.style.display = "none";
});

// Close modal when clicking outside of it
window.addEventListener("click", (event) => {
  if (event.target == modals) {
    modals.style.display = "none";
  }
});
