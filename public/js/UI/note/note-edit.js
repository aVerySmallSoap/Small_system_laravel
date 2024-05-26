let notes = document.querySelectorAll('input[data-sequence]');

notes.forEach(note => {
    note.addEventListener('focusout', evt => {
        evt.preventDefault();
        eventOnEdit(evt)
    });
});

function eventOnEdit(evt){
    let list = {
        header: evt.target.dataset.parent,
        sequence: evt.target.dataset.sequence,
        content: evt.target.value
    };
    saveNote(list);
}

function saveNote(data) {
    fetch('/note/update/item', {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf.content,
            "X-Requested-With": 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            notes = document.querySelectorAll('input[data-sequence]');
        })
}
