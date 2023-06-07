<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/css/felicitation.css') }}">
 
    <title>Document</title>
</head>
<body>
    <div class="js-container container_1" ></div>

    <div style="text-align:center;margin-top:30px;position:  absolute;width:100%;top:25%;left:0px;" >
        <div class="checkmark-circle">
          <div class="background"></div>
          <div class="checkmark draw"></div>
        </div>
        <h1>Felicitation !</h1>
        <p>Votre compte a été créer avec succès. Veuillez télécharger l'application afin d'accéder à votre compte.</p>
        <button class="submit-btn" type="submit" onclick="location.href = 'https://beldilook.ma';">Continuer</button>
      </div>
  
    <script src="{{ url('/js/felicitation.js') }}"></script>
</body>
</html>