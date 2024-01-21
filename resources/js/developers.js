document.addEventListener('DOMContentLoaded', function() {
    const leaderDeveloperSelect = document.querySelector('#leader_developer_id');

    const assignDeveloperCheckboxes = document.querySelectorAll('.assign-developer');

    const originalDevelopers = Array.from(assignDeveloperCheckboxes);

    let selectedLeaderDeveloperId = leaderDeveloperSelect.value;

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
        selectedLeaderDeveloperId = leaderDeveloperSelect.value;
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
