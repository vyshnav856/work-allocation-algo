<?php
include("../connection/connection.php");
session_start();
$manager_id = $_SESSION['mid'];
$manager_name = $_SESSION['mname'];


$countCompletedQuery = "SELECT COUNT(*) AS completed_count FROM `tbl_ticket` WHERE ticket_status = 3";
$completed_result = $con->query($countCompletedQuery);
$completed_row = $completed_result->fetch_assoc();
$completed_value = $completed_row['completed_count'];

$countInProgressQuery = "SELECT COUNT(*) AS progress_count FROM `tbl_ticket`   ";
$progress_result = $con->query($countInProgressQuery);
$progress_row = $progress_result->fetch_assoc();
$progress_value = $progress_row['progress_count'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_name = $_POST['task-name'];
    $ticket_type = $_POST['t-type'];
    $ticket_priority = $_POST['priority'];
    $ticket_difficulty = $_POST['difficulty'];
    $ticket_deadline = $_POST['deadline'];
    $ticket_dev = $_POST['dev'];

    // Calculate ticket_set_date (current date)
    $ticket_set_date = date('Y-m-d');

    // Calculate ticket_deadline (ticket_set_date + days_to_complete)
    $ticket_deadline = date('Y-m-d', strtotime($ticket_set_date . ' + ' . $ticket_deadline . ' days'));

    $insertQuery = "INSERT INTO `tbl_ticket`(`ticket_name`, `ticket_type`, `ticket_priority`, `ticket_difficulty`, `ticket_deadline`,`dev_type`)
    VALUES ('$ticket_name', '$ticket_type', '$ticket_priority', '$ticket_difficulty', '$ticket_deadline','$ticket_dev')";

    if ($con->query($insertQuery) === TRUE) {
        echo "Ticket created successfully!";

        $result = $con->query("SELECT * FROM `tbl_dev` ORDER BY `dev_load` ASC");
        $row = mysqli_fetch_assoc($result);
        $id = $row['dev_id'];

        // Update dev_load by incrementing it by 1
        $updateDevLoad = $con->query("UPDATE tbl_dev SET dev_load = dev_load + 1 WHERE dev_id = $id");

        // Assign the same developer to the ticket with the highest ticket_id
		$updateTicket = $con->query("UPDATE `tbl_ticket` SET `dev_id` = $id, `ticket_status` = `ticket_status` + 1 WHERE ticket_id = (SELECT MAX(`ticket_id`) FROM `tbl_ticket`)");

        if ($updateDevLoad && $updateTicket) {
            echo "Developer and Ticket updated successfully!";
        } else {
            echo "Error updating Developer or Ticket: " . $con->error;
        }
    } else {
        echo "Error creating ticket: " . $con->error;
    }
}

$selectQuery = "SELECT * FROM `tbl_ticket`";
$result = $con->query($selectQuery);
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Manage Tasks</title>
	<link rel="stylesheet" href="../shared.css">
	<link rel="stylesheet" href="create-task-modal.css">
	<link rel="stylesheet" href="manage.css">

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
			<p class="main-header__username"><?php echo $manager_name; ?>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 chev">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</p>
		</div>
	</header>

	<main>
		<div class="overlay">

		</div>

		<article class="create-ticket">
			<header>
				<h2>Create a new ticket!</h2>
				<button class="cancel-ticket-create">Cancel</button>
			</header>


			<form method="post" name="ticket_form" class="create-form">
				<input required id="task-name" name="task-name" type="text" placeholder="Task Name">

				<div class="type-selector">
					<h4>Type of task</h4>
					<input value="bugfix" required name="t-type" type="radio" id="fix-bug" value="1">
					<label for="fix-bug">Bugfix</label>
					<input value="newf" required name="t-type" type="radio" id="fix-new" value="2">
					<label for="fix-new">New Feature</label>
					<input value="update" required name="t-type" type="radio" id="fix-update" value="3">
					<label for="fix-update">Update</label>
				</div>

				<div class="type-selector">
					<h4>Priority Level</h4>
					<input value="1" required name="priority" type="radio" id="low-p">
					<label for="low-p">Low</label>
					<input value="2" required name="priority" type="radio" id="med-p">
					<label for="med-p">Medium</label>
					<input value="3" required name="priority" type="radio" id="high-p">
					<label for="high-p">High</label>
				</div>

				<div class="num-select">
					<label for="difficulty">Difficulty Level</label>
					<input required id="difficulty" name="difficulty" value="3" type="number" min="1" max="5">
				</div>

				<div class="num-select">
					<label for="deadline">Days to complete</label>
					<input value="7" required id="deadline" name="deadline" type="number" min="0" max="365">
				</div>

				<div class="type-dropdown">
					<label for="dev">Type of developer</label>
					<select required id="dev" name="dev">
						<option value="choose">Choose</option>
						<option value="frontend">Frontend</option>
						<option value="backend">Backend</option>
						<option value="full-stack">Full Stack</option>
						<option value="cloud">Cloud</option>
						<option value="aiml">AI/ML</option>
					</select>
				</div>

				<button class="but create-task-sumbit" type="submit" name="ticket_submit">Create new ticket</button>
			</form>
		</article>

		<div class="ticket-tab">
			<div class="ticket-tab__container">
				<div class="ticket-tab__item ticket-tab__progress ">In Progress <?php echo$progress_value;?></div>
				<div class="ticket-tab__item ticket-tab__completed">Completed <?php echo$completed_value;?></div>
			</div>

			<button class="ticket-tab__create-button">+ New Ticket</button>
		</div>

		<div class="ticket-panel-container">
			<h2>Tickets in progress</h2>

			<div class="ticket-panel">
				<?php
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>

						<div class="ticket">
							<h3 class="ticket__name"> <?php echo $row['ticket_name']; ?> </h3>

							<p class="ticket__type"> <?php echo $row['ticket_type']; ?> </p>

							<p class="ticket__priority"> Priority <?php echo $row['ticket_priority']; ?> </p>

							<p class="ticket__deadline">Due: <span class="ticket__date"><?php echo $row['ticket_deadline']; ?> </span></p>
							<?php
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
							<p class="ticket__status">Status :<?php echo $status ?></p>


						</div>

				<?php }
				} else {
					echo "No tickets found";
				}
				?>
			</div>
		</div>

	</main>
</body>

</html>