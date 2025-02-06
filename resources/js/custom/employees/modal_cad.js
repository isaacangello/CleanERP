const formEmp = document.querySelector('#formEmp')

formEmp.addEventListener('submit',function (e) {
    e.preventDefault()
    let data = new FormData(this)

    // fields
    // jjsystem_sys2.employees.name
    // jjsystem_sys2.employees.phone
    // jjsystem_sys2.employees.email
    // jjsystem_sys2.employees.birth
    // jjsystem_sys2.employees.address
    // jjsystem_sys2.employees.name_ref_one
    // jjsystem_sys2.employees.name_ref_two
    // jjsystem_sys2.employees.phone_ref_one
    // jjsystem_sys2.employees.phone_ref_two
    // jjsystem_sys2.employees.restriction
    // jjsystem_sys2.employees.document
    // jjsystem_sys2.employees.description
    // jjsystem_sys2.employees.type
    // jjsystem_sys2.employees.status
    // jjsystem_sys2.employees.shift
    // jjsystem_sys2.employees.username
    // jjsystem_sys2.employees.password
    // jjsystem_sys2.employees.new_user

    let dataJson = {

        '_token': data.get('_token'),
        'name': data.get('name'),
        'address': data.get('address'),
        'phone': data.get('phone'),
        'email': data.get('email'),
        'birth': data.get('birth'),
        'type': data.get('type'),
        'status': data.get('status'),
        'name_ref_one': data.get('name_ref_one'),
        'name_ref_two': data.get('name_ref_two'),
        'phone_ref_one': data.get('phone_ref_one'),
        'phone_ref_two': data.get('phone_ref_two'),
        'restriction': data.get('restriction'),
        'document': data.get('document'),
        'description': data.get('description'),
        'shift': data.get('shift'),
        'username': data.get('username'),
        'password': data.get('password'),
        'new_user': data.get('new_user'),
    }

    axios.post('/api/employee',dataJson)
        .then(function (resp) {
            if(resp.status ===201){
                console.log(resp.data)
                window.location.reload()

            }// location.reload()
        })
        .catch(function (error) {
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
                    for(let c=0;c<item.length;c++){
                        if(item[c].classList.contains('success')){
                            item[c].classList.remove('success')
                            item[c].classList.add('error','red','lighten-5')
                            //document.getElementById('input-cad-'+chave).style.backgroundColor ='#ffebee'
                        }
                    }
                }
            }


        })


})