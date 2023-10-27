const createNewTaskButton = document.querySelector(".ticket-tab__create-button")
const createTicketCard = document.querySelector(".create-ticket")
const createTicketOverlay = document.querySelector(".overlay")
const cancelTicketCreateButton = document.querySelector(".cancel-ticket-create")
const createTicketForm = document.querySelector(".create-form")

createNewTaskButton.addEventListener("click", () => {
	createTicketOverlay.style.display = "block"
	createTicketCard.style.display = "block"
})

cancelTicketCreateButton.addEventListener("click", () => {
	createTicketCard.style.display = "none"
	createTicketOverlay.style.display = "none"
})

createTicketForm.addEventListener("submit", (e) => {
	e.preventDefault()

	const name = document.querySelector("#task-name").value
	const taskType = document.querySelector("input[name='t-type']:checked").value
	const priority = document.querySelector("input[name='priority']:checked").value
	const difficulty = Number(document.querySelector("#difficulty").value)
	const deadline = Number(document.querySelector("#deadline").value)
	const dev = document.querySelector("#dev")
	const selectedDev = dev.options[dev.selectedIndex].value

	const formData = {
		name,
		taskType,
		priority,
		difficulty,
		deadline,
		selectedDev,
	}

	console.log(formData);
})