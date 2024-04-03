function field_change(element,urlBase,customerId,token){

    let field = element.getAttribute('name')
    let id = element.getAttribute('id')
    let value = document.querySelector("#"+id) //element.getAttribute('value')

    console.log('alterando campo '+field+" Via axios com valor => "+value.value)
    // console.log(value.value)
    axios.patch(urlBase + customerId,
        {
            _token: token,
            fieldName: field,
            value: value.value,
    })
    .then(resp =>{
                console.log(resp)
            }

    )
    .catch( resp =>{
            value.classList.toggle('sucess')
        }
    )

}
