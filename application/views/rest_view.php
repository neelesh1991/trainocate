<html>
<head>
<title>Check Your Api Request</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>

<h1>---------------API Request---------------------</h1>


 
<br/>
 <button id="sendRequest">Send Request</button>
 <br />

<span id="myspan"></span>
<input type="hidden" id="base_url" value="http://quiz.emmersivedemos.in/"/>
<script type="text/javascript">
   $(document).ready(function()
	{
	   var base_url = $('#base_url').val();
	    $('#sendRequest').click(function()
	     {
	        	        

	         	$.ajax({
	             type: "POST",
	             data: {
	
	"userId": "333"

     
	
},
	             url: base_url+"api/api/getUserById",
	             success: function(data)
				{
				    alert(data);
	             }
	          });
	      });
    });

</script>
</body>
</html>