(async ()=>{
    const response = await fetch("/wp-admin/admin-ajax.php", {
        method:'post',
        headers:{
            'Content-Type':'application/x-www-form-urlencoded'
        },
        body: `action=get_settings`,
    })
    const { id, selector, get } = await response.json()
    const elements = document.querySelectorAll( `${selector } select`)
    const form = document.querySelector(`form[data-formid="${id}"]`)
    if( elements.length > 0 && form ) {
        const element = elements[0]
        const response2 = await fetch(get)
        const result = await response2.json()
        for( const item of result ) {
            const option = document.createElement("option")
            option.innerText = item.title
            option.value = item.id
            element.append( option )
        }
    }
})()