$(document).on("change", "#upload_files", async function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    // FileReader support
    if (FileReader && files && files.length) {
        for (let x = 0; x < this.files.length; x++) {
            var fr = new FileReader();
            fr.onload = function (e) {
                var ulLog = document.getElementById('F9-Log'); // Seleciona a ul onde as imagens serão inseridas
                // Criar li para as imagens originais e corrigidas com colunas de 4 itens (s3)
                var imageColumn = document.createElement('li');
                imageColumn.classList.add('col', 's3'); // Define que será exibido em 4 colunas (s3)
                // Label para a imagem original
                var originalLabel = document.createElement('label');
                originalLabel.textContent = 'Original';
                // Imagem original
                var originalImg = document.createElement('img');
                originalImg.src = e.currentTarget.result;
                originalImg.style.width = "100%";
                originalImg.style.height = "auto";
                // Label para a imagem corrigida
                var croppedLabel = document.createElement('label');
                croppedLabel.textContent = 'Corrigida';
                // Imagem recortada
                var croppedImg = document.createElement('img');
                croppedImg.style.width = "100%";
                croppedImg.style.height = "auto";
                // Adiciona os elementos ao contêiner de coluna
                imageColumn.append(originalLabel);
                imageColumn.append(originalImg);
                imageColumn.append(croppedLabel);
                imageColumn.append(croppedImg);
                // Adiciona o conjunto de imagens ao F9-Log (ul)
                ulLog.append(imageColumn);
                // Ao clicar na imagem original, abre o SweetAlert2 para cropper
                originalImg.addEventListener("click", function () {
                    Swal.fire({
                        title: 'Crop your image',
                        html: '<div id="crop-container" style="max-width:100%;">' +
                            '<img id="image-to-crop" src="' + e.currentTarget.result + '" style="max-width:100%;" />' +
                            '</div>',
                        didOpen: () => {
                            // Inicializar o Cropper.js na imagem dentro do SweetAlert2
                            var imageElement = document.getElementById('image-to-crop');
                            var cropper = new Cropper(imageElement, {
                                aspectRatio: 16 / 9,
                                viewMode: 1,
                                autoCropArea: 1,
                                movable: false,
                                cropBoxResizable: true,
                            });
                            // Quando o usuário clicar em "Crop", atualizar a imagem corrigida
                            Swal.getConfirmButton().addEventListener('click', function () {
                                var croppedCanvas = cropper.getCroppedCanvas();
                                var croppedImageURL = croppedCanvas.toDataURL('image/jpeg');
                                // Atualizar a imagem corrigida no DOM
                                croppedImg.src = croppedImageURL;
                            });
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Corrigir',
                    });
                });
            };
            fr.readAsDataURL(files[x]);
        }
    }
});