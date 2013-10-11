// Clears textarea and changes style when clicked on for the first time
function cleartext(t1) {

if (t1.defaultValue==t1.value) t1.value = ""
t1.style.color = '#000000';// It could be styled initially as #cccccc;
}

function selectform(triaform) {

if (triaform=="0") {

	//Modify DOM
	var f = document.forms['cercaform'];
	var cercatext = document.getElementById('es');
	cercatext.setAttribute('name', 'keys');
	f.setAttribute('action', '/search/node');

	removeElement('fulltextsearch');

}

if (triaform=="1") {

	//Modify DOM
	var f = document.forms['cercaform'];
	var cercatext = document.getElementById('es');
	cercatext.setAttribute('name', 'search');
	f.setAttribute('action', '/wiki/Especial:Cerca');
	removeElement('ns100search');
	
	var fulltext = document.createElement("input");
	fulltext.setAttribute('name', 'fulltext');
	fulltext.setAttribute('value', 'yes');
	fulltext.setAttribute('id', 'fulltextsearch');
	fulltext.setAttribute('type', 'hidden');
	f.appendChild(fulltext);


}

if (triaform=="2") {

	//Modify DOM
	var f = document.forms['cercaform'];
	var cercatext = document.getElementById('es');
	cercatext.setAttribute('name', 'keywords');
	f.setAttribute('action', '/forum/search.php');

	removeElement('fulltextsearch');

}

if (triaform=="3") {

	//Modify DOM
	var f = document.forms['cercaform'];
	var cercatext = document.getElementById('es');
	cercatext.setAttribute('name', 'search');
	f.setAttribute('action', '/wiki/Especial:Cerca');

	var fulltext = document.createElement("input");
	fulltext.setAttribute('name', 'fulltext');
	fulltext.setAttribute('value', 'yes');
	fulltext.setAttribute('id', 'fulltextsearch');
	fulltext.setAttribute('type', 'hidden');
	f.appendChild(fulltext);

	var ns100 = document.createElement("input");
	ns100.setAttribute('name', 'ns100');
	ns100.setAttribute('value', '1');
	ns100.setAttribute('id', 'ns100search');
	ns100.setAttribute('type', 'hidden');
	f.appendChild(ns100);
}

}


function correu_novetats(form) {

window.open('/cgi-bin/infosubs.cgi?email='+form.email.value+'&action='+form.action.selectedIndex,'','height=300,width=300,left=80,top=80');

}

function removeElement(id)	{
	var Node = document.getElementById(id);

	if (Node) {

		Node.parentNode.removeChild(Node);
	}
}

function subscriu_novetats() {

	 var subscriubox = document.getElementById("boxsubscriu");
	 subscriubox.style.cssText="display:block; padding-top:5px;";
	 subscriubox.setAttribute("style", "display:block; padding-top:5px;");
	
}

