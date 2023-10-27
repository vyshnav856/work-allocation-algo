// abhi nee ithil vende pole data fetch cheyyenam
// nyan thalkalam data ndenn oro variables aayit assume cheyyan

function allocateTicket(ticket) {
	const allDevs = null // fetch all data of all devs, should be an array of data
	let workLevels = []
	for (const dev of allDevs) {
		const allDevTickets = null // fetch all tickets of this particular dev

		let work = 0
		work += ticket.difficulty * 25
		work -= ticket.daysToComplete * 10
		work -+ dev.skillLevel * 50


		for (const devTicket of allDevTickets) {
			if (devTicket.deadline != ticket.deadline) {
				work += devTicket.difficulty * 25
				work -= devTicket.daysToComplete * 10
			}

			else {
				work += 100
			}
		}

		workLevels.push([dev, work])
	}

	let minDev = null
	let min = 999
	for (wl in workLevels) {
		if (wl[1] < min) {
			min = wl[1]
			minDev = wl[0]
		}
	}

	//assign ticket to dev inside minDev
}