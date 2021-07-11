<?php 
require 'config/config.php';

require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School4All</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="shortcut icon" type="image/png" href="assets/images/background/graduation.png">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>

<body>

    <?php 

    if (isset($_POST['register_button'])) {
        echo '
             <script>
               $(document).ready(function(){
                 $("#first").show();
                 $("#second").hide();
               });
             </script>
        	';
    }
    ?>

    <div class="wrapper">
        <div class="landing">
            <h1 class="brand">classRoom</h1>
            <div class="landing__bg"></div>
            <div class="content">
                <h1>Rejoindre votre salle de classe</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae blanditiis atque perferendis suscipit,
                    quae quibusdam consequuntur magni voluptatibus quidem rerum?</p>
                <span id="landing-btn">Login/SignUp</span>
            </div>
        </div>
        <div class="login_box">
            <div class="login_header">
                <h1>School For All</h1>
                Connexion ou inscription
            </div>

            <div id="first">
                <form action="register.php" method="POST" id="login-form">
                    <input type="email" name="log_email" placeholder="Email address" value="<?php 
                                                                                            if (isset($_SESSION['log_email'])) {
                                                                                                echo $_SESSION['log_email'];
                                                                                            }
                                                                                            ?>" required>
                    <br>

                    <input type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect<br>", $error_array)) echo "<span style='color:red; font-size:0.78rem;'>Email or password was incorrect<br><br></span>"; ?>

                    <input type="submit" name="login_button" id="button" value="Se connecter">
                    <br>
                    <a href="#" id="signup" class="signup">Besoin d'un compte ? Enregistrez vous!</a>

                </form>

            </div>


            <div id="second">
                <form action="register.php" method="POST" id="register-form">
                    <input type="text" name="reg_fname" placeholder="First name" value="<?php 
                                                                                        if (isset($_SESSION['reg_fname'])) {
                                                                                            echo $_SESSION['reg_fname'];
                                                                                        } ?>" required>

                    <br>

                    <?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; ?>

                    <input type="text" name="reg_lname" placeholder="Last name" value="<?php 
                                                                                        if (isset($_SESSION['reg_lname'])) {
                                                                                            echo $_SESSION['reg_lname'];
                                                                                        } ?>" required>
                    <br>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php 
                                                                                    if (isset($_SESSION['reg_email'])) {
                                                                                        echo $_SESSION['reg_email'];
                                                                                    } ?>" required>
                    <br>

                    <input type="email" name="reg_email2" placeholder="Confirm email" value="<?php 
                                                                                                if (isset($_SESSION['reg_email2'])) {
                                                                                                    echo $_SESSION['reg_email2'];
                                                                                                } ?>" required>
                    <br>

                    <?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
                    else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
                    else if (in_array("Email do not match<br>", $error_array)) echo "Email do not match<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm password" required>
                    <br>

                    <?php if (in_array("Your password do not match<br>", $error_array)) echo "Your password do not match<br>"; ?>

                    <input type="submit" name="register_button" id="button" value="Register">
                    <br>
                    <br>
                    <?php if (in_array("<span style = 'color: #14C800;'> You're all set! Go ahead and login! </span> <br>", $error_array)) echo "<span style = 'color: #14C800;'> You're all set! Go ahead and login! </span> <br>"; ?>


                    <a href="#" id="signin" class="signin">Already have an account? Sign in!</a>

                </form>
            </div>

        </div>
    </div>
    <script>
        const landingPage = document.querySelector('.landing');
        const landingBtn = document.querySelector('#landing-btn');
        landingBtn.addEventListener('click', () => {
            landingPage.classList.add('animated', 'slideOutUp');
        });

        $(document).ready(function() {
   
        //on click signup, hide login and show registration form
        $("#signup").click(function()  {
            $("#first").slideUp("slow", function(){
                $("#second").slideDown("slow");
                });
            });
            //on click signup, hide registertion form and login form
                $("#signin").click(function() {
                    $("#second").slideUp("slow", function(){
                        $("#first").slideDown("slow");
                });
            });

        });

        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
        var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList
        var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent

        var colors = [ 'aqua' , 'azure' , 'beige', 'bisque', 'black', 'blue', 'brown', 'chocolate', 'coral', 'crimson', 'cyan', 'fuchsia', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'indigo', 'ivory', 'khaki', 'lavender', 'lime', 'linen', 'magenta', 'maroon', 'moccasin', 'navy', 'olive', 'orange', 'orchid', 'peru', 'pink', 'plum', 'purple', 'red', 'salmon', 'sienna', 'silver', 'snow', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'white', 'yellow'];
        var grammar = '#JSGF V1.0; grammar colors; public <color> = ' + colors.join(' | ') + ' ;'

        var recognition = new SpeechRecognition();
        var speechRecognitionList = new SpeechGrammarList();
        speechRecognitionList.addFromString(grammar, 1);
        recognition.grammars = speechRecognitionList;
        recognition.continuous = false;
        recognition.lang = 'fr-FR';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        var diagnostic = document.querySelector('.output');
        var bg = document.querySelector('html');
        var hints = document.querySelector('.hints');

        var colorHTML= '';
        colors.forEach(function(v, i, a){
        console.log(v, i);
        colorHTML += '<span style="background-color:' + v + ';"> ' + v + ' </span>';
        });
        hints.innerHTML = 'Tap/click then say a color to change the background color of the app. Try ' + colorHTML + '.';

        document.body.onclick = function() {
        recognition.start();
        console.log('Ready to receive a color command.');
        }

        recognition.onresult = function(event) {
        // The SpeechRecognitionEvent results property returns a SpeechRecognitionResultList object
        // The SpeechRecognitionResultList object contains SpeechRecognitionResult objects.
        // It has a getter so it can be accessed like an array
        // The first [0] returns the SpeechRecognitionResult at the last position.
        // Each SpeechRecognitionResult object contains SpeechRecognitionAlternative objects that contain individual results.
        // These also have getters so they can be accessed like arrays.
        // The second [0] returns the SpeechRecognitionAlternative at position 0.
        // We then return the transcript property of the SpeechRecognitionAlternative object
        var color = event.results[0][0].transcript;
        diagnostic.textContent = 'Result received: ' + color + '.';
        bg.style.backgroundColor = color;
        console.log('Confidence: ' + event.results[0][0].confidence);
        }

        recognition.onspeechend = function() {
        recognition.stop();
        }

        recognition.onnomatch = function(event) {
        //diagnostic.textContent = "I didn't recognise that color.";
        }

        recognition.onerror = function(event) {
        //diagnostic.textContent = 'Error occurred in recognition: ' + event.error;
        }

 
    </script>
</body>

</html> 