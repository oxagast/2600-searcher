<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
 
	/* Set text color to green */
	body {
	    color: green;
	}

	/* Remove underline from links */
	a {
	    text-decoration: none;
	    color:green;
	}

	/* Set a black background */
	body {
	    background-color: black;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }


    .no-spacing {
        line-height: 0.63; /* Set line height to 1 to remove spacing */
        margin: 0; /* Remove margins */
        padding: 0; /* Remove padding */
	font-size: 1.15vw;
    }

@media (max-width: 900px) {
  .no-spacing {
    font-size: 2.4vw; /* Adjust the font size for smaller screens */
  }

}
/* Styles for the loading animation */
        .loading-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            pointer-events: none; /* Allow interaction with underlying elements */
        }

        .loading-spinner {
            border: 8px solid green;
            border-top: 8px solid #077929;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Hide loading animation when everything is loaded */
        body.loaded .loading-container {
            display: none;
        }
</style>
</head>
<body class="no-spacing">
    <div class="loading-container">
        <div class="loading-spinner"></div>
    </div>
<div class="content">
<center><br>
    <form method="POST" action="search.php">
        <label for="userInput" style = "font-size:4vw;">2600 Search </label><br><br><br><br>
        <input type="text" name="userInput" id="userInput" size="40">
        <input type="submit" value="Submit"  style="height:25px; width:75px">
    </form>
<br>
<a href="https://www.2600.com">www.2600.com</a><br><br>
Copyright  © 2600 Enterprises, Inc. All rights reserved.<br><br>
<br>
</center>
<br>
<?php
ob_implicit_flush(true);
ob_end_flush();

function isValidString($input) {
    // Define your validation criteria here
    // For example, you can check for allowed characters or a maximum length.
    
    // For this example, we're allowing only letters, numbers, and spaces.
    // You can modify this regex pattern to match your specific requirements.
    $pattern = '/^[a-zA-Z0-9\s]+$/';

    // Check if the input matches the pattern
    return preg_match($pattern, $input) === 1;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$userInput = $_POST["userInput"];
		if (!empty($userInput)) {
			if (isValidString($userInput)) {
			$cmd = '/var/www/html/diskdash.com/public_html/2600/search.sh ' . escapeshellarg($userInput);
			while (@ ob_end_flush()); // end all output buffers if any

			$proc = popen($cmd, 'r');
			echo '<pre>';
			$outputFound = false; 
			while (!feof($proc))
			{			    
			    $fix = fread($proc, 4096);
			    if(!empty($fix)){
				$length = strlen($fix);
				if($length > 3){
				$outputFound = true;
				$newString = str_replace("_2600-", "_2600   ", $fix);
				$newString2 = str_replace("_2600:", "_2600 * ", $newString);
			    	echo nl2br(htmlspecialchars($newString2)); // Escape HTML entities
		   	 	@ flush();
				}
			}
}
			echo '</pre>';

			if(!$outputFound){
			  echo '<center><pre>Nothing found.</pre></center>';
  			  }
			}
		else{
			    // Handle the case where $userInput is not a string
    			    echo '<center><pre>Search is not a valid string.</pre></center>';
			}
		}
}
?>
</div>
    <script>
        // Display the loading animation while additional resources load
        const loadingContainer = document.querySelector('.loading-container');
        loadingContainer.style.display = 'block'; // Show loading animation

        // Hide the loading animation when everything is loaded
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
            loadingContainer.style.display = 'none'; // Hide loading animation
        });
    </script>
</body>
</html>
