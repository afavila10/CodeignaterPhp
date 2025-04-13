const formId = 'my-form';
const modalId = 'my-modal';
const model = 'profiles';
const tableId = 'table-index';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);

var insertUpdate = true;
var url = "";
var method = "";
var data = "";
var resultFetch = null;

// Show details (disabled form)
function show(id) {
    mainApp.disabledFormAll();
    mainApp.resetForm();
    btnEnabled(true);
    getDataId(id);
}


// Add new profile
function add() {
    mainApp.enableFormAll();
    mainApp.resetForm();
    insertUpdate = true;
    btnEnabled(false);
    mainApp.showModal();
}

// Edit existing profile
function editProfile(id) {
    mainApp.disabledFormEdit();
    mainApp.resetForm();
    insertUpdate = false;
    btnEnabled(false);
    getDataId(id);
}

// Delete a profile
async function deleteProfile(id) {
    method = 'GET';
    url = URI_PROFILES + LIST_CRUD[3] + '/' + id;

    if (confirm(textConfirm) == true) {
        resultFetch = getData("", method, url);
        resultFetch.then(response => response.json())
            .then(data => {
                reloadPage();
            })
            .catch(error => {
                console.error(error);
                mainApp.hiddenPreload();
            });
    }
}

// Fetch profile data by ID
async function getDataId(id) {
    method = 'GET';
    url = URI_PROFILES + LIST_CRUD[1] + '/' + id;
    resultFetch = getData("", method, url);

    resultFetch.then(response => response.json())
        .then(data => {
            mainApp.setDataFormJson(data[model]);
            mainApp.showModal();
            mainApp.hiddenPreload();
        })
        .catch(error => {
            console.error(error);
            mainApp.hiddenPreload();
        });
}

// Enable or disable submit button
function btnEnabled(type) {
    btnSubmit.disabled = type;
}

// Fetch data utility
async function getData(data, method, url) {
    mainApp.showPreload();

    const parameters = {
        method: method,
        headers: {
            "Content-Type": "application/json",
            "X-Requested-with": "XMLHttpRequest"
        },
        ...(method !== 'GET' && { body: JSON.stringify(data) })
    };

    return await fetch(url, parameters);
}

// Initialize DataTable
$(document).ready(function () {
    $('#' + tableId).DataTable();
});

// Handle form submission
mainApp.getForm().addEventListener('submit', async function (event) {
    event.preventDefault();

    if (mainApp.setValidateForm()) {
        mainApp.showPreload();

        if (insertUpdate) {
            method = 'POST';
            url = URI_PROFILES + LIST_CRUD[0];
        } else {
            method = 'POST';
            url = URI_PROFILES + LIST_CRUD[2];
        }

        data = mainApp.getDataFormJson();

        resultFetch = getData(data, method, url);
        resultFetch.then(response => response.json())
            .then(data => {
                mainApp.hiddenPreload();
                reloadPage();
            })
            .catch(error => {
                console.error(error);
                mainApp.hiddenPreload();
            });
    } else {
        alert("Data not valid");
        mainApp.resetForm();
    }
});

// Reload page
function reloadPage() {
    setTimeout(() => {
        mainApp.hiddenPreload();
        location.reload();
    }, 500);
}
