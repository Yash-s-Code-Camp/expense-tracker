const hum_icon = document.querySelector('#hamburger')
const close_icon = document.querySelector('#close')
const nav_links = document.querySelector('#nav-links')


hum_icon.addEventListener('click', function()
{
    close_icon.classList.remove('hidden')
    close_icon.classList.add('block')

    hum_icon.classList.remove('block')
    hum_icon.classList.add('hidden')

    nav_links.classList.toggle('hidden')
    nav_links.classList.add('transition')

    console.log('hamburger click')
})
close_icon.addEventListener('click', function()
{
    close_icon.classList.remove('block')
    close_icon.classList.add('hidden')

    hum_icon.classList.remove('hidden')
    hum_icon.classList.add('block')

    nav_links.classList.toggle('hidden')

    console.log('close click')
})
