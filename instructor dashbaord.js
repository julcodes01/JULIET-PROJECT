// instructor.js

document.getElementById('nav-sessions').addEventListener('click', () => showSection('sessions')); document.getElementById('nav-add-session').addEventListener('click', () => showSection('add-session'));

function showSection(sectionId) { document.querySelectorAll('.content-section').forEach(section => section.classList.add('hidden')); document.getElementById(sectionId).classList.remove('hidden'); }

// Load learners into dropdown fetch('get_learners.php') .then(response => response.json()) .then(learners => { const learnerSelect = document.getElementById('learnerSelect'); learners.forEach(learner => { const option = document.createElement('option'); option.value = learner.learner_id; option.textContent = learner.name; learnerSelect.appendChild(option); }); });

// Load sessions table function loadSessions() { fetch('get_sessions.php') .then(response => response.json()) .then(sessions => { const tableBody = document.getElementById('sessionsTableBody'); tableBody.innerHTML = ''; sessions.forEach(session => { const row = document.createElement('tr'); row.innerHTML = <td>${session.date}</td> <td>${session.time}</td> <td>${session.location}</td> <td>${session.learner_name}</td> <td>${session.status}</td>; tableBody.appendChild(row); }); }); }

loadSessions();

// Submit new session form const form = document.getElementById('addSessionForm'); form.addEventListener('submit', function(e) { e.preventDefault();

const formData = new FormData(form);

fetch('add_session.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(message => {
    alert(message);
    form.reset();
    loadSessions();
    showSection('sessions');
});