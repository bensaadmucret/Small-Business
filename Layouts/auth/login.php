<?php echo '<h3>' . $title ?? 'Connexion</h3>'; ?>
<?php echo '<h3>' . $message ?? ' Connexion </h3>'; ?>
<?php echo '<div class="alert">'. $error . '</div>' ?? ''; ?>
<div>
  <form method="POST">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email" autofocus>   

    <label for="password">Mot de passe</label>
    <input type="password" id="email" name="password" placeholder="Mot de passe">

    
  
    <input type="submit" value="Submit">
  </form>
</div>