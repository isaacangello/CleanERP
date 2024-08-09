
function other_email() {
    let selectType = document.querySelector('#select-cad-customer-type')
    let selectedType = selectType.options[selectType.selectedIndex].value
    // console.log(selectedType)
    if(selectedType === 'COMMERCIAL') {
        // console.info('foi')

        let newField = `
                            
                                <div class="col s12">
                                    <label for="textarea-cad-costumer-other_emails">Additional emails.</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea style="padding: 10px;"  id="textarea-cad-costumer-other_emails" name="other_emails"  class="form-control custom-textarea"  rows="4" placeholder="Please type additional emails here..."></textarea>
                                        </div>
                                        <div class="help-info">Type additional emails separated by commas here. max(3000 chars)</div>
                                    </div>
                                </div>
       `
        tempField = document.getElementById('other-emails')

        tempField.classList.add('row', 'clearfix')
        tempField.innerHTML = newField
        tempField.classList.remove('hide')
        // console.log(tempField)
        tempField.style.height = 'auto'
    }else{
        tempField.innerHTML = ''
        tempField.classList.remove('row', 'clearfix')
        tempField.classList.add('hide')
        tempField.style.height = '0'
    }
    console.log()
}

/**
 * the new billing fieldserve
 * @type {string}
 */
let oneCol = `
                        
                            <ul class="collection">
                                <li class="collection-item">
                                    <div class="form-group" style="margin:0;padding: 0;">
                                        <div class="form-line success form-line-label">
                                            <input type="text" id="input-cad-customer-price-label1" name="billing_labels[]" class="form-control" value="">
                                            <label class="form-label" for="input-cad-customer-price-label1">Label</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="collection-item">
                                    <div class="form-group" style="margin:0;padding: 0;">
                                        <div class="form-line success form-line-value">
                                            <input type="text" id="input-cad-customer-price-value1" name="billing_values[]" class="form-control billing-values" value="">
                                            <label class="form-label" for="input-cad-customer-price-value1">Value.</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        
`

/**
 *
 * @type {HTMLElement}
 */
    let btnBilling = document.getElementById('btn-billing')
    let btnBillingClear = document.getElementById('btn-billing-clear')
/**
 *  listener click to add new Billing field
 */
    btnBilling.addEventListener('click',function (event) {
        event.preventDefault()
        let rowBilling = document.getElementById('row-billing')
        if(!rowBilling.classList.contains('row') && !rowBilling.classList.contains('clearfix')){
            rowBilling.classList.add('row', 'clearfix')
        }

        let parser = document.createElement('div');
        parser.classList.add("col" ,"s12", "m3")
        parser.innerHTML = oneCol
        rowBilling.append(parser) //= rowBilling.innerHTML +
        if(rowBilling.classList.contains('hide')){
            rowBilling.classList.remove('hide')
        }

    })
/**
 * clear Billing fields
 */
btnBillingClear.addEventListener('click',function (e) {
    e.preventDefault()
    let rowBilling = document.getElementById('row-billing')
    rowBilling.innerHTML = " "
    if(!rowBilling.classList.contains('hide')){
        rowBilling.classList.remove('row','clearfix')
        rowBilling.classList.add('hide')
    }

})

/**
 jjsystem_sys2.customers.id
jjsystem_sys2.customers.name
jjsystem_sys2.customers.address
jjsystem_sys2.customers.complement
jjsystem_sys2.customers.phone
jjsystem_sys2.customers.email
jjsystem_sys2.customers.type
jjsystem_sys2.customers.status
jjsystem_sys2.customers.frequency
jjsystem_sys2.customers.other_services
jjsystem_sys2.customers.justify_inactive
jjsystem_sys2.customers.info
jjsystem_sys2.customers.drive_licence
jjsystem_sys2.customers.key
jjsystem_sys2.customers.more_girl
jjsystem_sys2.customers.gate_code
jjsystem_sys2.customers.house_description
jjsystem_sys2.customers.note
jjsystem_sys2.customers.deleted_at
jjsystem_sys2.customers.created_at
jjsystem_sys2.customers.updated_at
jjsystem_sys2.customers.standard_charges

*/

            const formCustomers =  document.getElementById('customer-form-cad')
formCustomers.addEventListener('submit',function (event) {
                event.preventDefault()
                let errorBox =  document.getElementById('error-box')
                let errorInnexText = document.getElementById('errorMsg')
                if(!errorBox.classList.contains('hide')){
                    errorBox.classList.add('hide')
                    errorInnexText.innerText = ' '
                }




                let BillingObj = {}
                let BillingLabels = document.getElementsByName('billing_labels[]')
                let BillingValues = document.getElementsByName('billing_values[]')
                let BillingValuesSelected = document.getElementsByName('billing-values-selected[]')
                    // console.log(BillingValues)
                 for(c=0;c < BillingValues.length;c++){
                     BillingObj[BillingLabels[c].value] = BillingValues[c].value
                    // console.info(BillingObj)
                }
                let data = new FormData(this)


                let dataJson = {

                    '_token': data.get('_token') ,
                    'name': data.get('name'),
                    'address': data.get('address'),
                    'phone': data.get('phone'),
                    'email': data.get('email'),
                    'type': data.get('type'),
                    'status': data.get('status'),
                    'frequency': data.get('frequency'),
                    'other_services': data.get('other_services'),
                    'justify_inactive': data.get('justify_inactive'),
                    'info': data.get('info'),
                    'drive_licence': data.get('drive_licence'),
                    'key': data.get('key'),
                    'more_girl': data.get('more_girl'),
                    'gate_code': data.get('gate_code'),
                    'house_description': data.get('house_description'),
                    'note': data.get('note'),
                    'billing_labels': data.getAll('billing_labels[]'),
                    'billing_values': data.getAll('billing_values[]'),
                    'billing_values_selected': data.getAll('billing-values-selected[]'),
                    'billing_obj': BillingObj,

                }
                // console.log("data => "+data)
                // console.log("dataJson => "+dataJson.billing_labels)
                // console.info("Axios >"+axios)
                axios.post('/api/customer',dataJson)
                    .then(function (resp) {
                    if(resp.status ===201){
                        console.log(resp.data)
                        window.location.reload()

                    }// location.reload()
                }).catch(function (error) {
                    // manipula erros da requisição
                    let error_messages = error.response.data.errors

                    let errorBox =  document.getElementById('error-box')
                    let errorInnexText = document.getElementById('errorMsg')
                    // console.log(errorBox)
                    if(errorBox.classList.contains('hide')){errorBox.classList.remove('hide')}
                    errorInnexText.innerText =  error.response.data.message
                    errorInnexText.style.fontStyle = 'bold'
                    let item
                    for (const chave in error_messages) {
                        if (error_messages.hasOwnProperty(chave)) {
                            // console.log(`adicionando classe error ${chave}: ${error_messages[chave]}`);
                            item = document.getElementsByClassName(`form-line-${chave}`)
                            // console.log(item)
                            for(c=0;c<item.length;c++){
                                if(item[c].classList.contains('success')){
                                    item[c].classList.remove('success')
                                    item[c].classList.add('error')
                                    document.getElementById('input-cad-customer-'+chave).style.backgroundColor ='#ffebee'
                                }
                            }
                        }
                    }


                })

            });



