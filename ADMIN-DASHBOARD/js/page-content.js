function loadFeedback(){
    // Fetch the JSON data from the PHP script
    // console.log("test");
    fetch('feedback.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        // Get a reference to the table body where you want to insert rows
        const tableBody = document.getElementById('feedbackTableBody'); // Make sure this ID matches your HTML

        // Clear any existing rows
        tableBody.innerHTML = "";

        // Loop through the fetched data and create a table row for each entry
        data.forEach(item => {
            const row = document.createElement('tr');

            // Create cells for each piece of data
            const subjectCell = document.createElement('td');
            subjectCell.textContent = item.subject;
            row.appendChild(subjectCell);

            const messageCell = document.createElement('td');
            messageCell.textContent = item.message;
            row.appendChild(messageCell);

            const nameCell = document.createElement('td');
            nameCell.textContent = item.name;
            row.appendChild(nameCell);

            const dateCell = document.createElement('td');
            dateCell.textContent = item.date;
            row.appendChild(dateCell);

            const emailCell = document.createElement('td');
            emailCell.textContent = item.email;
            row.appendChild(emailCell);

            // Append the new row to the table body
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });

    //else window.location.href="index.html";
}