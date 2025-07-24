// instructor.js

// Handle section navigation
document.getElementById('nav-sessions').addEventListener('click', () => showSection('sessions'));
document.getElementById('nav-add-session').addEventListener('click', () => showSection('add-session'));

// Show/hide sections
function showSection(sectionId) {
  document.querySelectorAll('.content-section').forEach(section => section.classList.add('hidden'));
  document.getElementById(sectionId).classList.remove('hidden');
}

// Load all sessions from database and display in table
function loadSessions() {
  fetch('Get learners.php')
    .then(response => response.json())
    .then(sessions => {
      const tableBody = document.getElementById('sessionsTableBody');
      tableBody.innerHTML = ''; // clear previous data

      sessions.forEach(session => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${session.date}</td>
          <td>${session.time}</td>
          <td>${session.location}</td>
          <td>${session.learner_name}</td>
          <td>${session.status}</td>
        `;
        tableBody.appendChild(row);
      });
    })
    .catch(err => {
      console.error("Error loading sessions:", err);
    });
}

// Initial load of sessions
loadSessions();

// Submit new session form
const form = document.getElementById('addSessionForm');
form.addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(form);

  fetch('Add session.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(message => {
      alert(message);
      form.reset();
      loadSessions();
      showSection('sessions');
    })
    .catch(error => {
      console.error("Error submitting form:", error);
      alert("❌ Something went wrong while submitting the session.");
    });
});