const setting = document.querySelector('#setting');
let csrf = document.querySelector('meta[name="x-csrf-token"]');

document.addEventListener('contextmenu', e => {
    e.preventDefault();
    setTimeout(e => context(), 10);
});

function context(){
    if(document.querySelector('#context-menu') == null){
        let contextMenu = document.createElement("div");
        contextMenu.id = "context-menu";
        document.body.append(contextMenu);
        actions(contextMenu);
        contextMenu.style.top = `calc(${85}vh - ${contextMenu.getBoundingClientRect().height + setting.getBoundingClientRect().height/2}px)`;
        contextMenu.style.left = `calc(${90}vw - ${contextMenu.getBoundingClientRect().width/2 - setting.getBoundingClientRect().width/2}px)`;
        document.querySelector('#context-menu').style.animation = "context-pop 1s";
        setting.style.background = "none";
        setting.style.border = "1px solid black";
    }else{
        document.querySelector('#context-menu').style.animation = "context-burst 1s";
        setTimeout( e => {
            document.querySelector('#context-menu').remove();

        }, 900);
        setting.style.background = "var(--app-primary)";
        setting.style.border = "";
    }
}

function actions(parent){
    let add = document.createElement('span');
    let notes = document.createElement('span');
    let archives = document.createElement('span');
    let logout = document.createElement('span');
    add.innerText = "New list";
    add.id = "context-add";
    add.setAttribute('focusable', 'true');
    add.onclick = function (e){
        let temp_v = veil();
        document.body.append(temp_v);
    };
    if(document.documentURI.includes('/notes')){
       parent.append(add);
    }else{
        parent.append(notes)
    }
    notes.innerText = "Notes";
    notes.id = "context-note";
    notes.setAttribute('focusable', 'true');
    notes.onclick = function (e){
        document.location.href = '/notes'
    };
    if(document.querySelector('#setting').dataset.role === "admin"){
        archives.innerText = "Archives";
        archives.id = "context-archive";
        archives.setAttribute('focusable', 'true');
        if(!document.documentURI.includes('/archives/1')){
            parent.append(archives);
        }
        archives.onclick = function (e){
            document.location.href = '/archives/1'
        };
    }
    logout.innerText = "Logout";
    logout.id = "context-logout";
    logout.setAttribute('focusable', 'true');
    logout.onclick = function (e){
        document.location.href = '/login'
    };
    parent.append(logout);
}

function veil(){
    let veil = document.createElement('div');
    veil.className = "veil";
    veil.style.animation = "veil-drop 1s ease-in";
    modal(veil);
    veil.addEventListener('click', e => {
        veil.style.animation = "veil-lift 1s ease-out";
        document.querySelector('.modal').style.animationDelay = "500ms";
        document.querySelector('.modal').style.animation = "'modal-lift' 1s ease-out";
        setTimeout(e => {veil.remove()}, 998);
    });
    return veil;
}

function modal(parent){
    let selectLabel = document.createElement("span");
    let select = document.createElement("select");
    select.name = "category";
    selectLabel.className = "select-label";
    selectLabel.innerText = "Category";
    fetch('/fetch/categories', {
        method: 'get',
        headers: {
            "X-CSRF-TOKEN": csrf.content,
            "X-Requested-With": 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => {
            for (const value of data.items) {
                let option = document.createElement("option");
                option.value = value.category_id;
                option.text = value.category_name;
                if(document.querySelector("meta[name=category]") != null &&
                document.querySelector("meta[name=category]").content == value.category_id){
                    option.setAttribute("selected", true);
                }
                select.append(option);
            }
        });
    let modal = document.createElement('div');
    let label = document.createElement('span');
    let input = document.createElement('input');
    let row = document.createElement('div');
    let add = document.createElement('button');
    let cancel = document.createElement('button');
    modal.className = "modal";
    label.className = "modal-label";
    label.innerText = "Add a list";
    input.className = "modal-input";
    input.name = "header";
    row.className = "action-row";
    add.className = "modal-add";
    add.innerText = "Add"
    add.addEventListener('click', e => {
        let input = document.querySelector('.modal>input').value;
        let list = {header: input, category: select.value};
        fetch('/list/insert', {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": csrf.content,
                "X-Requested-With": 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(list)
        })
            .then(r => r.json())
            .then(data => {
                document.querySelector('.veil').style.animation = "veil-lift 1s ease-out";
                document.querySelector('.modal').style.animationDelay = "500ms";
                document.querySelector('.modal').style.animation = "modal-lift 1s ease-out";
                setTimeout(e => {
                    document.querySelector('.veil').remove();
                    document.location.reload();
                }, 900);
            })// unhandled
    })
    cancel.className = "modal-cancel";
    cancel.innerText = "Cancel";
    modal.addEventListener('click', e => {e.stopPropagation()});
    modal.style.animationDelay = "500ms";
    modal.style.animation = "modal-drop 1s ease-out";
    modal.append(label);
    modal.append(selectLabel);
    modal.append(select);
    modal.append(input);
    row.append(cancel, add);
    modal.append(row);
    parent.append(modal);
}
