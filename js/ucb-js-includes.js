class JSBlockElement extends HTMLElement {
	constructor() {
		super();
        var config = JSON.parse(this.getAttribute('config'));
        this.build(config.includes_block);

    }

    build(config){
        const blockType = config.includes_block;

        switch (blockType) {
            case "AdmitHub":
                this.generateAdmitHub(config);
                break;
            case "Slate":
                this.generateSlate(config);
                break;
            case "StatusPage":
                this.generateStatusPage(config);
                break;
            case "LiveChat":
                this.generateLiveChat(config);
                break;
        
            default:
                console.log("error", config)
                break;
        }

    }

    generateSlate(config){

    }
    
    generateAdmitHub(config){
       let tokenScript = document.createElement('script')
       tokenScript.innerText= `window.admitHubBot = {botToken: "${config.includes_block_ah_license}" };`

       let chatScript = document.createElement('script')
       chatScript.src="https://webbot.admithub.com/static/js/webchat.js"
       let stylesheet = document.createElement('link')
       stylesheet.rel = "stylesheet"
       stylesheet.type ="text/css"
       stylesheet.href="https://webbot.admithub.com/static/css/webchat.css"

       this.appendChild(tokenScript)
       this.appendChild(chatScript)
       this.appendChild(stylesheet)

    }

    generateStatusPage(config){
        // Only IE11
        const polyfillScript = document.createElement('script');
        polyfillScript.src="https://cdn.polyfill.io/v2/polyfill.min.js"
        // All
        const widgetScript = document.createElement('script');
        widgetScript.src ="https://unpkg.com/@statuspage/status-widget/dist/index.js";

        const webcomponentScript = document.createElement('script');
        webcomponentScript.src = "https://unpkg.com/@webcomponents/webcomponentsjs@2.1.3/webcomponents-bundle.js"

        const StatusPage = document.createElement('statuspage-widget');
        StatusPage.src = config.includes_block_sp_url

        this.appendChild(polyfillScript)
            .appendChild(webcomponentScript)
            .appendChild(widgetScript)
            .appendChild(StatusPage)
    }
    generateLiveChat(){

    }
}
customElements.define('js-include', JSBlockElement);