<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <table class="table table-striped">
        <h1 class="text-center">Comic List</h1>
        <a href="/comics/create" class="btn btn-primary">Add Comic</a>
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success mt-2" role="alert">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($comics as $comic) : ?>
                <tr class="align-middle">
                    <th scope="row"><?= $i++; ?></th>
                    <td><img src="/img/<?= $comic['image']; ?>" alt="<?= $comic['slug']; ?>" width="64"></td>
                    <td><?= $comic['title']; ?></td>
                    <td>
                        <a href="/comics/<?= $comic['slug']; ?>" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>