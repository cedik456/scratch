document.getElementById("dob").addEventListener("change", function () {
  const dobInput = this.value; // Get the value of the date input
  if (dobInput) {
    const dob = new Date(dobInput); // Create a Date object from the input
    const today = new Date(); // Get today's date
    let age = today.getFullYear() - dob.getFullYear(); // Calculate initial age

    // Check if the birthday has occurred this year
    const monthDiff = today.getMonth() - dob.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
      age--; // Decrement age if birthday hasn't occurred yet this year
    }

    // Set the calculated age in the age input
    document.getElementById("age").value = age;
  }
});
