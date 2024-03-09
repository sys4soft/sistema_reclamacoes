<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col">

            <?= form_open_multipart('/submit') ?>
            
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-3">
                    <label for="area" class="form-label">Área de reclamação *</label>
                    <select class="form-select" id="area" name="area" required>
                        <option value="1">Área 1</option>
                        <option value="2">Área 2</option>
                        <option value="3">Área 3</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="complaint" class="form-label">Área de texto para a reclamação *</label>
                    <textarea class="form-control" id="complaint" name="complaint" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="files" class="form-label">Upload de ficheiros</label>
                    <div class="d-flex flex-row justify-content-between gap-3">
                        <input class="form-control" type="file" id="files1" name="files[]">
                        <input class="form-control" type="file" id="files2" name="files[]">
                        <input class="form-control" type="file" id="files3" name="files[]">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>

            <?= form_close() ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
<!-- 
- Email * (obrigatório)
- Nome (facultativo)
- Selecionar a área de reclamação * (obrigatório) - select de html com opções
- Área de texto para a reclamação * (obrigatório)
- Upload de ficheiros (max 3) (facultativo)
- Enviar (botão)
 -->