function llista_enable(cas) {


		var llistawin1 = document.getElementById("llistawin1");
		var llistawin2 = document.getElementById("llistawin2");
                var llistamac1 = document.getElementById("llistamac1");
		var llistamac2 = document.getElementById("llistamac2");
                var llistalin1 = document.getElementById("llistalin1");
		var llistalin2 = document.getElementById("llistalin2");
                var llistamob1 = document.getElementById("llistamob1");
		var llistamob2 = document.getElementById("llistamob2");
		
		var liwin = document.getElementById("windows_home");
		var lilin = document.getElementById("linux_home");
		var limac = document.getElementById("mac_home");
		var limob = document.getElementById("mob_home");
                var spanwin = document.getElementById("windows_link");
		var spanlin = document.getElementById("linux_link");
		var spanmac = document.getElementById("mac_link");
		var spanmob = document.getElementById("mob_link");
		
		var icon1win = document.getElementById("win1");
                var icon1lin = document.getElementById("lin1");
                var icon1mac = document.getElementById("mac1");
                var icon2win = document.getElementById("win2");
                var icon2lin = document.getElementById("lin2");
                var icon2mac = document.getElementById("mac2");


        if (cas == "lin") {

		/**IE**/
		llistawin1.style.cssText="display:none;";
	        llistawin2.style.cssText="display:none;";
        	llistamac1.style.cssText="display:none;";
	        llistamac2.style.cssText="display:none;";
		llistalin1.style.cssText="display:block;";
	        llistalin2.style.cssText="display:block;";
		llistamob1.style.cssText="display:none;";
	        llistamob2.style.cssText="display:none;";
	        
		/**Std**/
		llistawin1.setAttribute("style", "display:none;");
                llistawin2.setAttribute("style", "display:none;");
                llistamac1.setAttribute("style", "display:none;");
                llistamac2.setAttribute("style", "display:none;");
                llistalin1.setAttribute("style", "display:block;");
                llistalin2.setAttribute("style", "display:block;");
                llistamob1.setAttribute("style", "display:none;");
                llistamob2.setAttribute("style", "display:none;");
                
                /**IE**/
                icon1win.style.cssText="display:none;";
                icon2win.style.cssText="display:inline;";
                icon1mac.style.cssText="display:none;";
                icon2mac.style.cssText="display:inline;";
                icon1lin.style.cssText="display:inline;";
                icon2lin.style.cssText="display:none;";

                /**Std**/
                icon1win.setAttribute("style", "display:none;");
                icon2win.setAttribute("style", "display:inline;");
                icon1mac.setAttribute("style", "display:none;");
                icon2mac.setAttribute("style", "display:inline;");
                icon1lin.setAttribute("style", "display:inline;");
                icon2lin.setAttribute("style", "display:none;");



                liwin.setAttribute("className", "");
		liwin.setAttribute("class", "");
		lilin.setAttribute("className", "selected_home");
		lilin.setAttribute("class", "selected_home");
                limac.setAttribute("className", "");
		limac.setAttribute("class", "");
		limob.setAttribute("className", "");
		limob.setAttribute("class", "");
		
		spanwin.innerHTML = "<a href=\"javascript:llista_enable('win')\" onclick=\"javascript:llista_enable('win')\"> Windows</a>";
                spanlin.innerHTML = " GNU/Linux";
                spanmac.innerHTML = "<a href=\"javascript:llista_enable('mac')\" onclick=\"javascript:llista_enable('mac')\"> Mac</a>";
                spanmob.innerHTML = "<a href=\"javascript:llista_enable('mob')\" onclick=\"javascript:llista_enable('mob')\"> Mòbil/tauleta</a>";
                
	}

	if (cas =="mac") {

		/**IE**/
                llistawin1.style.cssText="display:none;";
                llistawin2.style.cssText="display:none;";
                llistamac1.style.cssText="display:block;";
                llistamac2.style.cssText="display:block;";
                llistalin1.style.cssText="display:none;";
                llistalin2.style.cssText="display:none;";
		llistamob1.style.cssText="display:none;";
	        llistamob2.style.cssText="display:none;";
	        			
		/**Std**/
                llistawin1.setAttribute("style", "display:none;");
		llistawin2.setAttribute("style", "display:none;");
                llistamac1.setAttribute("style", "display:block;");
                llistamac2.setAttribute("style", "display:block;");
                llistalin1.setAttribute("style", "display:none;");
                llistalin2.setAttribute("style", "display:none;");
                llistamob1.setAttribute("style", "display:none;");
                llistamob2.setAttribute("style", "display:none;");
                
                /**IE**/
                icon1win.style.cssText="display:none;";
                icon2win.style.cssText="display:inline;";
                icon1mac.style.cssText="display:inline;";
                icon2mac.style.cssText="display:none;";
                icon1lin.style.cssText="display:none;";
                icon2lin.style.cssText="display:inline;";

                /**Std**/
                icon1win.setAttribute("style", "display:none;");
                icon2win.setAttribute("style", "display:inline;");
                icon1mac.setAttribute("style", "display:inline;");
                icon2mac.setAttribute("style", "display:none;");
                icon1lin.setAttribute("style", "display:none;");
                icon2lin.setAttribute("style", "display:inline;");

		liwin.setAttribute("className", "");
                liwin.setAttribute("class", "");
		lilin.setAttribute("className", "");
		lilin.setAttribute("class", "");
		limac.setAttribute("className", "selected_home");
                limac.setAttribute("class", "selected_home");
		limob.setAttribute("className", "");
		limob.setAttribute("class", "");
		
                spanwin.innerHTML = "<a href=\"javascript:llista_enable('win')\" onclick=\"javascript:llista_enable('win')\"> Windows</a>";
		spanlin.innerHTML = "<a href=\"javascript:llista_enable('lin')\" onclick=\"javascript:llista_enable('lin')\"> GNU/Linux</a>";
		spanmac.innerHTML = " Mac";
                spanmob.innerHTML = "<a href=\"javascript:llista_enable('mob')\" onclick=\"javascript:llista_enable('mob')\"> Mòbil/tauleta</a>";
	}

        if (cas =="win") {

                /**IE**/
		llistawin1.style.cssText="display:block;";
		llistawin2.style.cssText="display:block;";
		llistamac1.style.cssText="display:none;";
		llistamac2.style.cssText="display:none;";
		llistalin1.style.cssText="display:none;";
		llistalin2.style.cssText="display:none;";
		llistamob1.style.cssText="display:none;";
	        llistamob2.style.cssText="display:none;";
	        
		/**Std**/
		llistawin1.setAttribute("style", "display:block;");	
		llistawin2.setAttribute("style", "display:block;");
		llistamac1.setAttribute("style", "display:none;");
		llistamac2.setAttribute("style", "display:none;");
		llistalin1.setAttribute("style", "display:none;");
		llistalin2.setAttribute("style", "display:none;");
                llistamob1.setAttribute("style", "display:none;");
                llistamob2.setAttribute("style", "display:none;");
                
                /**IE**/
                icon1win.style.cssText="display:inline;";
                icon2win.style.cssText="display:none;";
                icon1mac.style.cssText="display:none;";
                icon2mac.style.cssText="display:inline;";
                icon1lin.style.cssText="display:none;";
                icon2lin.style.cssText="display:inline;";

                /**Std**/
                icon1win.setAttribute("style", "display:inline;");
                icon2win.setAttribute("style", "display:none;");
                icon1mac.setAttribute("style", "display:none;");
                icon2mac.setAttribute("style", "display:inline;");
                icon1lin.setAttribute("style", "display:none;");
                icon2lin.setAttribute("style", "display:inline;");


		liwin.setAttribute("className", "selected_home");
		liwin.setAttribute("class", "selected_home");
		lilin.setAttribute("className", "");
		lilin.setAttribute("class", "");
		limac.setAttribute("className", "");
		limac.setAttribute("class", "");
		limob.setAttribute("className", "");
		limob.setAttribute("class", "");
		
                spanwin.innerHTML = " Windows";
		spanlin.innerHTML = "<a href=\"javascript:llista_enable('lin')\" onclick=\"javascript:llista_enable('lin')\"> GNU/Linux</a>";
		spanmac.innerHTML = "<a href=\"javascript:llista_enable('mac')\" onclick=\"javascript:llista_enable('mac')\"> Mac</a>";
		spanmob.innerHTML = "<a href=\"javascript:llista_enable('mob')\" onclick=\"javascript:llista_enable('mob')\"> Mòbil/tauleta</a>";
	}
	
	if (cas == "mob") {

		/**IE**/
		llistawin1.style.cssText="display:none;";
	        llistawin2.style.cssText="display:none;";
        	llistamac1.style.cssText="display:none;";
	        llistamac2.style.cssText="display:none;";
		llistalin1.style.cssText="display:none;";
	        llistalin2.style.cssText="display:none;";
		llistamob1.style.cssText="display:block;";
	        llistamob2.style.cssText="display:block;";
	        
		/**Std**/
		llistawin1.setAttribute("style", "display:none;");
                llistawin2.setAttribute("style", "display:none;");
                llistamac1.setAttribute("style", "display:none;");
                llistamac2.setAttribute("style", "display:none;");
                llistalin1.setAttribute("style", "display:none;");
                llistalin2.setAttribute("style", "display:none;");
                llistamob1.setAttribute("style", "display:block;");
                llistamob2.setAttribute("style", "display:block;");
                
                /**IE**/
                icon1win.style.cssText="display:none;";
                icon2win.style.cssText="display:inline;";
                icon1mac.style.cssText="display:none;";
                icon2mac.style.cssText="display:inline;";
                icon1lin.style.cssText="display:inline;";
                icon2lin.style.cssText="display:none;";

                /**Std**/
                icon1win.setAttribute("style", "display:none;");
                icon2win.setAttribute("style", "display:inline;");
                icon1mac.setAttribute("style", "display:none;");
                icon2mac.setAttribute("style", "display:inline;");
                icon1lin.setAttribute("style", "display:none;");
                icon2lin.setAttribute("style", "display:inline;");



                liwin.setAttribute("className", "");
		liwin.setAttribute("class", "");
		lilin.setAttribute("className", "");
		lilin.setAttribute("class", "");
                limac.setAttribute("className", "");
		limac.setAttribute("class", "");
		limob.setAttribute("className", "selected_home");
		limob.setAttribute("class", "selected_home");
		
		spanwin.innerHTML = "<a href=\"javascript:llista_enable('win')\" onclick=\"javascript:llista_enable('win')\"> Windows</a>";
                spanlin.innerHTML = "<a href=\"javascript:llista_enable('lin')\" onclick=\"javascript:llista_enable('lin')\"> GNU/Linux</a>";
                spanmac.innerHTML = "<a href=\"javascript:llista_enable('mac')\" onclick=\"javascript:llista_enable('mac')\"> Mac</a>";
                spanmob.innerHTML = " Mòbil/tauleta";
                
	}
	
	
}


