<!DOCTYPE html>
<html>

<head>
    <form action="process_add_item.php" method="post"> <label for="name">Name:</label><br> <input type="text" id="name" name="name" required><br> <label for="image_url">Image URL:</label><br> <input type="text" id="image_url" name="image_url" required><br> <label for="quantity">Quantity:</label><br> <input type="number" id="quantity" name="quantity" required><br><br> <input type="submit" value="Add Item"> </form>
    <title>employee</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .user-data img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
    <script>
        function fetchUsers() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_specific_users.php', true); // Ensure this path is correct
            xhr.onload = function() {
                if (this.status === 200) {
                    const users = JSON.parse(this.responseText);
                    console.log(users); // Log the data to the console
                    const userTable = document.getElementById('userTableBody');
                    userTable.innerHTML = '';
                    users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><input type="checkbox" class="delete-checkbox" data-id="${user.id}"></td>
                            <td><img src="${user.image_url}" alt="${user.name}"></td>
                            <td>${user.name}</td>
                            <td>${user.quantity}</td>
                        `;
                        userTable.appendChild(row);
                    });
                } else {
                    console.error('Failed to fetch user data');
                }
            };
            xhr.onerror = function() {
                console.error('Request error');
            };
            xhr.send();
        }

        function deleteSelectedUsers() {
            const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
            const ids = Array.from(checkboxes).map(checkbox => checkbox.getAttribute('data-id'));
            console.log('IDs to delete:', ids); // Debugging line

            if (ids.length > 0) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_users.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (this.status === 200) {
                        const response = JSON.parse(this.responseText);
                        console.log(response); // Debugging line
                        fetchUsers(); // Refresh the user list
                    } else {
                        console.error('Failed to delete users');
                    }
                };
                xhr.onerror = function() {
                    console.error('Request error');
                };
                xhr.send(JSON.stringify({
                    ids
                }));
            } else {
                console.log('No IDs selected for deletion'); // Debugging line
            }
        }



        // Fetch users every 5 seconds
        setInterval(fetchUsers, 5000);

        // Fetch users immediately on page load
        window.onload = fetchUsers;
    </script>
</head>

<body>
    <h1>for employee</h1>
    <button onclick="deleteSelectedUsers()">Delete Selected</button>
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- User data will be populated here by JavaScript -->
        </tbody>
    </table>
    <form action="logout.php" method="post">
        <button>Logout</button>
    </form>
</body>

</html>