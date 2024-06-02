let csrf = document.querySelector('meta[name="x-csrf-token"]');

document.querySelector("#form-category").addEventListener('submit', e => {
    e.preventDefault();
    let list = {};
    let data = new FormData(e.currentTarget);
    data.forEach((value, key) => {
        list[key] = value;
    })
    fetch('/category/add', {
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
            document.location.href = `/category/${data.id[0].category_id}`;
        })
});
