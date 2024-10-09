const CHUNK_SIZE = 1024 * 1024;
let uploadedChunks = 0;

document.getElementById('file-upload_btn').addEventListener('click', () => {
    const fileInput = document.getElementById('file-upload_input');
    const file = fileInput.files[0];
    const progressBar = document.getElementById('progress-bar');

    uploadFile(file, progressBar);
});

async function uploadFile(file,progressBar) {
    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    for (let i = uploadedChunks; i < totalChunks; i++) {
        const chunk = file.slice(i * CHUNK_SIZE, (i + 1) * CHUNK_SIZE);
        const formData = new FormData();
        formData.append('file', chunk);
        formData.append('chunkNumber', i);
        formData.append('totalChunks', totalChunks);
        formData.append('fileName', file.name);

        try {
            const response = await axios.post('/file-upload', formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function(progressEvent) {
                    const percentCompleted = Math.round((i + 1) / totalChunks * 100);
                    progressBar.style.width = percentCompleted + '%';
                    progressBar.innerText = percentCompleted + '%';
                }
            });

            if (response.status !== 200) {
                throw new Error('Upload failed at chunk ' + i);
            }
            uploadedChunks = i + 1;
            console.log(`Uploaded chunk ${i + 1} of ${totalChunks}`);
        } catch (error) {
            break;
        }
    }

    if (uploadedChunks === totalChunks) {
        progressBar.style.width = '100%';
        progressBar.innerText = '100%';
    } else {
        uploadFile(file);
    }
}
