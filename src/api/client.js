class NoteError extends Error {
	constructor(data) {
		super(`${data.message} (${data.error})`);
		this.originalMessage = data.message;
		this.code = data.error;
	}
}

class Note {
	constructor(name = null, content = null) {
		this.name = name;
		this.content = content;
	}

	async save(overwrite = false) {
		let url;
		if (this.name != undefined && this.name != null)
			url = `api/save.php?name=${this.name}&overwrite=${overwrite}`;
		else
			throw new Error('Note has no name');
		const response = await fetch(url, {
			method: 'POST',
			headers: {
				'Content-Type': 'text/html'
			},
			body: this.content
		});
		const data = await response.json();
		if (!response.ok)
			throw new NoteError(data);
	}

	async load() {
		let response;
		if (this.name != undefined && this.name != null)
			response = await fetch(`api/load.php?name=${this.name}`);
		else
			throw new Error('Note has no name');
		if (!response.ok)
			throw new NoteError(await response.json());
		this.content = await response.text();
	}

	static async list() {
		const response = await fetch('api/list.php');
		const data = await response.json();
		if (!response.ok)
			throw new NoteError(data);
		return data.notes.map(name => new Note(name));
	}

	static async getByName(name) {
		const note = new Note(name);
		await note.load();
		return note;
	}
}
