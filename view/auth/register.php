<?php $view->component('start') ?>

<style>
  html,
  body {
    height: 100%;
  }

  body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
  }

  .form-signin {
    max-width: 330px;
    padding: 15px;
  }

  .form-signin .form-floating:focus-within {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>

<main class="form-signin w-100 m-auto text-center">
  <form action="/register" method="post">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <?php if ($session->has('email')) { ?>
        <?php foreach ($session->getFlash('email') as $error) { ?>
          <span class="text-danger"><?php echo $error ?></span> <?php } ?>

      <?php } ?>
      <label for="floatingInput">Email address</label>
      <!-- <div class="text-danger">
        Please choose a username.
      </div> -->
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
      <?php if ($session->has('password')) { ?>
        <?php foreach ($session->getFlash('password') as $error) { ?>
          <span class="text-danger"><?php echo $error ?></span>
        <?php } ?>

      <?php } ?>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>


</main>


<?php $view->component('end') ?>