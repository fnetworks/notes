# Notes API

## Routes

### GET /api/load.php

#### Parameters

| Name | Description                   |
|------|-------------------------------|
| name | The name of the note to load  |

#### Returns

The ``text/html`` note, or an ``application/json`` response if an error occurs.
```json
{
    "error": "<error_id>",
    "message": "<error_message>"
}
```
* ``error``: Contains the error id
* ``message``: Contains a more specific error message

### POST /api/save.php

#### Parameters

| Name      | Description                             |
|-----------|-----------------------------------------|
| name      | The name of the note to save            |
| overwrite | If an existing note should be overriden |

#### Body

The ``text/html`` note

#### Returns

An ``application/json`` response:
```json
{
    "error": "<error_id>",
    "message": "<error_message>"
}
```
* ``error``: Contains the error id, or ``none`` if there was none
* ``message``: Contains a more specific error message. Only present if there was an error.

### GET /api/list.php

#### Returns
An ``application/json`` response:
```json
{
    "error": "<error_id>",
    "message": "<error_message>",
    "notes": [
        "<note1>",
        "<note2">
    ]
}
```
* ``error``: Contains the error id, or ``none`` if there was none
* ``message``: Contains a more specific error message. Only present if there was an error.
* ``notes``: An array of note names.
