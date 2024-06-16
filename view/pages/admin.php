<?php $view->component('start') ?>
<?php $view->component('header') ?>

<main>
    <div class="container">
        <h3 class="mt-3">Admin Page</h3>
        <hr>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>Movies</h4>
            <a href="/admin/movies/create" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
                <span>Add Movies</span>
            </a>
        </div>
        <table class="table table-dark table-hover">
            <thead>
                <?php foreach ($movies as $movie) { ?>

                    <th scope="col">
                        <img width="50" src="<?php echo $storage->url($movie->preview()) ?>" />
                    </th>
                    <th scope="col"><?php echo $movie->name() ?></th>

                    <th scope="col"><?php echo $movie->description() ?></th>
                    <td>
                        <form action="/admin/movies/delete" method="post">
                            <input type="hidden" name="id" value="<?php echo $movie->id(); ?>" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="/admin/movies/update?id=<?php echo $movie->id(); ?>" class="btn btn-warning">Update</a>
                    </td>
                    </tr>

                <?php } ?>


            </thead>
            <tbody>


            </tbody>
        </table>

        <hr>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>Categories</h4>
            <a href="/admin/categories/create" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
                <span>Add Categories</span>
            </a>
        </div>
        <table class="table table-dark table-hover">
            <thead>
                <?php foreach ($categories as $category) { ?>

                    <tr>
                        <th scope="col"> <?php echo $category->name(); ?>
                        </th>
                        <td>
                            <form action="/admin/categories/delete" method="post">
                                <input type="hidden" name="id" value="<?php echo $category->id(); ?>" />
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        <td>
                            <a href="/admin/categories/update?id=<?php echo $category->id(); ?>" class="btn btn-warning">Update</a>
                        </td>
                    </tr>
                <?php } ?>

            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</main>
<?php $view->component('end') ?>