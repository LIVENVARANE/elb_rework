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
        case 'paid':
            var wizard = document.getElementById('paid-wizard');
            break;
        case 'products':
            var wizard = document.getElementById('products-wizard');
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

            var imageName = '';
            if(wizard.querySelector('input[name="free_image"]').value != '') {
                var fileName = wizard.querySelector('input[name="free_image"]').value.split('/').pop().split('\\').pop();
                imageName = fileName.split('.').slice(0, -1).join('.') + '_' + Date.now() + fileName.substring(fileName.lastIndexOf('.'));
            }

            var inputClone = $('#freeImageInput').clone();
            inputClone.attr('id', 'fileInput');
            inputClone.attr('name', 'fileUpload');
            $('#fileUploadContainer').html(inputClone);
            
            document.getElementById('submitFileInput').click();

            document.getElementById('table-body-free').innerHTML = document.getElementById('table-body-free').innerHTML + '<tr class="free-menu"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + wizard.querySelector('input[name="name"]').value + '</td><td contenteditable class="status">' + wizard.querySelector('input[name="status"]').value + '</td><td contenteditable class="image">' + imageName + '</td><td contenteditable class="frDL">' + wizard.querySelector('input[name="frDL"]').value + '</td><td contenteditable class="enDL">' + wizard.querySelector('input[name="enDL"]').value + '</td><td class="enabled"><input type="checkbox" /></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
        case 'paid':
            var wizard = document.getElementById('paid-wizard');
            document.getElementById('table-body-paid').innerHTML = document.getElementById('table-body-paid').innerHTML + '<tr class="paid-menu"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + wizard.querySelector('input[name="name"]').value + '</td><td contenteditable class="status">' + wizard.querySelector('input[name="status"]').value + '</td><td contenteditable class="image">' + 'ok' + '</td><td contenteditable class="description">' + wizard.querySelector('input[name="description"]').value + '</td><td contenteditable class="price">' + wizard.querySelector('input[name="price"]').value + '</td><td contenteditable class="product">' + wizard.querySelector('input[name="product"]').value + '</td><td class="enabled"><input type="checkbox" /></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
        case 'products':
            var wizard = document.getElementById('products-wizard');
            document.getElementById('table-body-products').innerHTML = document.getElementById('table-body-products').innerHTML + '<tr class="product"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + wizard.querySelector('input[name="name"]').value + '</td><td contenteditable class="status">' + wizard.querySelector('input[name="status"]').value + '</td><td contenteditable class="image">' + 'ok' + '</td><td contenteditable class="description">' + wizard.querySelector('input[name="description"]').value + '</td><td contenteditable class="frYTB">' + wizard.querySelector('input[name="frYTB"]').value + '</td><td contenteditable class="enYTB">' + wizard.querySelector('input[name="enYTB"]').value + '</td><td contenteditable class="paymentCode">' + wizard.querySelector('input[name="paymentCode"]').value + '</td><td contenteditable class="price">' + wizard.querySelector('input[name="price"]').value + '</td><td contenteditable class="product">' + wizard.querySelector('input[name="product"]').value + '</td><td class="enabled"><input type="checkbox" /></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
    }

    toggleWizard(wizardName);
}

function addRowForTab(tab, values) {
    switch(tab) {
        case 'free':
            var enabled = '';
            if(values['enabled']) { enabled = 'checked'; }
            document.getElementById('table-body-free').innerHTML = document.getElementById('table-body-free').innerHTML + '<tr class="free-menu"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + values['name'] + '</td><td contenteditable class="status">' + values['safe'] + '</td><td contenteditable class="image">' + values['image'] + '</td><td contenteditable class="frDL">' + values['frDL'] + '</td><td contenteditable class="enDL">' + values['enDL'] + '</td><td class="enabled"><input type="checkbox" ' + enabled + ' ></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
        case 'paid':
            var enabled = '';
            if(values['enabled']) { enabled = 'checked'; }
            document.getElementById('table-body-paid').innerHTML = document.getElementById('table-body-paid').innerHTML + '<tr class="paid-menu"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + values['name'] + '</td><td contenteditable class="status">' + values['safe'] + '</td><td contenteditable class="image">' + values['image'] + '</td><td contenteditable class="description">' + values['description'] + '</td><td contenteditable class="price">' + values['price'] + '</td><td contenteditable class="product">' + values['productNumber'] + '</td><td class="enabled"><input type="checkbox" ' + enabled + ' ></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
        case 'accounts':
            break;
        case 'products':
            var enabled = '';
            if(values['enabled']) { enabled = 'checked'; }
            document.getElementById('table-body-products').innerHTML = document.getElementById('table-body-products').innerHTML + '<tr class="product"><td class="handle"><i class="fas fa-bars"></i></td><td contenteditable class="name">' + values['name'] + '</td><td contenteditable class="status">' + values['safe'] + '</td><td contenteditable class="image">' + values['image'] + '</td><td contenteditable class="description">' + values['description'] + '</td><td contenteditable class="frYTB">' + values['frYTB'] + '</td><td contenteditable class="enYTB">' + values['enYTB'] + '</td><td contenteditable class="paymentCode">' + values['paymentCode'] + '</td><td contenteditable class="price">' + values['price'] + '</td><td contenteditable class="product">' + values['productNumber'] + '</td><td class="enabled"><input type="checkbox" ' + enabled + ' ></td><td class="td-close"><i class="fas fa-times"></i></td></tr>';
            break;
    }
}

function submitTab(tab) {
    switch(tab) {
        case 'free':
            var input = document.getElementById('free-menus-input');
            var submit = document.getElementById('free-menus-submit');
        
            var json = []
        
            document.querySelectorAll('tr[class="free-menu"]').forEach(function(line) {
                json.push({name: line.querySelector('.name').innerText, safe: line.querySelector('.status').innerText, image: line.querySelector('.image').innerText, frDL: line.querySelector('.frDL').innerText, enDL: line.querySelector('.enDL').innerText, enabled: line.querySelector('.enabled').querySelector('input').checked});
            });
        
            input.value = JSON.stringify(json);
            submit.click();
            break;
        case 'paid':
            var input = document.getElementById('paid-menus-input');
            var submit = document.getElementById('paid-menus-submit');
        
            var json = []
        
            document.querySelectorAll('tr[class="paid-menu"]').forEach(function(line) {
                json.push({name: line.querySelector('.name').innerText, safe: line.querySelector('.status').innerText, image: line.querySelector('.image').innerText, description: line.querySelector('.description').innerText, price: line.querySelector('.price').innerText, productNumber: line.querySelector('.product').innerText, enabled: line.querySelector('.enabled').querySelector('input').checked});
            });
        
            input.value = JSON.stringify(json);
            submit.click();
            break;
        case 'accounts':
            break;
        case 'products':
            var input = document.getElementById('products-input');
            var submit = document.getElementById('products-submit');
        
            var json = []
        
            document.querySelectorAll('tr[class="product"]').forEach(function(line) {
                json.push({name: line.querySelector('.name').innerText, safe: line.querySelector('.status').innerText, image: line.querySelector('.image').innerText, description: line.querySelector('.description').innerText, frYTB: line.querySelector('.frYTB').innerText, enYTB: line.querySelector('.enYTB').innerText, paymentCode: line.querySelector('.paymentCode').innerText, price: line.querySelector('.price').innerText, productNumber: line.querySelector('.product').innerText, enabled: line.querySelector('.enabled').querySelector('input').checked});
            });
        
            input.value = JSON.stringify(json);
            submit.click();
            break;
    }
  }