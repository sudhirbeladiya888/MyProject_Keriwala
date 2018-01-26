<!DOCTYPE>
<HTML>
	<HEAD>
		<title>Please wait...</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">

		<script type="text/javascript" src="jquery-1.10.1.min.js"></script>

		<script type="text/javascript">
			
			var _domain = "";
			var _title = "Cubic Web Services";
			var methods = [];

			// --------------------------------------------------------------------------------------- //

			methods.push({
				title : 'login_user'
				, url : 'service.php?op=login_user&username=abc&user_password=123'
				, params : 'username , user_password'
			});

			methods.push({
				title : 'signup_user'
				, url : 'service.php?op=signup_user&user_email=adb@abc.com&username=abc&full_name=abcabc&user_password=123'
				, params : 'user_email , username , full_name , user_password'
			});

			methods.push({
				title : 'login_via_facebook'
				, url : 'service.php?op=login_via_facebook&fb_id=21&username=adc&user_email=abc@fb.com'
				, params : 'fb_id , username , user_email (optional)'
			});

			methods.push({
				title : 'get_products'
				, url : 'service.php?op=get_products'
				, params : 'pass product_id to show product wise ,pass user_id to show product user wise'
			});

			methods.push({
				title : 'get_options'
				, url : 'service.php?op=get_options'
				, params : 'pass option_id to show options'
			});
			methods.push({
				title : 'add_products'
				, url : 'service.php?op=add_products&user_id=1&product_size=100&product_price=150&product_photo=http://192.168.0.145/flora-express-web/web_services/upload/large/59781f04046dc.png&product_description=New Product'
				, params : 'user_id , product_size , product_price ,product_photo (Image URL) ,product_description ,'
			});
			methods.push({
				title : 'add_options'
				, url : 'service.php?op=add_options&option_title=ABC&option_description=ABC desc&option_price=100'
				, params : 'option_title , option_description ,option_price'
			});
			
			methods.push({
				title : 'create_order'
				, url : 'service.php?op=create_order&user_id=1&full_name=ABC&product_list=1,2,3&product_qty_list=1,1,1&product_price_list=100,200,300&option_list=1,2,3&option_qty_list=10,20,30&option_price_list=100,200,300&shipping_address=surat,india&town=Surat&cap=Temp&mesaage=New&delevery_time=12:30 PM&delevery_date=08-03-2017&transaction_id=TR123'
				, params : 'user_id , full_name , product_list (Ex : 1,2,3) , product_qty_list (Ex : 1,1,1), product_price_list (Ex : 100,200,300), ption_list (Ex : 1,2,3) , option_qty_list (Ex : 10,20,30), option_price_list (Ex : 100,200,300), shipping_address , town ,cap ,delevery_time (12:30 PM),delevery_date (08-03-2017),transaction_id '
			});
			
			

			//-----------------------------------------------------------------------------------//

			var tokenPos=window.location.search.indexOf('access_token');
			if(tokenPos>-1)
				token=window.location.search.substr(tokenPos+13,40);
			else
				token="";

			function format(e,t){var n=e||"";var r=n+"";var i=null;try{for(var s in t){i=new RegExp("\\{"+s+"\\}","g");r=r.replace(i,t[s]==null?"":t[s].toString())}}catch(o){}return r}function loadMethods(){var e="",t="<li>{title} - <label>{params}</label><a target='_blank' href='{url}' ><span>Test</span></a>";e+="<ol>";for(var n in methods){e+=format(t,methods[n])}e+="</ol>";e+="<a id='last' href='javascript:;'></a>";document.getElementById("body").innerHTML=e;document.title=_title;document.getElementById("header").innerHTML="<hr /><b>"+_title+"<hr />";document.getElementById("footer").innerHTML="<hr />Copyright &copy; 2015, <a style='color:white !important' href='#'></a>, Surat.<hr />";document.onkeydown=function(e){e=e||window.event;if(e.keyCode==27){_doClose()}}}var popup=document.getElementById("popup");window.onload=function(){window.setTimeout(function(){loadMethods();window.scrollTo(0,document.body.scrollHeight)},10)};
		</script>
	</HEAD>
	
	<BODY>
		<div id="popup"></div><header id="header"></header>
		<div id="body"></div>
		<footer id="footer"></footer>
		<style type="text/css">
			#close {
				background: none repeat scroll 0 0 #FFFFFF; border: 0 none; color: #FF0000; font-size: 25px; font-weight: bold; height: 50px; position: absolute; right: 3px; top: 7px; width: 100px; cursor: pointer;
			}
			#popup {
				background-color: #FFFFFF; border: 1px solid #FCFCFC; bottom: 70px !important; position: absolute; top: 70px; width: 97%; z-index: 1000; display: none; padding-bottom: 20px;
			}
			body {
				font-size: 20px; padding-top: 40px; min-height: 500px;
			}
			div {
				position: absolute; border-width: 0px; overflow: visible; overflow-x: hidden; padding: 15px; padding-bottom: 60px;
			}
			li {
				font-weight: normal;
			}
			li label {
				font-size: 14px; color: gray; padding-left: 15px;
			}
			li span {
				font-size: 11px; font-weight: bold; padding-left: 15px;
			}
			header, footer {
				text-align: center;
				width: 100%;
				margin: 0px auto;
				position: fixed;
				z-index: 1000;
				left: 0px !important;
				border: 1px solid rgb(51, 51, 51);
				background: rgb(17, 17, 17);
				color: rgb(255, 255, 255);
				font-weight: bold;
				text-shadow: 0 -1px 1px rgb(0, 0, 0);
				background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(60, 60, 60) ), to(rgb(17, 17, 17) ) );
				background-image: -webkit-linear-gradient(rgb(60, 60, 60), rgb(17, 17, 17) );
				background-image: -moz-linear-gradient(rgb(60, 60, 60), rgb(17, 17, 17) );
				background-image: -ms-linear-gradient(rgb(60, 60, 60), rgb(17, 17, 17) );
				background-image: -o-linear-gradient(rgb(60, 60, 60), rgb(17, 17, 17) );
				background-image: linear-gradient(rgb(60, 60, 60), rgb(17, 17, 17) );
			}
			header {
				top: 0px !important;
			}
			footer {
				bottom: 0px !important;
			}
			b {
				color: #000;
			}
			header b {
				color: #FFF;
			}
		</style>
	</BODY>
</HTML>