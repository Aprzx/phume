<!DOCTYPE html>
<html>

<head>
    <title>User Management</title>
    <style>
        .user-status {
            display: flex;
            align-items: center;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .online {
            background-color: green;
        }

        .offline {
            background-color: grey;
        }

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
    </style>
    <script>
        function fetchUsers() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_users.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const users = JSON.parse(this.responseText);
                    const userList = document.getElementById('userList');
                    userList.innerHTML = '';
                    users.forEach(user => {
                        const statusClass = user.status === 'online' ? 'online' : 'offline';
                        const listItem = document.createElement('li');
                        listItem.className = 'user-status';
                        listItem.innerHTML = `<div class="status-indicator ${statusClass}"></div>${user.username}`;
                        userList.appendChild(listItem);
                    });
                }
            };
            xhr.send();
        }

        function fetchLogEntries() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_log.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const logs = JSON.parse(this.responseText);
                    const logTableBody = document.getElementById('logTableBody');
                    logTableBody.innerHTML = '';
                    logs.forEach(log => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${log.action}</td><td>${log.item_name}</td><td>${log.timestamp}</td>`;
                        logTableBody.appendChild(row);
                    });
                }
            };
            xhr.send();
        }

        function exportLogs() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_log.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const logs = JSON.parse(this.responseText);
                    let logContent = '';
                    logs.forEach(log => {
                        logContent += `${log.action}\t${log.item_name}\t${log.timestamp}\n`;
                    });
                    const blob = new Blob([logContent], {
                        type: 'text/plain'
                    });
                    const a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = 'logs.txt';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            };
            xhr.send();
        }

        function clearLogs() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'clear_log.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    console.log(this.responseText); // Add a console log to see the response
                    fetchLogEntries();
                }
            };
            xhr.send();
        }


        //++++++++++++++++++++++++++||
        // Fetch users every 0.5 seconds
        setInterval(fetchUsers, 500);

        // Fetch log entries every 0.5 seconds
        setInterval(fetchLogEntries, 500);

        // Fetch users and log entries immediately on page load
        window.onload = function() {
            fetchUsers();
            fetchLogEntries();
        };
    </script>
</head>

<body>
    <h1>User Management</h1>
    <ul id="userList">
        <!-- User list will be populated here by JavaScript -->
    </ul>
    <a href="add_item.php">Add item</a>
    <h1>Dashboard</h1>
    <h2>Log Entries</h2>
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Item Name</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody id="logTableBody">
            <!-- Log entries will be populated here by JavaScript -->
        </tbody>
    </table>
    <button onclick="exportLogs()">Export Logs</button>
    <button onclick="clearLogs()">Clear Logs</button>
</body>

</html>