<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="server-css/server-dashboards1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.36/moment-timezone-with-data.min.js"></script>
    <link rel="icon" type="image/x-icon" href="server-css/pictures/Logo/brgylogo.svg">
    <title>Completed Request</title>
</head>
<body>

    <div class="sidebar">
        <div id="sidebartopa">
            <a href="server-dashboard.php">
                <div id="sidebartopwimg" class="sidebartopwimg active">
                    <img src="server-css/pictures/sidebar/homeactive.svg" alt="home">
                    <span>Home</span>    
                </div>
            </a>
            
            <a href="report.php">
                <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg1')">
                    <img src="server-css/pictures/sidebar/bar_chart.svg" alt="home">
                    <span>Report</span>    
                </div>
            </a>

            <a href="server-profile.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/profile.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="server-add-admin.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/addmin.svg" alt="Profile">
                    <span>New Admin</span>   
                </div>
            </a>
        </div>
        
        <div id="sidebarbottoma">
            <a href="phpexecution/endsession.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="server-css/pictures/sidebar/logout.svg" alt="Logout">
                    <span>Logout</span>  
                </div>
            </a>
        </div>

        <hr>

        <div id="profilebox">
            <div id="profileimage"></div>

            <div id="namebox">
                <h5 id="firstname"><?php echo ucfirst($user['username']);?></h5>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0).toUpperCase();
            $('#profileimage').text(intials);
        });
    </script>

    <section id="for100vh">
        <div id="aboutsection">
            
            <div class="notification-dropdown">
                <button class="notification-toggle">Notifications</button>
                    <div class="notification-container">
                        <div class="notification-list" id="notificationList">
                            <!-- Notifications will be appended here dynamically -->
                        </div>
                    </div>
            </div>
            
            <h1>SERVER DASHBOARD</h1>

            <div class="importantcontainer">
                <div class="importanta">
                    <a class="importantcontainernotactive" href="server-dashboard.php">REQUEST</a>
                    <a class="importantcontainernotactive" href="server-dashboard-onprocess.php">IN PROCESS</a>
                    <a class="importantcontainernotactive" href="server-dashboard-denied.php">DENIED</a>
                    <a class="importantcontainernotactive" href="server-dashboard-pickup.php">SCHEDULED</a>
                    <a class="importantcontaineractive" href="server-dashboard-completed.php">COMPLETED</a>
                </div>

                <div class="search-container">
                    <img src="server-css/pictures/dashboard/search.svg" alt="search">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search">
                </div>
            </div>
            
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>REQUESTER</th>
                        <th>FILE NAME</th>
                        <th>PURPOSE</th>
                        <th>DATE REQUESTED</th>
                        <th>STATUS</th>
                        <th>CLAIMED</th>
                    </tr>
                </thead>
                    <tbody id="tableBody">
                        <?php include 'phpexecution/fetchuser_activity-completed.php'; ?>
                        <tr id="noResultRow" style="display: none;">
                            <td colspan="7">No result for <span class="thesearch" id="searchQuery"></span></td>
                        </tr>
                    </tbody>
            </table>
            </div>
        </div>
    </section>
    <script>
    
        function toggleActive(id) {
            var element = document.getElementById(id);
            element.classList.toggle('active');
        }    
        
        function searchTable() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = document.getElementById("tableBody").getElementsByTagName("tr");
            var found = false; // Flag to track if any matching row is found
    
            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                var display = "none"; // Default display style
                for (var j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        display = ""; // Display the row if match found
                        break;
                    }
                }
                tr[i].style.display = display; // Apply display style to the row
            }
    
            // Show message if no matching rows found
            var noResultRow = document.getElementById("noResultRow");
            if (noResultRow) {
                if (!found && filter.trim() !== "") {
                    noResultRow.style.display = ""; // Display the message row if no results found and there's a search query
                    document.getElementById("searchQuery").textContent = '"' + filter + '"'; // Display the search query in the message
                } else {
                    noResultRow.style.display = "none"; // Hide the message row if results found or no search query
                }
            }
        }
        
        $(document).ready(function() {
            $('.notification-toggle').click(function() {
                $('.notification-container').toggleClass('show');
            });
        
            // Close dropdown if user clicks outside of it
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.notification-dropdown').length) {
                    $('.notification-container').removeClass('show');
                }
            });
        });

        function checkNotifications() {
            $.ajax({
                url: 'phpexecution/check_notifications.php',
                method: 'GET',
                success: function(response) {
                    try {
                        // Parse the JSON response
                        var notifications = response;
            
                        // Ensure notifications is an array
                        if (Array.isArray(notifications)) {
                            var notificationList = $('#notificationList');
            
                            notifications.forEach(function(notification) {
                                // Check if the notification already exists in the list to avoid duplicates
                                if (!notificationList.find(`#notification-${notification.id}`).length) {
                                    var notificationItem = `
                                        <div class="notification-item" id="notification-${notification.id}">
                                            <div class="notification-avatar"></div>
                                            <div class="notification-content">
                                                <p>${notification.message}</p>
                                                <span>${timeAgo(notification.timestamp)}</span>
                                            </div>
                                        </div>
                                    `;
                                    notificationList.append(notificationItem);
                                }
                            });
                        }
                    } catch (e) {
                        console.error("Failed to parse JSON response: ", e);
                        console.error("Response received: ", response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error: ", status, error);
                }
            });

        }

        // Convert timestamp to a 'time ago' format
        function timeAgo(timestamp) {
            var now = moment.tz("Asia/Manila");
            var past = moment.tz(timestamp, "Asia/Manila");
            
            var secondsPast = now.diff(past, 'seconds');
            
            if (secondsPast < 60) {
                return `${Math.round(secondsPast)} seconds ago`;
            }
            if (secondsPast < 3600) {
                return `${Math.round(secondsPast / 60)} minutes ago`;
            }
            if (secondsPast <= 86400) {
                return `${Math.round(secondsPast / 3600)} hours ago`;
            }
            if (secondsPast > 86400) {
                var day = past.date();
                var month = past.format("MMM");
                var year = past.year() === now.year() ? "" : ` ${past.year()}`;
                return `${day} ${month}${year}`;
            }
        }

        // Poll for notifications every 3 seconds (for demonstration)
        setInterval(checkNotifications, 3000);

        // Initial check when page loads
        $(document).ready(function() {
            checkNotifications();
        });
    </script>
</body>
</html>