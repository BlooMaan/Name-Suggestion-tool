<html>
	<head>
		<meta charset="utf-8" />
		<title>Example</title>
		<style>
			* {
				padding:0; margin:0;
			}
			body {
				text-align:center;
				padding:25px;
				font-size:Arial, Helvetica;
				background-color:#f9fbfd;
				line-height:1.5em;
			}
			input {
				padding:4px;
				border-radius:3px;
				border:1px solid rgba(0,0,0,.2);
			}
			/* if the list is empty */
			.js-wrapper_results.js-class-empty {
			  display:none;
			}
			.js-model-name {
			  display:inline-block;
			  margin-right:3px;
			  margin-left:3px;
			}
			.js-wrapper_results {
			  padding:4px;
			  padding-top:15px;
			}
			.name-line {
				display:block;
			}
		</style>
	</head>
	<body>
 		
		<input placeholder="First name" autocomplete="off" type="text" class="js-autocomplete_input" />
		<input placeholder="Last name" autocomplete="off" type="text" class="js-last_name" />
		
		<div class="js-wrapper_results">
			<u>Did you mean:</u>
			<span class="js-results">
				<span class="js-model-name name-line"></span>
			</span>
		</div>
		
		<script src="script.js"></script>
	</body>
</html>