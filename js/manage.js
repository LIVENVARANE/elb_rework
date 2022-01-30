document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if(e.target.className.includes('td-close')) {
            if(e.target.tagName == 'i') {
                e.target.parentElement.parentElement.parentElement.parentElement.remove();
            } else {
                e.target.parentElement.remove();
            }
        }
    }, false);

    new Sortable(document.getElementById('table-body-free'), {
        handle: '.handle',
        animation: 150
    });
    new Sortable(document.getElementById('table-body-paid'), {
        handle: '.handle',
        animation: 150
    });
});

function page(name) {
    document.querySelectorAll('.page').forEach(function(page) {
        page.style.display = 'none';
    });

    document.querySelector('.page[page="' + name + '"]').style.display = 'block';
}

function useCheckbox(cb) {
    var newValue;

    if(cb.classList.length > 1) {
        if(cb.classList.contains('on')) { //on -> off
            cb.innerHTML = 'Désactivé';
            cb.classList.remove('on');
            cb.classList.add('off');

            newValue = false;
        } else { //off -> on
            cb.innerHTML = 'Activé';
            cb.classList.remove('off');
            cb.classList.add('on');

            newValue = true;
        }
    }
    
    switch(cb.getAttribute('param')) {
        case 'tooltipsEnabled':
            document.getElementById('customColumn').value = cb.getAttribute('param');
            document.getElementById('customValue').value = newValue;
            document.getElementById('customValueInput').click();
            break;
    }
}

function toggleWizard(wizardName) {
    switch(wizardName) {
        case 'free':
            var wizard = document.getElementById('free-wizard');
            break;
        default:
            return;
    }

    if(wizard.style.display != 'none') { //shown -> will hide<
        wizard.style.display = 'none';

        wizard.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });
    } else { //not shown -> will show
        wizard.style.display = 'block';
    }
}

function addRowForWizardValues(wizardName) {    
    switch (wizardName) {
        case 'free':
            var wizard = document.getElementById('free-wizard');
            document.getElementById('table-body-free').innerHTML = document.getElementById('table-body-free').innerHTML + '<tr class="free-menu"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + wizard.querySelector('input[name="name"]').value + '</td><td contenteditable class="status">' + wizard.querySelector('input[name="status"]').value + '</td><td contenteditable class="image">' + 'ok' + '</td><td contenteditable class="frDL">' + wizard.querySelector('input[name="frDL"]').value + '</td><td contenteditable class="enDL">' + wizard.querySelector('input[name="enDL"]').value + '</td><td class="enabled"><input type="checkbox" /></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
    }

    toggleWizard(wizardName);
}

function addRowForTab(tab, values) {
    switch(tab) {
        case 'free':
            break;
        case 'paid':
            break;
        case 'accounts':
            break;
    }
}