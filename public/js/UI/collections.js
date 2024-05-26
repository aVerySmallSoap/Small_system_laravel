document.querySelectorAll('.card-container').forEach(c => {
    let button = c.childNodes.item(3).childNodes.item(1);
    c.addEventListener('mouseover', e => {
            button.style.display = "block";
    });
    c.addEventListener('mouseout', e => {
        button.style.display = "none";
    });
})

document.querySelectorAll('.archive').forEach(elem => {
    elem.addEventListener('click', e => {
        e.stopImmediatePropagation();
        let list = {id: e.target.dataset.note}
        fetch('/list/archive', {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": csrf.content,
                "X-Requested-With": 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(list)
        })
            .then(res => res.json())
            .then(data => {
                document.location.reload();
            });
    });
})
