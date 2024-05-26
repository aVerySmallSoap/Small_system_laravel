let header = document.querySelector('#list-header');
header.addEventListener('focusout', evt => {
    evt.preventDefault();
    let list = {
        id: evt.target.dataset.id,
        content: evt.target.value
    };
    saveHeader(list);
});

function saveHeader(data){
    fetch('/note/update/header', {
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
            console.log(data);
        })
}

