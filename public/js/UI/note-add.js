let form = document.querySelector('form');
let todo = document.querySelector('.todo-list');
let wrapper = document.querySelector('.wrapper');

form.addEventListener('submit', evt => {
    evt.preventDefault();
    let notes = document.querySelectorAll('input[data-sequence]');
    let list = {}
    let data = new FormData(form);
    data.set("sequence", `${notes.length + 1}`);
    data.set("parent", `${document.querySelector('input[data-id]').dataset.id}`);
    data.forEach((value, key) => {
        list[key] = value;
    });
    wrapper.style.height =  `calc(${wrapper.style.height} + 10%)`;
    fetch('/note/insert', {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf.content,
            "X-Requested-With": 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(list)
    })
        .then(response => response.json())
        .then(data => {
            refreshUI(data);
        });
})

function refreshUI(data){
    let row = document.createElement('li');
    let check = document.createElement('input');
    let text = document.createElement('input');
    check.type = "checkbox";
    check.value = data.parent;
    text.type = "text";
    text.className = "text-edit";
    text.value = data.content;
    text.name = data.content;
    text.setAttribute('data-parent', `${data.parent}`);
    text.setAttribute('data-sequence', `${data.sequence}`);
    text.addEventListener('focusout', evt => eventOnEdit(evt));
    row.append(check, text);
    todo.append(row);
    row.style.animation = "'on-add' 500ms ease-in-out";
    setTimeout(e => {wrapper.style.transform = ""}, 1000)
}
