<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\style.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42596e542d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    <title><?= $titre ?></title>
</head>
<div id="wrapper">
    <body>
        <header>
            <nav>
                <a href="index.php?action=listCategorie">Accueil catégorie</a>
            </nav>
        </header>
        <main>
            <div id="contenu">
                <h1>Forum du désespoir !</h1>
                <h2> <?= $titreSecondaire ?></h2>
               <div id="contenuDetail"> <?= $contenu ?> </div>
            </div>
        </main>
       
</div>
</body>
</html>