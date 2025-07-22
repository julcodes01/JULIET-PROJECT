document.getElementById("adminLoginForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const form = e.target;
    const formData = new FormData(form);
  
    fetch("instructor login.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.text())
      .then(data => {
        if (data.trim() === "success") {
          alert("Welcome, Admin juliet!");
          window.location.href = "instructor dashboard.html";
        } else {
          alert(data);
        }
      })
      .catch(err => {
        console.error(err);
        alert("Error during login.");
      });
  });