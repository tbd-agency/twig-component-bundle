import { Controller } from '@hotwired/stimulus';
import Cookie from 'js-cookie';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['darkIcon', 'lightIcon']

    connect() {
        if (Cookie.get('color-theme') === 'dark') {
            this.lightIconTarget.classList.remove('hidden')
        } else {
            this.darkIconTarget.classList.remove('hidden')
        }
    }

    toggleDarkMode() {
        let currentTheme

        if (Cookie.get('color-theme') === 'dark') {
            document.documentElement.classList.remove('dark')
            Cookie.set('color-theme', 'light', {expires: 365})
            this.toggleButtons()
            currentTheme = 'light'
        } else {
            document.documentElement.classList.add('dark')
            Cookie.set('color-theme', 'dark', {expires: 365})
            this.toggleButtons()
            currentTheme = 'dark'
        }

        document.dispatchEvent(new CustomEvent('theme:changed', {
            detail: {
                theme: currentTheme,
            },
        }))

        this.element.blur()
    }

    toggleButtons() {
        this.darkIconTarget.classList.toggle('hidden')
        this.lightIconTarget.classList.toggle('hidden')
    }
}
