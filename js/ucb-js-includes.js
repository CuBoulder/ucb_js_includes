class JSBlockElement extends HTMLElement {
	constructor() {
		super();
        var config = JSON.parse(this.getAttribute('config'));
        this.build(config);

    }

    build(config){
        console.log('I am build!', config)

    }
}
customElements.define('js-include', JSBlockElement);