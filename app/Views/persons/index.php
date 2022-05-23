<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h1 class="text-center">Person Indonesia List</h1>
    <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
            <button class="btn btn-primary" type="submit" id="search" name="search">Search</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (($page - 1) * 8);
            foreach ($persons as $person) : ?>
                <tr class="align-middle">
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $person['name']; ?></td>
                    <td><?= $person['address']; ?></td>
                    <td>
                        <a href="" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links('persons', 'bootstrap_pagination'); ?>
</div>
<?= $this->endSection(); ?>