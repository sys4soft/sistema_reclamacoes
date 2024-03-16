<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col">

            <?= form_open_multipart('/submit', ['novalidate' => true]) ?>
            
                <div class="row mb-3">
                    <div class="col">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= old('email') ?>">
                        <?= show_validation_error('email', $validation_errors) ?>
                    </div>
    
                    <div class="col">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="area" class="form-label">Área de reclamação *</label>
                        <select class="form-select" id="area" name="area" required>
                            <option value="1">Área 1</option>
                            <option value="2">Área 2</option>
                            <option value="3">Área 3</option>
                        </select>
                        <?= show_validation_error('area', $validation_errors) ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="complaint" class="form-label">Área de texto para a reclamação *</label>
                    <textarea class="form-control" id="complaint" name="complaint" rows="6" required><?= old('complaint') ?></textarea>
                    <?= show_validation_error('complaint', $validation_errors) ?>
                </div>

                <div class="mb-3">
                    <label for="files" class="form-label">Upload de ficheiros</label>
                    <div class="d-flex flex-row justify-content-between gap-3">
                        <div>
                            <input class="form-control" type="file" id="file1" name="file1">
                            <?= show_validation_error('file1', $validation_errors) ?>
                        </div>
                        <div>
                            <input class="form-control" type="file" id="file2" name="file2">
                            <?= show_validation_error('file2', $validation_errors) ?>
                        </div>
                        <div>
                            <input class="form-control" type="file" id="file3" name="file3">
                            <?= show_validation_error('file3', $validation_errors) ?>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>

            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>