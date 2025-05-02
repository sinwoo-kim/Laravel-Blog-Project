
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('post-image');
            const fileName = document.querySelector('.file-name');
            const imagePreview = document.getElementById('imagePreview');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.style.backgroundImage = `url(${e.target.result})`;
                        imagePreview.textContent = '';
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    fileName.textContent = 'No file chosen';
                    imagePreview.style.backgroundImage = 'none';
                    imagePreview.textContent = 'Image preview will appear here';
                }
            });

            // 초기 상태 설정
            if(!imagePreview.style.backgroundImage || imagePreview.style.backgroundImage === 'none') {

                imagePreview.textContent = 'Image preview will appear here';
            } else {
                // 배경 이미지가 이미 설정되어 있으면 텍스트 제거
                imagePreview.textContent ='';
            }
            
        });
    