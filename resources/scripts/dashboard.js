// Function to fetch and display assignment data from JSON file
async function fetchAssignmentData() {
    try {
        const response = await fetch("assignment_testdata.json");
        const data = await response.json();

        // Get the table body element
        const tableBody = document.getElementById("athalm_assignmentTableBody");

        // Loop through the data and create table rows
        data.forEach((assignment) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${assignment.name}</td>
                <td>${assignment.due_date}</td>
                <td>${assignment.type}</td>
                <td><span class="chenw21status ${getStatusClass(
                assignment.status
            )}">${assignment.status}</span></td>
            `;
            tableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching assignment data:", error);
    }
}

// Function to get the correct class based on assignment status
function getStatusClass(status) {
    switch (status.toLowerCase()) {
        case "finished":
            return "Finished";
        case "in progress":
            return "inProgress";
        case "overdue":
            return "Overdue";
        case "to do":
            return "Todo";
        default:
            return "";
    }
}

sort_name = 0;
sort_date = 0;
sort_type = 0;
sort_status = 0;

function sort_by_name_ascending(a, b) {
    const name_a = a.name;
    const name_b = b.name;
    if (name_a < name_b) {
        return -1;
    }
    return 1;
}

function sort_by_name_descending(a, b) {
    const name_a = a.name;
    const name_b = b.name;
    if (name_a < name_b) {
        return 1;
    }
    return -1;
}

function sort_by_type_ascending(a, b) {
    const name_a = a.type;
    const name_b = b.type;
    if (name_a < name_b) {
        return -1;
    }
    return 1;
}

function sort_by_type_descending(a, b) {
    const name_a = a.type;
    const name_b = b.type;
    if (name_a < name_b) {
        return 1;
    }
    return -1;
}

function sort_by_status_ascending(a, b) {
    const name_a = a.status;
    const name_b = b.status;
    if (name_a < name_b) {
        return -1;
    }
    return 1;
}

function sort_by_status_descending(a, b) {
    const name_a = a.status;
    const name_b = b.status;
    if (name_a < name_b) {
        return 1;
    }
    return -1;
}

function sort_by_date_ascending(a, b) {
    const dateA = new Date(a.due_date);
    const dateB = new Date(b.due_date);

    if (dateA < dateB) {
        return -1;
    }
    return 1;
}

function sort_by_date_descending(a, b) {
    const dateA = new Date(a.due_date);
    const dateB = new Date(b.due_date);

    if (dateA < dateB) {
        return 1;
    }
    return -1;
}

async function sort_assignments(heading) {
    //Get user_id from cookies
    //From W3schools
    let name = "userid=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    let user_id;
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            user_id = c.substring(name.length, c.length);
        }
    }

    document.getElementById('athalm_a_name').innerHTML = "Name";
    document.getElementById('athalm_a_duedate').innerHTML = "Due On";
    document.getElementById('athalm_a_type').innerHTML = "Type";
    document.getElementById('athalm_a_status').innerHTML = "Status";

    //Get correct assignments.json file
    const response = await fetch(`../assignments/${user_id}-assignments.json`);
    const data = await response.json();

    if (heading == "name") {
        sort_date = 0;
        sort_type = 0;
        sort_status = 0;


        const json_array = Array.from(data);

        // Get the table body element
        const tableBody = document.getElementById("athalm_assignmentTableBody");

        if (sort_name == 1) {
            document.getElementById('athalm_a_name').innerHTML = "Name▼";
            //need to sort in descending order in this case
            const sorted_array = json_array.sort(sort_by_name_descending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });

            sort_name = -1;
        } else {
            document.getElementById('athalm_a_name').innerHTML = "Name▲";
            //need to sort in ascending order
            const sorted_array = json_array.sort(sort_by_name_ascending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
            sort_name = 1;
        }
    } else if (heading == "date") {
        sort_name = 0;
        sort_type = 0;
        sort_status = 0;

        const json_array = Array.from(data);

        // Get the table body element
        const tableBody = document.getElementById("athalm_assignmentTableBody");

        if (sort_date == 1) {
            document.getElementById('athalm_a_duedate').innerHTML = "Due On▼";
            //need to sort in descending order in this case
            const sorted_array = json_array.sort(sort_by_date_descending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });

            sort_date = -1;
        } else {
            document.getElementById('athalm_a_duedate').innerHTML = "Due On▲";
            //need to sort in ascending order
            const sorted_array = json_array.sort(sort_by_date_ascending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
            sort_date = 1;
        }
    } else if (heading == "type") {
        sort_date = 0;
        sort_name = 0;
        sort_status = 0;

        const json_array = Array.from(data);

        // Get the table body element
        const tableBody = document.getElementById("athalm_assignmentTableBody");

        if (sort_type == 1) {
            document.getElementById('athalm_a_type').innerHTML = "Type▼";
            //need to sort in descending order in this case
            const sorted_array = json_array.sort(sort_by_type_descending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });

            sort_type = -1;
        } else {
            document.getElementById('athalm_a_type').innerHTML = "Type▲";
            //need to sort in ascending order
            const sorted_array = json_array.sort(sort_by_type_ascending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
            sort_type = 1;
        }
    } else if (heading == "status") {
        sort_date = 0;
        sort_type = 0;
        sort_name = 0;

        const json_array = Array.from(data);

        // Get the table body element
        const tableBody = document.getElementById("athalm_assignmentTableBody");

        if (sort_status == 1) {
            document.getElementById('athalm_a_status').innerHTML = "Status▼";
            //need to sort in descending order in this case
            const sorted_array = json_array.sort(sort_by_status_descending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });

            sort_status = -1;
        } else {
            document.getElementById('athalm_a_status').innerHTML = "Status▲";
            //need to sort in ascending order
            const sorted_array = json_array.sort(sort_by_status_ascending);
            tableBody.innerHTML = "";
            sorted_array.forEach((assignment) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${assignment.name}</td>
                    <td>${assignment.due_date}</td>
                    <td>${assignment.type}</td>
                    <td><span class="chenw21status ${assignment.status.replace(/\s/g, "")
                    }">${assignment.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
            sort_status = 1;
        }
    }
}

