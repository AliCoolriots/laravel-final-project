document.addEventListener('DOMContentLoaded', function() {

    let start_date = document.getElementById('start_date');
    let end_date = document.getElementById('end_date');
    let progress_date = document.getElementById('progress_date');

if (start_date && end_date) {
    const currentDate = new Date();
    
    currentDate.setDate(currentDate.getDate() + 1);

    const minDate = currentDate.toISOString().split('T')[0];

    start_date.min = minDate;
    end_date.min = minDate;
}

if (progress_date) {
    const currentDate = new Date();

    currentDate.setDate(currentDate.getDate() + 1);

    const minDate = currentDate.toISOString().split('T')[0];

    progress_date.min = minDate;
}



    const leaderDeveloperSelect = document.querySelector('#leader_developer_id');

    const assignDeveloperCheckboxes = document.querySelectorAll('.assign-developer');

    const originalDevelopers = Array.from(assignDeveloperCheckboxes);

    let selectedLeaderDeveloperId = leaderDeveloperSelect?.value;

    function updateVisibility() {
        assignDeveloperCheckboxes.forEach(function(checkbox) {
            const parentDiv = checkbox.parentNode;
            if (checkbox.value === selectedLeaderDeveloperId) {
                checkbox.checked = false;
                parentDiv.style.display = 'none';
            } else {
                parentDiv.style.display = 'block';
            }
        });
    }

    updateVisibility();

    leaderDeveloperSelect.addEventListener('change', function() {
        selectedLeaderDeveloperId = leaderDeveloperSelect?.value;
        updateVisibility();
    });

    document.querySelector('form').addEventListener('submit', function() {
        const assignDevelopersContainer = document.querySelector('.mb-3');

        assignDeveloperCheckboxes.forEach(function(checkbox) {
            const parentDiv = checkbox.parentNode;
            parentDiv.style.display = 'block';
        });

        originalDevelopers.forEach(function(checkbox) {
            assignDevelopersContainer.appendChild(checkbox.cloneNode(true));
        });
    });
});
