import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

Alpine.store('darkMode', {
    dark: false,

    toggle() {
        this.dark = ! this.dark
        if(this.dark){
            document.documentElement.classList.add('dark')
        }else{
            document.documentElement.classList.remove('dark')
        }
    }
})

window.Alpine = Alpine;

Alpine.start();


