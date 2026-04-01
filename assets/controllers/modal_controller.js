import {Controller} from '@hotwired/stimulus'

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        target: {type : String, default: 'form-modal'},
        frame: {type : String, default: 'form-frame'},
        src: String,
        title: String,
        size: {type: String, default: 'md'},
    }

    setSrc() {
        let targetValue = this.targetValue
        let target = document.getElementById(targetValue)
        let modal = new Modal(target, {closable: false})

        if (modal) {
            let wrapper = document.getElementById('modal-wrapper')
            wrapper.classList.remove('max-w-sm', 'max-w-md', 'max-w-lg', 'max-w-xl', 'max-w-2xl', 'max-w-3xl')
            if (this.sizeValue === 'sm') wrapper.classList.add('max-w-sm')
            if (this.sizeValue === 'md') wrapper.classList.add('max-w-md')
            if (this.sizeValue === 'lg') wrapper.classList.add('max-w-lg')
            if (this.sizeValue === 'xl') wrapper.classList.add('max-w-xl')
            if (this.sizeValue === '2xl') wrapper.classList.add('max-w-2xl')
            if (this.sizeValue === '3xl') wrapper.classList.add('max-w-3xl')
            if (this.sizeValue === '4xl') wrapper.classList.add('max-w-4xl')
            if (this.sizeValue === '5xl') wrapper.classList.add('max-w-5xl')
            if (this.sizeValue === '6xl') wrapper.classList.add('max-w-6xl')
            if (this.sizeValue === '7xl') wrapper.classList.add('max-w-7xl')

            let title = document.getElementById('modal-title')
            title.innerHTML = this.titleValue

            let src = this.srcValue
            let frame = document.getElementById(this.frameValue)
            frame.setAttribute('src', src)
            frame.loaded.then(function () {
                modal.updateOnShow(function () {
                    let autofocus = frame.querySelector('[autofocus]:not([readonly])')
                    if (autofocus) autofocus.focus()
                })

                modal.show()

                // Dispatch an event, in case we need to do something else when the src is set
                document.dispatchEvent(new CustomEvent('modal:setSrc', {
                    bubbles: true,
                    detail: {
                        frame: targetValue
                    }
                }));
            })
        }
    }

    connect() {
        document.addEventListener('close:modal', this.close.bind(this))
    }

    disconnect() {
        document.removeEventListener('close:modal', this.close.bind(this))
    }

    close(event) {
        let target = document.getElementById(this.targetValue)
        let modal = new Modal(target)
        if (modal) {
            modal.hide()
        }
    }
}
