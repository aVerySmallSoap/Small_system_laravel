document.querySelector('#btn-delete').addEventListener('click', evt => {
    evt.preventDefault();
    let list = {
        parent: evt.target.dataset.id
    };
    archive(list);
    todo.innerHTML = "";
    wrapper.style.height = 'fit-content';
});

function archive(data) {
    fetch('/list/archive', {
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
        })
}
