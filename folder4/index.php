<?php
session_start();
if (!isset($_SESSION['page_visits'])) {
    $_SESSION['page_visits'] = 1;
} else {
    $_SESSION['page_visits']++;
}
function getPageVisits() {
    if (isset($_SESSION['page_visits'])) {
        return $_SESSION['page_visits'];
    } else {
        return 0;
    }
}
$pageVisits = getPageVisits();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Visits Tracker</title>
</head>
<body>
    <h1>Welcome to the Page Visits Tracker</h1>
    <p>This page has been visited <?php echo $pageVisits; ?> times.</p>
</body>
</html>
