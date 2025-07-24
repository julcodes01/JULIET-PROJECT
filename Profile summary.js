document.getElementById("profileSummaryForm").addEventListener("submit", function(event) {
    const name = document.getElementById("name").value.trim();
    const licenseType = document.getElementById("licenseType").value;
    const progress = document.getElementById("progress").value;
  
    if (name === "" || licenseType === "" || progress === "") {
      event.preventDefault(); // Stop form from submitting
      alert("Please fill in all fields.");
      return false;
    }
  
    // Optional success message (if submitting via JS/AJAX)
    // document.getElementById("statusMessage").textContent = "Submitting...";
  });
  