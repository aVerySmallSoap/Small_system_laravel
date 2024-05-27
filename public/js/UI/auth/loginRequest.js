let csrf = document.querySelector('meta[name="x-csrf-token"]');

document.querySelector('#form-login').addEventListener('submit', (e) => {
    e.preventDefault();
    let list = {}
    let form = new FormData(e.target);
    form.forEach((value, key) => {
        list[key] = value;
    })
    fetch('/auth/login', {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": csrf.content,
            "X-Requested-With": 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(list)
    })
        .then(response => {
            if(response.ok) {
                return response.json();
            }
        })
        .then(data => {
            document.location.href = '/notes';
        })
});
