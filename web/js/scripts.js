document.getElementById('file-upload-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/file/upload', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 422) {
                let errors = JSON.stringify(data.message);
                alert(errors);
            } else {
                alert(data.message);

                if (data.status === 200 && data.model) {
                    document.getElementById('file-info').innerHTML = 'Информация о файле: ' + JSON.stringify(data.model);
                }
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при загрузке файла.');
        });
});