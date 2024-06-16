<?php $view->component('start') ?>
<?php $view->component('header') ?>

<?php $movieId = $movies['id']; $date = $movies['created_at']; $getDate = new DateTime($date);?>
<div class="container">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $storage->url($movies['preview']) ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <span class="badge text-bg-warning"><?php echo $rating ?></span>
                    <input type="hidden" name="movie_id" value="<?php echo $movieId ?>">
                    <h5 class="card-title"><?php echo $movies['name'] ?></h5>
                    <p class="card-text"><?php echo $movies['description'] ?></p>
                    <p class="card-text"><small class="text-muted">Upload: <?php echo $getDate->format('Y-m-d') ?></small></p>
                    <form action="/movie" method="post">
                    <input type="hidden" name="movies_id" value="<?php echo $movieId ?>">

                        <select class="form-select" name="rating" aria-label="Default select example">
                            <option >Rating</option>
                            <?php for ($i = 1; $i < 6; $i++) { ?>
                                <option  value="<?php echo $i ?>"><?php echo $i ?></option>

                            <?php } ?>

                        </select>

                        <button type="submit" class="btn btn-primary mt-2" >Saqlash</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<?php $view->component('end') ?>