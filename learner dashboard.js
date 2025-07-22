// learner.js

// Fetch sessions for the learner
fetch('get_sessions.php?learner_id=1')
    .then(response => response.json())
    .then(data => {
        const sessionsList = document.getElementById('sessions-list');
        sessionsList.innerHTML = '';
        data.forEach(session => {
            const li = document.createElement('li');
            li.textContent = `${session.date_time} at ${session.location} with ${session.instructor_name} - Status: ${session.status}`;
            sessionsList.appendChild(li);
        });
    });

// Example chart data
const ctx = document.getElementById('progressChart').getContext('2d');
const progressChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Parking', 'Reversing', 'Hill Start'],
        datasets: [{
            label: 'Skill Mastery (%)',
            data: [80, 70, 60],
            backgroundColor: ['#007BFF', '#28A745', '#FFC107']
        }]
    }
});