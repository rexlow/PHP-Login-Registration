<?php 
    define('__CONFIG__', true);     // allow the configs
    require_once "inc/config.php";  // require the configs
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <div class="uk-section uk-container uk-text-center">
        <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-1" uk-grid="">
            <form>
                <fieldset class="uk-fieldset">

                    <legend class="uk-legend">Login</legend>

                    <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="john@gmail.com">
                    </div>

                    <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="password">
                    </div>

                    <div class="uk-margin">
                        <a class="uk-button uk-button-default" href="#">Login</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php require_once "inc/footer.php" ?>
</body>

</html>