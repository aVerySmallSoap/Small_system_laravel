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
        document.querySelector('#context-menu').style.animation = "'context-pop' 1s ease";
        setting.style.background = "none";
        setting.style.border = "1px solid black";
    }else{
        document.querySelector('#context-menu').style.animation = "'context-burst' 1s ease";
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
    add.innerText = "Add a note";
    add.id = "context-add";
    add.setAttribute('focusable', 'true');
    add.onclick = function (e){
        // add a modal to the page
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
        if(!document.documentURI.includes('/notes'))
        document.location.href = '/notes'
    };
    if(!document.documentURI.includes('/archives')){
        parent.append(archives);
    }
    archives.innerText = "Archives";
    archives.id = "context-archive";
    archives.setAttribute('focusable', 'true');
    archives.onclick = function (e){
        if(!document.documentURI.includes('/archives'))
        document.location.href = '/archives'
    };
    logout.innerText = "Logout";
    logout.id = "context-logout";
    logout.setAttribute('focusable', 'true');
    logout.onclick = function (e){
        if(!document.documentURI.includes('/home'))
        document.location.href = '/home'
    };
    parent.append(logout);
}

function veil(){
    let veil = document.createElement('div');
    veil.className = "veil";
    veil.style.animation = "'veil-drop' 1s ease-in";
    modal(veil);
    veil.addEventListener('click', e => {
        veil.style.animation = "'veil-lift' 1s ease-out";
        document.querySelector('.modal').style.animationDelay = "500ms";
        document.querySelector('.modal').style.animation = "'modal-lift' 1s ease-out";
        setTimeout(e => {veil.remove()}, 998);
    });
    return veil;
}

function modal(parent){
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
        let list = {header: input};
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
                document.querySelector('.veil').style.animation = "'veil-lift' 1s ease-out";
                document.querySelector('.modal').style.animationDelay = "500ms";
                document.querySelector('.modal').style.animation = "'modal-lift' 1s ease-out";
                setTimeout(e => {
                    document.querySelector('.veil').remove();
                    document.location.reload();
                }, 998);
            })// unhandled
    })
    cancel.className = "modal-cancel";
    cancel.innerText = "Cancel";
    modal.addEventListener('click', e => {e.stopPropagation()});
    modal.style.animationDelay = "500ms";
    modal.style.animation = "'modal-drop' 1s ease-out";
    modal.append(label);
    modal.append(input);
    row.append(cancel, add);
    modal.append(row);
    parent.append(modal);
}
