<?php
include("../connection/connection.php");
session_start();
$dev_id = $_SESSION['did'];
$dev_name = $_SESSION['dname'];

$result = $con->query("SELECT * FROM tbl_ticket WHERE dev_id = $dev_id ");

$countCompletedQuery = "SELECT COUNT(*) AS completed_count FROM `tbl_ticket` WHERE dev_id = $dev_id AND ticket_status = 3";
$completed_result = $con->query($countCompletedQuery);
$completed_row = $completed_result->fetch_assoc();
$completed_value = $completed_row['completed_count'];

$countInProgressQuery = "SELECT COUNT(*) AS progress_count FROM `tbl_ticket` WHERE dev_id = $dev_id ";
$progress_result = $con->query($countInProgressQuery);
$progress_row = $progress_result->fetch_assoc();
$progress_value = $progress_row['progress_count'];


if (isset($_GET['ticket_id'])) {
	$ticket_id = $_GET['ticket_id'];

	$updateQuery = "UPDATE `tbl_ticket` SET `ticket_status` = `ticket_status` + 1 WHERE ticket_id = $ticket_id";

	if ($con->query($updateQuery) === TRUE) {
		echo "Ticket status updated successfully!";
		header("location: dev.php");
	} else {
		echo "Error updating ticket status: " . $con->error;
	}
	
}

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Developer</title>
	<link rel="stylesheet" href="../shared.css">
	<link rel="stylesheet" href="dev.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

	<script defer src="manage.js"></script>
</head>

<body>
	<header class="main-header">
		<div class="main-header__div">
			<h2 class="main-header__title">Work Allocator</h2>
			<h3><a href="../index.html">log Out</a></h3>
			<p class="main-header__username"><?php echo $dev_name; ?>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 chev">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</p>
		</div>
	</header>

	<main>
		<div class="ticket-tab">
			<div class="ticket-tab__progress">In Progress <span class="ticket-tab__progress-value">
					<p><?php echo $progress_value; ?></p>
				</span></div>
			<div class="ticket-tab__completed">Completed <span class="ticket-tab__completed-value">
					<p><?php echo $completed_value; ?></p>
				</span></div>

		</div>

		<div class="ticket-panel-container">
			<h2>Tickets in progress</h2>
			<div class="ticket-panel">
				<?php
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						if ($row['ticket_status'] == 0) {
							$status = "Pending";
						} elseif ($row['ticket_status'] == 1) {

							$status = "Assigned";
						} elseif ($row['ticket_status'] == 2) {

							$status = "Under Work";
						} elseif ($row['ticket_status'] == 3) {

							$status = "Completed";
						}
				?>
						<div class="ticket">
							<h3 class="ticket__name"><?php echo $row['ticket_name']; ?></h3>
							<p class="ticket__type"><?php echo $row['ticket_type']; ?></p>
							<p class="ticket__priority"><?php echo $row['ticket_priority']; ?></p>
							<p class="ticket__deadline">Deadline: <span class="ticket__date"><?php echo $row['ticket_deadline']; ?></span></p>
							<p class="ticket__status"><?php echo $status; ?></p>
							<?php
							if ($row['ticket_status'] != 3) {
								echo '<a class="ticket__update" href="dev.php?ticket_id=' . $row['ticket_id'] . '">Update</a>';
							}
							?>
						</div>	
				<?php
					}
				} else {
					echo '<div class="ticket">No tasks assigned.</div>';
				}
				?>
			</div>
		</div>
	</main>
</body>

</html>