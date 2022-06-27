if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

function validateSize(input) {
    const fileSize = input.files[0].size / 1024 / 1024;
    if (fileSize > 2) {
        alert('File size exceeds 2 MiB');
    } else {
    }
}