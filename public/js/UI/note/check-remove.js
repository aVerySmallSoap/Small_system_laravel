document.querySelectorAll("input[type=checkbox]").forEach(e => {
    e.addEventListener('click', e => {
        isChecked(e);
    });
})

function isChecked(checkbox){
    let e = checkbox;
    if(e.target.checked) {
        e.target.nextElementSibling.classList.add("note-done");
        fetch('/note/done', {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": csrf.content,
                "X-Requested-With": 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(
                {
                    input: e.target.value,
                    parent: e.target.nextElementSibling.dataset.parent,
                    value: 1
                })
        })
            .then()
    }else{
        e.target.nextElementSibling.classList.remove("note-done");
        fetch('/note/done', {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": csrf.content,
                "X-Requested-With": 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(
                {
                    input: e.target.value,
                    parent: e.target.nextElementSibling.dataset.parent,
                    value: 0
                })
        })
            .then()
    }
}
