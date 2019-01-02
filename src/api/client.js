async function save(name, overwrite = false) {
	const response = await fetch('api/save.php?name=' + name + "&overwrite=" + overwrite, {
		method: "POST",
		headers: {
			"Content-Type": "text/html"
		},
		body: editor.getData()
	});
	const data = await response.json();
	if (!response.ok) {
		const err = new Error(`${data.message} (${data.message} (${response.status}: ${response.statusText}/${data.error})`);
		err.code = data.error;
		throw err;
	}
	return data;
}

async function load(name) {
	const response = await fetch('api/load.php?name=' + name);
	const data = await response.text();
	if (!response.ok)
		throw new Error(`Could not load note (${data}: ${response.status} ${response.statusText})`);
	return data;
}

async function list() {
	const response = await fetch('api/list.php');
	const data = await response.json();
	if (!response.ok)
		throw new Error(`Could not load note (${data.message} (${response.status}: ${response.statusText}/${data.error}))`);
	return data.notes;
}