const inputFile = document.querySelector('#Capa');
const imgArea = document.querySelector('.img-area');

imgArea.addEventListener('click', function () {
    inputFile.click();
});

inputFile.addEventListener('change', function () {
    const image = this.files[0];
    if (image.size < 20000000) { // 20MB em bytes
        const reader = new FileReader();
        reader.onload = () => {
            const allImg = imgArea.querySelectorAll('img');
            allImg.forEach(item => item.remove());
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imgArea.appendChild(img);
            imgArea.classList.add('active');
            imgArea.dataset.img = image.name;
        };
        reader.readAsDataURL(image);
    } else {
        alert("A imagem é maior que 20MB");
    }
});