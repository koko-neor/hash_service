<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh; background-color: #f5f5f5;">
        <div class="col-md-4">
            <div class="upload-container card">
                <div class="card-body">
                    <h3 class="card-title">Загрузите ваш файл</h3>
                    <form id="file-upload-form" enctype="multipart/form-data" method="post" action="/file/upload">
                        <!-- Добавление CSRF токена -->
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <div class="form-group">
                            <input type="file" name="FileUploadForm[file]" class="form-control-file" required>
                            <small class="form-text text-muted">Разрешенные форматы: .txt, .docx</small>
                        </div>
                        <div class="form-group">
                            <input type="text" name="FileUploadForm[name]" class="form-control" placeholder="Название" required>
                        </div>
                        <div class="form-group">
                            <textarea name="FileUploadForm[description]" class="form-control" placeholder="Описание" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                    </form>
                    <div id="file-info"></div>
                </div>
            </div>
        </div>
    </div>
</div>