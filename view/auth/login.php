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

    <div class="form-floating mt-2">
      <input name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
      <?php if ($session->has('email')) { ?>
        <ul>

          <?php foreach ($session->getFlash('email') as $error) { ?>
            <li class="text-danger small"><?php echo $error; ?></li> <?php } ?>
        <?php } ?>
        </ul>

    </div>

    <div class="form-floating mt-2">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <label>Password</label>
      <?php if ($session->has('password')) { ?>
        <ul>

          <?php foreach ($session->getFlash('password') as $error) { ?>
            <li class="text-danger small"><?php echo $error; ?></li> <?php } ?>
        <?php } ?>
        </ul>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>


</main>


<?php $view->component('end') ?>