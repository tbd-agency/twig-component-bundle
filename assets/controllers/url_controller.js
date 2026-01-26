import {Controller} from '@hotwired/stimulus'
import {visit} from '@hotwired/turbo'

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        location: String,
        blackListSelectors: {type: String, default: 'a,svg,path,input,form,button,.actions,.inline-edit,.link'}
    }

    navigate(event) {
        let location = this.locationValue
        let selectors = this.blackListSelectorsValue.split(',')
        if (location) {
            let hasSelection = window.getSelection().toString()
            let selectorFound = false
            selectors.forEach((selector, i) => {
                if (selector && event.target.matches(selector)) selectorFound = true
            })
            // Prevent visit if window has a selection
            // Prevent visit if any of the blacklisted selectors is found
            if (!hasSelection && !selectorFound) {
                event.preventDefault()

                if (event.metaKey || event.ctrlKey) {
                    // Open location _blank if command or ctrl keys are pressed
                    window.open(location, '_blank');
                } else {
                    this.element.disabled = true
                    visit(location)
                }
            }
        }
    }
}
