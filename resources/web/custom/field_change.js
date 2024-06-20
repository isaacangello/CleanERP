function field_change(element,urlBase,token){
    console.log("url => "+urlBase)
    let field = element.getAttribute('name')
    let id = element.getAttribute('id')
    let value = document.querySelector("#"+id) //element.getAttribute('value')

    console.log('alterando campo '+field+" Via axios com valor => "+value.value)
    // console.log(value.value)
    axios.patch(urlBase,
        {
            _token: token,
            fieldName: field,
            value: value.value,
    })
    .then(resp =>{
                console.log(resp)
                    element.classList.add('teal', 'lighten-5')
                setTimeout( ()=> {
                    element.classList.remove('teal', 'lighten-5')
                },1000)



            }

    )
    .catch( resp =>{
                element.classList.add('red', 'lighten-5')
            setTimeout(function () {
                element.classList.remove('red', 'lighten-5')
            },1000)


        }
    )

}
