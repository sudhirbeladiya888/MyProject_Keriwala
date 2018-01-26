/* ADD FUNCTION FOR CALL SERVICES */
function doServiceCall(obj, callback) {
	var data = {};
	for (var key in obj) {
		if (obj.hasOwnProperty(key)) {
			if (typeof (obj[key]) != "string") {
				data[key] = obj[key]
			}
			else {
				data[key] = obj[key].replace(/\'/g, '&apos;').replace(/'/g, "&apos;");
			}
		}
	}
	var headers = { "cache-control": "no-cache", "Access-Control-Allow-Origin": "*" };
	$.ajax({
		type: "POST",
		url:  WEB_SERVICE_PATH + 'service.php',//'http://192.168.0.145/dental-notes-web/web_services/service.php', //WEB_SERVICE_PATH + 
		headers: headers,
		// processData : false,
		data: data,
		async: true,
		crossDomain: true,
		// ERROR FOR POSTING: contentType: "application/json; charset=utf-8",
		dataType: 'json',
		success: function (response) {
			response = response || {};
			responseString = JSON.stringify(response).replace(/\'/g, '&apos;').replace(/&apos;/g, "'");
			response = JSON.parse(responseString);
			// keep old args of caller function and append response at last args
			//[].push.call(arguments, response);
			callback(response);
			//callback.apply(this, arguments);
			
		},
		failure: function (response) {
			hideLoading();
			showMessage("System failure: " + JSON.stringify(response));
		}
	});
}


/* Display Rating star */
	function displayRatings(count,callback) {
		var star = '';
		for (var i=1; i <= count; i++) { 
		star += '<i class="fa fa-star"></i>';
		}
		if(i-count < 1)
		{
		star += '<i class="fa fa-star-half" ></i>';
		}

		if (star != '') {
		return star;
		}

		return '';
	}
/* End display */

function showMessage(msg,title){
	title = (typeof (title) == 'undefined') ? "Alert" : title;
	new PNotify({
		title: title,
		text: msg,
		type: 'success'
	});
	//$.notify(msg, 'success');
}

function showAlert(msg,title){
	title = (typeof (title) == 'undefined') ? "Alert" : title;
	new PNotify({
		title: title,
		text: msg,
		type: 'info'
	});
	//$.notify(msg, 'info');
}

function showError(msg,title){
	title = (typeof (title) == 'undefined') ? "Alert" : title;
	new PNotify({
		title: title,
		text: msg,
		type: 'error'
	});
	//$.notify(msg, 'danger');
	
}