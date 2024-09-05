export function isNullOrUndef(value) {
    return value === null || typeof value === 'undefined';
}

export function isValidElement(value) {
    return !(value === null || typeof value === 'undefined');
}

/**
 *  function taken from stackoverflow on link
 *  https://pt.stackoverflow.com/questions/287393/serialize-com-javascript-puro
 */

export function serialize(form) {
    if (!form || form.nodeName !== "FORM") {
        return
    }
    var i, j, q = [];
    for (i = form.elements.length - 1; i >= 0; i = i - 1) {
        if (form.elements[i].name === "") {
            continue
        }
        switch (form.elements[i].nodeName) {
            case"INPUT":
                switch (form.elements[i].type) {
                    case"text":
                    case"hidden":
                    case"password":
                    case"button":
                    case"reset":
                    case"submit":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case"checkbox":
                    case"radio":
                        if (form.elements[i].checked) {
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value))
                        }
                        break;
                    case"file":
                        break
                }
                break;
            case"TEXTAREA":
                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                break;
            case"SELECT":
                switch (form.elements[i].type) {
                    case"select-one":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case"select-multiple":
                        for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                            if (form.elements[i].options[j].selected) {
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value))
                            }
                        }
                        break
                }
                break;
            case"BUTTON":
                switch (form.elements[i].type) {
                    case"reset":
                    case"submit":
                    case"button":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break
                }
                break
        }
    }
    return q.join("&")
};

export function errorShow(error, errorBox, errorInnexText, idsPrefix) {
    let error_messages = error.response.data.errors;
    // let errorBox =  document.getElementById('error-box')
    // let errorInnexText = document.getElementById('errorMsg')
    console.log('errorBox >  ' + errorBox)
    if (errorBox.classList.contains('hide')) {
        errorBox.classList.remove('hide')
    }
    errorInnexText.innerText = error.response.data.message
    errorInnexText.style.fontStyle = 'bold'
    let item
    for (const fieldIndex in error_messages) {
        if (error_messages.hasOwnProperty(fieldIndex)) {
            console.log(`adicionando classe error ${fieldIndex}: ${error_messages[fieldIndex]}`);
            item = document.getElementsByClassName(`form-line-${fieldIndex}`)
            console.log(item)
            for (let c = 0; c < item.length; c++) {
                if (item[c].classList.contains('success')) {
                    item[c].classList.remove('success')
                    item[c].classList.add('error')
                    document.getElementById(idsPrefix + fieldIndex).style.backgroundColor = '#ffebee'
                    let infoTextUnder = document.getElementById('help-info-' + fieldIndex)
                    if (isValidElement(infoTextUnder)) {
                        infoTextUnder.classList.add('red-text', 'text-darken-4')
                        infoTextUnder.innerText = error_messages[fieldIndex]
                    }
                }
            }
        }
    }
}

export function mountCard(eLContainer, options) {
    if (typeof eLContainer === 'undefined') {
        eLContainer = false
    }
    if (typeof options === 'undefined') {
        options = {}
    }
    let {
        divFormGroupClass = 'form-group',
        divFormLineClass = 'form-line success',
        divHelpInfoClass = 'help-info',
        inputAttributes = {
            id: 'input-viewedit-customer-address',
            name: 'viewedit-customer-address',
            type: 'text',
            fClass: 'form-control'
        },
        labelFieldText = `type data for ${inputAttributes.name}`
    } = options

    // Create
    const divFormGroup = document.createElement('div')
    divFormGroup.setAttribute('class', divFormGroupClass)

    const divFormLine = document.createElement('div')
    divFormLine.setAttribute('class', divFormLineClass)
    const divHelpInfo = document.createElement('div')
    divHelpInfo.setAttribute('class', divHelpInfoClass)
    divHelpInfo.innerText = ""
    const inputField = document.createElement('input')
    inputField.setAttribute('class', 'form-control');
    inputField.setAttribute('id', inputAttributes.id);
    inputField.setAttribute('name', inputAttributes.name);
    inputField.setAttribute('type', inputAttributes.type);
    inputField.setAttribute('class', inputAttributes.fClass)
    const labelField = document.createElement('label');
    labelField.setAttribute('for', inputAttributes.id);
    labelField.innerText = labelFieldText
    divFormLine.appendChild(inputField);
    divFormLine.appendChild(labelField)

    divFormGroup.appendChild(divFormLine);
    divFormGroup.appendChild(divHelpInfo);
    if (eLContainer) {
        eLContainer.appendChild(divFormGroup)
    } else {
        return divFormGroup
    }


}

export function date_format(dataInput) {
    return moment(dataInput).format('L');
}
export function time_format(timeInput) {
    return moment(timeInput).format('LT')
}
