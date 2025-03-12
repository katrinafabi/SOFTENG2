<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/a-dashboards1.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>Dashboard</title>
</head>

<body>
    
    <div class="sidebar">
        <div id="sidebartopa">
            <a href="dashboard.php">
                <div id="sidebartopwimg" class="sidebartopwimg active">
                    <img src="css/pictures/sidebar/homeactive.svg" alt="home">
                    <span>Home</span>    
                </div>
            </a>

            <a href="filerequest.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="css/pictures/sidebar/file.svg" alt="File">
                    <span>File Request</span>
                </div>
            </a>

            <a href="profileuser.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="css/pictures/sidebar/profile.svg" alt="Profile">
                    <span>Profile</span>   
                </div>
            </a>

            <a href="phpexecution/endsession.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="css/pictures/sidebar/logout.svg" alt="Logout">
                    <span>Logout</span>  
                </div>
            </a>
        </div>
        
        <div id="sidebarbottoma">
            <a href="usersupport.php">
                <div id="sidebartopwimg" class="sidebartopwimg">
                    <img src="css/pictures/sidebar/support.svg" alt="Support">
                    <span>Support</span>  
                </div>
            </a>
        </div>

        <hr>

        <div id="profilebox">
            <div id="profileimage"></div>

            <div id="namebox">
                <h5 id="firstname"><?php echo $user['last_name'] . ', ' . substr($user['first_name'], 0, 1).'.';?></h5>
                <p><?php echo $user['email'];?></p>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var firstname = $('#firstname').text();
            var intials = firstname.charAt(0);
            $('#profileimage').text(intials);
        });
    </script>

    <section id="for100vh">
        <div id="aboutsection">
            
            <div class="notification-dropdown">
                <button class="notification-toggle"><img src="css/pictures/dashboard/notification.svg" alt="bell"></button>
                    <div class="notification-container">
                        <div class="notification-list" id="notificationList">
                        </div>
                    </div>
            </div>
            
            <h1>DASHBOARD</h1>

            <div class="importantcontainer">
                <div class="dropdown">
                <a class="importantcontaineractive" href="dashboard.php">
                    <button class="dropdown-toggle">REQUESTS</button>
                </a>
                    <div class="dropdown-content">
                        <a class="importantcontainernotactive" href="dashboard-onprocess.php">ONGOING</a>
                        <a class="importantcontainernotactive" href="dashboard-denied.php">DENIED</a>
                        <a class="importantcontainernotactive" href="dashboard-pickup.php">SCHEDULED</a>
                        <a class="importantcontainernotactive" href="dashboard-completed.html">COMPLETED</a>
                    </div>
                </div>
            
                <div class="search-container">
                    <img src="css/pictures/dashboard/search.svg" alt="search">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for...">
                </div>
            </div>                      
            
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>DATE REQUESTED</th>
                        <th>FILE NAME</th>
                        <th>PURPOSE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php include 'phpexecution/fetchuser_activity.php'; ?>
                    <tr id="noResultRow" style="display: none;">
                        <td colspan="5">No result for <span class="thesearch" id="searchQuery"></span></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </section>

    <!-- Add JavaScript to toggle active class -->
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

        $(document).ready(function() {
            $('.dropdown-toggle').click(function() {
                $('.dropdown-content').toggle();
            });

            // Close the dropdown if the user clicks outside of it
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-content').hide();
                }
            });
        });
    </script>
</body>
</html>