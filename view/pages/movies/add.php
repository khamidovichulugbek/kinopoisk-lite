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
    <form action="/admin/movies/create" method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">Create Movies</h1>
        <div class="form-floating">
            <input name="name" class="form-control" id="floatingInput" placeholder="name">
            <label for="floatingInput">Name</label>
            <?php if ($session->has('name')) { ?>
                <ul>
                    <?php foreach ($session->getFlash('name') as $error) { ?>
                        <li class="text-danger small"><?php echo $error; ?></li> <?php } ?>

                <?php } ?>
                </ul>

        </div>
        <div class="form-floating mt-2">
            <textarea name="description" class="form-control" placeholder="name"></textarea>
            <label for="floatingInput">Description</label>
            <?php if ($session->has('description')) { ?>
                <ul>
                    <?php foreach ($session->getFlash('description') as $error) { ?>
                        <li class="text-danger small"><?php echo $error; ?></li> <?php } ?>

                <?php } ?>
                </ul>

        </div>
        <div class="form-floating mt-2">
            <select class="form-select" name="categoryId" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category->id() ?>"><?php echo $category->name() ?></option>
                <?php } ?>

            </select>
            <?php if ($session->has('categoryId')) { ?>
                <ul>
                    <?php foreach ($session->getFlash('categoryId') as $error) { ?>
                        <li class="text-danger small"><?php echo $error; ?></li> <?php } ?>

                <?php } ?>
                </ul>

        </div>
        <div class="form-floating mt-2">
            <input type="file" name="preview" class="form-control" id="inputGroupFile01">
        </div>
        <button class="w-100 mt-2 btn btn-lg btn-primary" type="submit">Create</button>
    </form>


</main>


<?php $view->component('end') ?>