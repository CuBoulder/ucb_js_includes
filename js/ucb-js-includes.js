class JSBlockElement extends HTMLElement {
	constructor() {
		super();
        var config = JSON.parse(this.getAttribute('config'));
        this.build(config.includes_block);

    }

    build(config){      
        // console.log('config', config)  

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

    generateStatusPage(){

    }
    generateLiveChat(){

    }
}
customElements.define('js-include', JSBlockElement);