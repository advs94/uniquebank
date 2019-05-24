const url = 'process.php'
const form = document.querySelector('form')

form.addEventListener('submit', e => {
    e.preventDefault()

    const file = document.querySelector('[type=file]').file
    const formData = new FormData()
    formData.append('file', file)

    fetch(url, {
        method: 'POST',
        body: formData,
    }).then(response => {
        console.log(response)
    })
})