/* the lines of code are declaring constants and initialixzing variables in a JavaScript file.
a breackdowm of what each line is doing*/
const formId = 'my-form';
const modalId = 'my-modal';
const model = 'userStatus';
const tableId = 'table-index';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);




/**
 * these lines of code are declaring and initicalizing variables in a Javaascript fle.Here is a 
 * brackdowm of what each variable is used for:*/
var insertUpdate = true;
var url = "";
var method = "";
var url = "";
var data = "";
var resultFetch = null;

/**
 * the function 'showStatus' disables all form elements, resets the form, enables a button, and 
 * retrevies the status based on the prvided ID
 * @param /id - the 'id' parameter is used to indentify a especific status that needs to be displayed 
 * 
 */
function show(id) {
    mainApp.disabledFormAll();
    mainApp.resetForm();
    btnEnabled(true);
    getDataId(id);
}

/**
 * the function 'newStatus' anables a form, resets it, sets a flag, disables a button, and shows a
 * modal
 */
function add(){
    mainApp.enableFormAll();
    mainApp.resetForm();
    insertUpdate = true;
    btnEnabled(false);
    mainApp.showModal();
}
/**
 * the function 'editStatus' disables form editing, resets the form, sets 'insertUpdate' to false
 * disables a button, and tretieves the status Id
 * @param /id- the 'id' parameter in the 'editStatus' function is used to identify the specific status
 * that needs tobe edited 
 */
function editStatus(id) {
    mainApp.disabledFormEdit();
    mainApp.resetForm();
    insertUpdate = false;
    btnEnabled(false);
    getDataId(id);
}
/**
 * the function 'deleteStatus' is a asyncrhronous funbction that sends a GET request to delete a status
 * based on the provided ID, with a confirmation prompt a subsequent data retrieval and page reload.
 * @param / id- the 'id' parameter in the 'deleteStatus' function represents the unique identifier of 
 * the status that you want to delete. this identifier is used to specify which status entry should be
 *  delete  from the system
 * 
 */
async function deleteStatus(id) {
    method ='GET';
    url = URI_STATUS + LIST_CRUD[3] + '/' + id;
    data = "";
    if (confirm(textConfirm) == true) {
        resultFetch = getData(data,method, url);
        resultFetch.then(response => response.json())
        .then(data => {
            //console.log(data);
             //reload view
            reloadPage(); 
        })
        .catch(error => {
            console.error(error);
            //hidden preload
            mainApp.hiddenPreload();
        })
        .finally();
    } else {
    }
}

/**
 * the function 'getDataId' makes an asynchronous GET request to retrieve data based on an ID, then
 * processes the response data to update the form, show a modal,  and handle errors.
 * @param / id- The 'id'  paremeter in the 'getDataId' function is used to specify the ID of the status
 * you want to retrieve
 */

async function getDataId(id) {
    method = 'GET';
    url = URI_STATUS + LIST_CRUD[1] + '/' + id; 
    
    data = mainApp.getDataFormJson();
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
        .then(data => {
            //console.log(data);
            //set data form 
            mainApp.setDataFormJson(data[model]);
            //show modal
            mainApp.showModal();
            //hidden preload
            mainApp.hiddenPreload();
        })
        .catch(error => {
            console.error(error);
            //hidden preload
            mainApp.hiddenPreload();
        })
        .finally();
}
/**
 * the function 'btnEnabled' is used to enable or disable a button based on the 'type' parameter
 * @param type- The 'type' parameter in the 'btnEnabled' function is used to determine whether the 
 * button should be enable or disable. If 'type' is 'true', the button will be disable, and if
 * 'type' is 'false', the button will be enable.
 */
function btnEnabled(type) {
    btnSubmit.disabled = type;
}

/**
 * the function 'getData' is an asynchronous function that sends a request to a specified URL using the
 * specified method and data.
 * @param / data-The 'data' parameter in the 'getData' function represents the data that will be sent
 * in the request body when making a POST or PUTR request. It should be an object containing the data
 * you want to send to the server in JSON format.
 * @param / method - The 'method' parameter in the 'getData' function specifiesthe HTTP REQUEST METHOD 
 * to be used for the API call. It can be either "GET" or anoster HTTP method like "POST","PUT",
 * "DELETE", etc.
 * @param /url - The 'url' parameter in the 'getData' function is the URL tro which the HTTP request will
 * be sent. It specifies the location of  the resource that the  function will interact with.
 * @returns The function 'getData' is returning the result of the 'fetch' functon with the specified 
 * 'url' and 'parameters', the 'fetch' function is making an asynchronous request to the specified URL
 * with the given parameters.
 */

async function getData(data, method, url) {
    var parameters;
    mainApp.showPreload();
    if (method === "GET") {
        parameters = {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-Requested-with": "XMLHttpRequest"
            }
        }
    }else{
        parameters = {
            method: method,
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-with": "XMLHttpRequest"
            }
        }
    }
    return await fetch(url, parameters);
}

/**the code '$(document).ready(fuction () { $('#' + tableId).DataTable();});' is using JQuery to
 * initialize a DataTable on a specified HTML table element identified by the 'tableId' variable 
*/
$(document).ready(function () {
    $('#' + tableId).DataTable();
});


mainApp.getForm().addEventListener('submit', async function (event) {
    event.preventDefault();
    if (mainApp.setValidateForm()){
        //show preload
        mainApp.showPreload();
        if (insertUpdate){
            method = 'POST';
            url = URI_STATUS + LIST_CRUD[0];
            
            data = mainApp.getDataFormJson();
            resultFetch = getData(data, method, url);
            resultFetch.then(response => response.json())
            .then(data => {
                //console.log(data);
                // //show modal
                //mainApp.hiddenPreloadModal();
                mainApp.hiddenPreload();
                //relod view 
                reloadPage();
            })
            .catch(error => {
                console.error(error);
                    //hidden preload
                mainApp.hiddenPreload();
            })
            .finally();
        }else{
            method = 'POST';
            url = URI_STATUS + LIST_CRUD[2];
            data = mainApp.getDataFormJson();
            const resultFetch = getData(data,method, url);
            resultFetch.then(response => response.json())
                .then(data => {
                    //console.log(data);
                    //show modal
                    mainApp.hiddenModal();
                    //relod view    
                    reloadPage();
                })
                .catch(error => {
                    console.error(error);
                    //hidden preload
                    mainApp.hiddenPreload();
                })
                .finally();
        }
    } else {
        alert("data Validate");
        mainApp.resetForm();
    }
});
/**
 * the function 'reloadPage' hides a preload element, waits for 500 milliseconds, and then reloads the
 *  page
 */
function reloadPage() {
    setTimeout(function (){
        //hiddden preload
        mainApp.hiddenPreload();
        location.reload();
    },500)
}
