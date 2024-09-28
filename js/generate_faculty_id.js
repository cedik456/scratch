function generateFacultyId(length) {
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // Uppercase letters and digits
  let result = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    result += characters[randomIndex]; // Append random character
  }

  return result; // Return the generated ID
}

// Automatically generate and display the faculty ID when the page loads
document.addEventListener("DOMContentLoaded", function () {
  const facultyIdInput = document.getElementById("faculty_id");
  facultyIdInput.value = generateFacultyId(6); // Generate a 6-character ID
});
