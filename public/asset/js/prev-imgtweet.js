function previewTweetImage(event) {
    const imagePreview = document.getElementById('tweet-image-preview');
    imagePreview.innerHTML = ''; // Clear any previous preview

    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function () {
        const image = new Image();
        image.src = reader.result;
        image.alt = 'Preview Foto Tweet';
        image.style.maxWidth = '100%';
        image.style.maxHeight = '200px';
        imagePreview.appendChild(image);
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}