const hum_icon = document.querySelector('#hamburger')
const close_icon = document.querySelector('#close')

hum_icon.addEventListener('click', function display()
{
    close_icon.classList.remove('hidden')
    close_icon.classList.add('block')

    hum_icon.classList.remove('block')
    hum_icon.classList.add('hidden')

    console.log('hamburger click')
})
close_icon.addEventListener('click', function display()
{
    close_icon.classList.remove('block')
    close_icon.classList.add('hidden')

    hum_icon.classList.remove('hidden')
    hum_icon.classList.add('block')

    console.log('close click')
})
