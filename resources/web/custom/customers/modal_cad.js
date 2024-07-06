

console.info('file customer.modal_cad.js')
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
            console.info(formCustomers)
formCustomers.addEventListener('submit',function (event) {
                event.preventDefault()
                let data = new FormData(this)
                let loop =        data.get('billing_values')
                    console.info(loop.toString())

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
                    'billing_labels': data.get('billing_labels'),
                    'billing_values': data.get('billing_values'),
                }
                console.log("data => "+data)
                console.log("dataJson => "+dataJson.billing_values)

                // axios.post('/customers',dataJson)
                //     .then(function (resp) {
                //     if(resp.status >=200 && resp.status <=299){
                //         console.log(resp.status)
                //
                //
                //     }// location.reload()
                // }).catch(function (error) {
                //     // manipula erros da requisição
                //     console.error("erro =>>" + error);
                // })

            });



