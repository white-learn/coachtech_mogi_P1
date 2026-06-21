document.querySelectorAll('.src-upload-btn').forEach(input => {

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        const imageArea = this.closest('.image-upload-area');

        const preview = imageArea.querySelector('.src-after-upload');

        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';

        imageArea.querySelector('.area-after-upload').style.display = 'none';

    });

});