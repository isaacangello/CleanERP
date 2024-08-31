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

})