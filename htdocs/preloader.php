<!DOCTYPE html> 
<html> 

<head> 
    <title>Welcome to GeeksforGeeks</title> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"> 
    </script> 

    <style> 
        body { 
            margin: 0; 
            padding: 0; 
            font-family: Arial, sans-serif; 
            background-color: #f7f7f7; 
            color: #333; 
        } 

        nav { 
            background-color: #333; 
            color: white; 
            padding: 10px 0; 
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1); 
            border-radius: 10px; 
        } 

        nav ul { 
            list-style: none; 
            margin: 0; 
            padding: 0; 
            display: flex; 
            justify-content: center; 
        } 

        nav ul li { 
            margin-right: 20px; 
        } 

        nav ul li:last-child { 
            margin-right: 0; 
        } 

        nav ul li a { 
            text-decoration: none; 
            color: white; 
            transition: color 0.3s ease-in-out; 
            font-size: 22px; 
        } 

        nav ul li a:hover { 
            color: #3498db; 
        } 

        .loading-overlay { 
            position: fixed; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(255, 255, 255, 0.8); 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            z-index: 9999; 
        } 

        .loading-text { 
            font-size: 18px; 
            margin-top: 10px; 
            color: #333; 
        } 

        .loading-spinner { 
            border: 4px solid #f3f3f3; 
            border-top: 4px solid #3498db; 
            border-radius: 50%; 
            width: 40px; 
            height: 40px; 
            animation: spin 1s linear infinite; 
        } 

        @keyframes spin { 
            0% { 
                transform: rotate(0deg); 
            } 

            100% { 
                transform: rotate(360deg); 
            } 
        } 

        .content { 
            display: none; 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 30px; 
            background-color: white; 
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1); 
            border-radius: 5px; 
        } 

        img { 
            max-width: 100%; 
            height: auto; 
            display: block; 
            margin: 20px auto; 
        } 

        h1 { 
            color: #333; 
            text-align: center; 
            margin-bottom: 30px; 
        } 

        h2 { 
            color: #333; 
            margin-top: 20px; 
        } 

        p { 
            color: #666; 
            line-height: 1.6; 
        } 
    </style> 
</head> 

<body> 
    <div class="loading-overlay"> 
        <div class="loading-spinner"> 

        </div> 
        <div class="loading-text"> 
            Upload image
        </div> 
    </div> 
    <div class="content"> 
        <h1 style="color: green;"> 
            Welcome to GeeksforGeeks 
        </h1> 
    </div> 

    <script> 
        $(document).ready(function () { 
            setTimeout(function () {
                $(".loading-text").text("Checking appropriate contents"); 
            }, 2000);

            setTimeout(function () {
                $(".loading-text").text("Done ....."); 
                $(".content").fadeIn(1000); 
                $(".loading-overlay").fadeOut(1000); 
            }, 4000); 
        }); 
    </script> 
</body> 

</html>
