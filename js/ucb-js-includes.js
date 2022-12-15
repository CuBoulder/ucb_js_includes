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
        let div = document.createElement('div')
        div.id = `form_${config.includes_block_slate_form_id}`
        div.innerText = "Loading..."
        let outerScript = document.createElement('script')
        outerScript.innerText = `
            var script = document.createElement('script');
            var div = jQuery('.field-item'),
            comment = div.contents().filter(function() {
            return this.nodeType === 8;
            }).get(0);
        
        if (typeof comment !== "undefined") {
            var options = comment.nodeValue.split(":");
            var optionsquery = '&sys:field:' + options[0] + '=' + options[1];
        } else {
            var optionsquery = '';
        }
        script.async = 1; script.src = 'https://${config.includes_block_slate_domain}/register/?id=${config.includes_block_slate_form_id}&output=embed' + optionsquery + '&div=form_${config.includes_block_slate_form_id}' + ((location.search.length > 1) ? '&' + location.search.substring(1) : ''); var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(script, s);
        `
        outerScript.innerText.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' ') // removes line breaks from template
        this.appendChild(div)
        this.appendChild(outerScript)
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