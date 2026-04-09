import {Controller} from '@hotwired/stimulus'

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        action: String,
        csrfToken: String
    }

    modal(event) {
        let action = this.actionValue
        let csrfToken = this.csrfTokenValue
        let modal = document.getElementById('modal-delete')

        if (csrfToken && modal) {
            let form = modal.querySelector('form')
            let token = form.querySelector("input[name='_token']")
            form.setAttribute('action', action)
            token.value = csrfToken
        }
    }
}
