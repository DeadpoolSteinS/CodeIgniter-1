<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="text-center my-4">Form Comic</h2>
    <form action="/comics/saveUpdate/<?= $comic['id']; ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
        <input type="hidden" name="oldImage" value="<?= $comic['image']; ?>">
        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?= (old('title')) ? old('title') : $comic['title']; ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" name="author" value="<?= (old('author')) ? old('author') : $comic['author']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="publisher" name="publisher" value="<?= (old('publisher')) ? old('publisher') : $comic['publisher']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-8">
                <input class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>" type="file" id="image" name="image" onchange="previewImg()">
                <div class="invalid-feedback">
                    <?= $validation->getError('image'); ?>
                </div>
            </div>
            <!-- preview image upload -->
            <div class="col-sm-2">
                <img src="/img/<?= $comic['image']; ?>" alt="default-image" class="img-thumbnail img-preview">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
<?= $this->endSection(); ?>