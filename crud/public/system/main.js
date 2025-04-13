class Main {
    /**The constructor function initializes properties for managing a model from in JavaScript.
* @param modelId - The 'modelId' parameter is the ID of the model element that you want to initialize to a bootstrap model.
* @param formId - The 'formId' parameter in the constructor function refers to the ID of the form.
element in the HTML document. This ID is used to select and manipulate the form element within the JavaScript code.
* @param classEdit - The 'classEdit' parameter in the constructor function is used to store a CSS.
class name that will be used for editing elements in the form. This class name will be applied to elements within the form to indicate that they are in their mode.
* @param preloadId - The 'preloadId' parameter in the constructor function is used to specify the ID.
of the element that represents a preloader or loading indicator in the HTML document. This element is typically displayed while data is being loaded or processed asynchronously to provide feedback to the user that an operation is in progress.

**/

constructor(modalId, formId, classEdit, preloadId) {
    this.myModal = new bootstrap.Modal(document.getElementById(modalId));
    this.myForm = document.getElementById(formId);
    this.classEdit = classEdit;
    this.elementJson = {};
    this.fromData = new FormData();
    this.preload = document.getElementById(preloadId);
    }

    /**
     * the function 'showPreload() sets the display of an element with the class 'preload' to
     * "block"
     * **/
    showPreload() {
        this.preload.style.display = "block";
    }
    /**
     * the 'hiddenPreload' function hides the preload elemnet by setting its display style to "none" 
     * */
    hiddenPreload() {
        this.preload.style.display = "none";
    }
    /**
     * the function showModal() displays a model
     * 
     */
    showModal() {
        this.myModal.show();
    }
    /**
     * the 'hidenModal' function hides a modal element
     */
    hiddenModal() {
        this.myModal.hide();
    }
    /**
     * the getForm fuction returns the myForm property
     * @returns the 'myForm property is being returned from the 'getForm' method**/
    getForm() {
        return this.myForm;
    }
    /**
     * the function 'disababledFormAll' disables all input and select elements within a specified form
     * 
     */
    disabledFormAll(){
        var elementsInput = this.myForm.querySelectorAll('input');
        var elementsSelect = this.myForm.querySelectorAll('select');
        for (let i = 0; i < elementsInput.length; i++) {
            elementsInput[i].disabled = true;
        }
        for (let j = 0; j < elementsSelect.length; j++) {
            elementsInput[i].disable= true;
        }
    }
    /**
     * the function 'disableFormEdit' disables form elements besed on their class name
     * **/
    disabledFormEdit(){
        var elementsInput = this.myForm.querySelectorAll('input');
        var elementsSelect = this.myForm.querySelectorAll('select');
        for (let i = 0; i < elementsInput.length; i++) {
            if (elementsInput[i].classList.contains(this.classEdit)) {
                elementsInput[i].disabled = true;
        } else{
            elementsInput[i].disabled = false;
        }
    }
    for (let j = 0; j < elementsSelect.length; j++) {
        if (elementsSelect[j].classList.contains(this.classEdit)) {
            elementsSelect[j].disabled = true;
            } else{
                elementsSelect[j].disabled = false;
            }
        }     
    }
    /**
     * the enableFormAll function enables all input and select elements within a form
     * 
     */
    enableFormAll(){
        var elementsInput = this.myForm.querySelectorAll('input');
        var elementsSelect = this.myForm.querySelectorAll('select'); 
        
        for (let i = 0; i < elementsInput.length; i++){
            elementsInput[i].disabled = false;
        }
        for (let j = 0; j < elementsSelect.length; j++){
            elementsSelect[j].disabled = false;
        }
    }

    /*the 'resetForm' function clears the input values of all nput flieds and select elements within a from and resets the form
     */
    resetForm(){
        var elementsInput = this.myForm.querySelectorAll('input');
        var elementsSelect = this.myForm.querySelectorAll('select');

        for (let i = 0; i < elementsInput.length; i++) {
            elementsInput[i].value = "";   
        }
        for (let j = 0; j < elementsSelect.length; j++) {
            elementsSelect[j].value = "";   
        }
        this.myForm.reset();
    }
    /**
     *the fuction 'getDataFormJson' retrieves form data frominput and sele elements and returns it as a JSON object
     @returns the 'getDataFormJson()' function returns an object incluides key-value pairs where the key is 
     the ID of the form elements and the value is the trimmed value if the form element (or the checked
      status for checkboxes).
      */
    getDataFormJson(){
        var elementsForm = this.myForm.querySelectorAll('input, select');
        let getJson = {};
        elementsForm.forEach(function (element){
            if(element.id){
                if(element.tagName === 'INPUT'){
                    if(element.type === 'checkbox'){
                        getJson[element.id] = element.checked;
                    }else{
                        getJson[element.id] = element.value.trim();
                    }
                }else if(element.tagName ==='SELECT'){
                    getJson[element.id] = element.value.trim();
                }
            }
        });
        return getJson;
    }
    /**
     * the function 'setDataFormJson' populates form input fields with values from a JSON  object bases o
     * element IDs.
     * @param json - the 'json' parameter in the 'setDataFormJson' function is expected to be a javascript
     * object that contains key-value pairs where the keys correspond to the 'id' attributes of form 
     * elements (input fields or seleect dropdpwns) and the values are the data that should be set in those
     * form elements
     */
    setDataFormJson(json){
        let elements = this.myForm.querySelectorAll("input,select");
        for (let i = 0; i < elements.length; i++) {
            document.getElementById(elements[i].id).value = json[elements[i].id];
        }
    }
    /**
 * The function `setValidateForm` validates form inputs and selects, displaying error messages and 
 * focusing on the first invalid field if necessary.
 * @returns The `setValidateForm()` function returns either `true` if the form is valid or `false` if 
 * the form is not valid.
 */
    setValidateForm() {
        const objForm = this.myForm;
        const inputs = objForm.querySelectorAll('input');
        const selects = objForm.querySelectorAll('select');
        let formValidate = true;
        for (const input of inputs) {
            if (!this.validateInput(input)) {
                formValidate = false;
                this.showMessageError(input);
            }
        }
        for (const select of selects) {
            if (select.value == 0) {
                formValidate = false;
                select.focus();
            }
        }
        if (formValidate) {
            this.hiddenMessageError();
            return true;
        } else {
            return false;
        }
    }
    /**
     * * The function `validateInput` determines the type of input and calls the corresponding validation 
     * function.
     * @param input - The `input` parameter seems to be an object with a `type` property that determines 
     * the type of validation to be performed. The `validateInput` function then calls different 
     * validation functions based on the `type` of input. The possible types of input for validation are 
     *  `text`, `email`.
     *  @returns The `validateInput` function returns the result of calling a specific validation function 
     *  based on the input type. If the input type is `text`, it calls `validateText(input)`, if it is 
     *  `email`, it calls `validateEmail(input)`, if it is `password`, it calls `validatePassword(input)`, 
     *  if it is `number`, it calls `validateNumber(input)`.
     * */
    validateInput(input) {
        const type = input.type;
        switch (type) {
            case 'text':
                return this.validateText(input);
            case 'email':
                return this.validateEmail(input);
            case 'password':
                return this.validatePassword(input);
            case 'number':
                return this.validateNumber(input);
            default:
                return true;
        }
    }
    /**
     * the function 'validateText' chechs if the input value is not empty, not just whitespace, and has a
     * length of at least 4 characteres.
     * @param input -the 'input' parameter in the 'valdateText' function seems to be an object with a 
     * 'value' property. the function checks if the 'values' property is an empty string, consists only of 
     * whitespace characters, or has a length less than 4. if any of these conditions are met 
     * @returns the 'validateText' fuc¿nction returns 'true' if the input value is not empty,m not just
     * whitespace, and has a length of at least 4 characters. otherwise, it returns 'false'.
     */
    validateText(input) {
        if (input.value.trim() === '' || input.value.trim === '' || input.value.length < 4) {
            return false;
        }
        return true;
    }

    /**
     * * The function `validateEmail` uses a regular expression to check if the input value is a valid email 
     * address.
     * @param /input- The `input` parameter in the `validateEmail` function seems to be an object with a 
     *  `value` property. The function uses a regular expression to validate whether the value of the 
     *  `input` object matches the pattern of a valid email address. If the value passes the validation, 
     *  the function returns
     *  @returns The `validateEmail` function is returning a boolean value indicating whether the input 
     *  value matches the email regex pattern. If the input value is a valid email address according to the 
     *  regex pattern, the function will return `true`, otherwise it will return `false`./
    */
    validateEmail(input) {
    const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(input.value);
    }
    /**
     * The function `validatePassword` checks if the input password is at least 8 
     * characters and returns true if it meets the criteria,otherwise false.
     * @param /input- the 'input' parameter in the 'validatePassword' function seems to be an object with
     * a 'values' property. the function checks if the length of the 'value' is less than 8 characters and
     * returns 'false' if it is, indicating that the password is not valid.otherwise,
     * @returns The function 'validatePassword' is returning 'true' if the length of the input value is
     * at least 8 characters,and 'false' otherwise.
     */
    validatePassword(input) {
        if(input.value.length < 8) {
            return false;
        }
        return true;
    }
    /**
     * The function 'validateNumber' checks if the input value is a number in JavaScript.
     * @param /input - The 'input' parameter in the 'validateNumber' function seems to be an object with
     * a ' value' property. The function checks if the 'value' property of the 'input' objects is a valid
     * number using the 'isNaN' function. if the value is not a number, the function 
     * @returns The function 'validateNumber' is returning 'true' if the input value is a number,and
     * 'false' if it is not a number.
     */
    validateNumber(input){
        if (isNaN(input.value)){
            return false;
        }
        return true;
    }

    /**
     * the function 'showMessageError' adds an error class to an input elemement and appends a message 
     * indicating that the field is invalid.
     * @param /input - the 'input' parameter in the 'showMessageError' function is typically a reference 
     * to an HTML input element that needs to display an error message,The function adds a CSS class
     * 'error' to the input element to visually indicate an error, and then creates anew 'span' element
     * to display
     */
    showMessageError(input){
        input.classList.add('error');
        const messageError = document.createElement('span');
        messageError.classList.add('message-error');
        messageError.textContent = 'This field is invalid';
        input.parentNode.appendChild(messageError);
    }
    /**
     * the 'hiddenMessageError' function clears the innner HTML content of all elements with the class
     * name 'messageError'
     */
    hiddenMessageError(){
        const message = document.querySelectorAll('.message-error');
        for (let data of message){
            data.innerHTML = "";
        }
    }
}