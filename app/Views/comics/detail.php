<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="card mb-3" style="max-width: 400px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/img/<?= $comic['image']; ?>" class="img-fluid rounded-start" width="100" alt="<?= $comic['title']; ?>">
            </div>
            <div class="col-md-8">
                <div class="p-2">
                    <h5 class="card-title"><?= $comic['title']; ?></h5>
                    <p class="card-text" style="margin-bottom: 0;">Author : <?= $comic['author']; ?></p>
                    <p class="card-text" style="margin-bottom: 10px;">Publisher : <?= $comic['publisher']; ?></p>

                    <a href="/comics/update/<?= $comic['slug']; ?>" class="btn btn-warning">Update</a>
                    <form action="/comics/<?= $comic['id']; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>