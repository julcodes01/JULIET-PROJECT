const learnerId = 1; // Adjust if needed

    // 1. Fetch Profile Summary
    fetch(`get_learner_profile.php?learner_id=${learnerId}`)
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          document.querySelector('#profile-summary').innerHTML = <p>${data.error}</p>;
        } else {
          document.querySelector('#profile-summary').innerHTML = `
            <h2>Profile Summary</h2>
            <p>Name: ${data.name}</p>
            <p>License Type: ${data.license_type}</p>
            <p>Progress Status: ${data.progress_status}</p>
          `;
        }
      })
      .catch(err => {
        console.error("Profile fetch error:", err);
      });

    // 2. Fetch Training Progress & Feedback
    fetch(`get-progress.php?learner_id=${learnerId}`)
      .then(res => res.json())
      .then(data => {
        if (Array.isArray(data) && data.length > 0) {
          const chartLabels = data.map(skill => skill.skill_name);
          const chartScores = data.map(skill => parseInt(skill.score_percentage));
          const feedback = data[0].feedback || 'No feedback available';

          new Chart(document.getElementById('progressChart'), {
            type: 'bar',
            data: {
              labels: chartLabels,
              datasets: [{
                label: 'Skill Mastery (%)',
                data: chartScores,
                backgroundColor: '#007bff'
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  max: 100
                }
              }
            }
          });

          document.querySelector('#feedback p').textContent = feedback;
        } else {
          document.querySelector('#feedback p').textContent = 'No progress data found.';
        }
      })
      .catch(err => {
        console.error("Progress fetch error:", err);
      });

    // 3. Fetch Upcoming Sessions
    fetch('Get learners.php')
      .then(res => res.json())
      .then(data => {
        const list = document.getElementById('sessions-list');
        list.innerHTML = '';

        if (Array.isArray(data) && data.length > 0) {
          data.forEach(session => {
            const li = document.createElement('li');
            li.textContent = `${session.date} at ${session.location} with ${session.learner_name} - Status: ${session.status}`;
            list.appendChild(li);
          });
        } else {
          list.innerHTML = '<li>No sessions found.</li>';
        }
      })
      .catch(err => {
        console.error("Sessions fetch error:", err);
        document.getElementById('sessions-list').innerHTML = '<li>Error loading sessions.</li>';
      });
