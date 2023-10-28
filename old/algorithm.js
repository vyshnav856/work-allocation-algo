function assignTicket(ticketData) {
	const allDevs = fetch("all devs in DB where ticketData.domain == dev.domain OR dev.domain == fullstack")
	const allWorkLevels = []

	for (const dev of allDevs) {
		let workLevel = 0

		// if dev is fullstack, add points to workLevel
		if (dev.domain === "fullstack") {
			workLevel += 20
		}

		// add difficulty and deadline of current ticket to workLevel
		workLevel += ticketData.difficulty * 20
		workLevel -= ticketData.daysLeft * 10

		// factor in skill level of dev into workLevel
		workLevel -= dev.skillLevel * 50


		// add the difficulty of each ticket the current dev has to workLevel
		const devTickets = fetch('all tickets the current dev has')

		for (const devTicket of devTickets) {
			workLevel += devTicket.difficulty * 20
			workLevel -= devTicket.daysLeft * 10
		}

		// add the current work level to array of all work levels
		allWorkLevelspush(workLeve)
	}
	
	// sort the allWorkLevels array in ascending order
	const devWithLeastWork = allWorkLevels[0]

	// assign ticket to devWithLeastWork
}