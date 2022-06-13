function validateSize(input) {
    const fileSize = input.files[0].size / 1024 / 1024;
    if (fileSize > 2) {
        alert('File size exceeds 2 mb');
        document.getElementById("file").value = "";
    }
}
