<!-- Author: Brian F.
Purpose: Hobby API project, develop convenient distance checker from "static" starting address. 
I am limited in my programming capabilities, but with the help of ChatGPT, I can create cool stuff : )

Code Purpose: Find the quickest route from the starting point to the inputted destination.
Saves the user from navigating a few webpages to find this information.

For instance: Rather than having to input the starting location and paste the destionation on a new
or seperate webpage, if this functions properly, it can save the extra steps. No need to open a new
webpage, copy the destination address, type your starting location, and click search, all you need
to do is input the destination address and the hard work will be done by this API : )-->

<?php
session_start();

//connect to database
$conn = mysqli_connect('host', 'username', 'password', 'database_name');

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT address FROM addresses WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $address = $row['address'];
} else {
    echo "No address found for this user.";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Quickest Route</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script>
        function initMap() {
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: { lat: 41.85, lng: -87.65 }
            });
            directionsDisplay.setMap(map);

            var start = '<?php echo $address; ?>';
            var end = document.getElementById('end').value;
            var request = {
                origin: start,
                destination: end,
                travelMode: 'DRIVING'
            };
            directionsService.directions(request, function (result, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(result);
                }
            });
        }
    </script>

</head>

<body onload="initMap()">
    <div id="map" style="height: 500px;"></div>
    <br>
    <label>End Address: </label>
    <input id="end" value="New York, NY">
</body>

</html>