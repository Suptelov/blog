<html>
    <head>
        <title>Social entry form</title>    
             <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">

    </head>
    
    <body >
    <?php
    require_once ("../views/header.php");
    ?>
    <div id="content">
     
    <h1>Entry in our social club</h1>
    <p>Please, fill the form and we call you</p>

        <form action="create_user.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="first-name">Name:</label>
                <input type="text" name="first-name" size=20/> <br/>
                
                <label for="last-name">Last Name:</label>
                <input type="text" name="last-name" size=20/> <br/>
                
                <label for="email">Email:</label>
                <input type="text" name="email" size=20/> <br/>

                <label for="password">Password:</label>
                <input type="password" name="password" size=40/> <br/>
                
                <label for="facebook-url">URL in Facebook:</label>
                <input type="text" name="facebook-url" size=30/> <br/>
                
                <label for="twitter-handle">Your Twitter ID:</label>
                <input type="text" name="twitter-handle" size=30/> <br/>  
                
             
                   
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                <label for="user_pic">Send pic:</label>
                <input type="file" name="user_pic" size="30" />              

                <p class="file-label">
                    <label  for="bio">Bio</label>
                    <textarea name="bio" cols="50" rows="10"></textarea>
                </p>
                
            </fieldset>
            <br/>
            <fieldset class="center">
                <input type="submit" value="Join the club"/>
                <input type="reset" value="Reset form"/>

            </fieldset>
            
            
        </form>
    
    </div>
    
    </body>



</html>