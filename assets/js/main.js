import Dropzone from 'dropzone';

let counter = 0;
let dropbox = document.getElementById('discuteaDropzone');
let repeator = document.getElementById(dropbox.dataset.repeatorId);

function addMedia(media) {
    let newWidget = '<input type="hidden" id="images_' + counter + '" name="images[' + counter + ']" value="' + media + '" />';
    repeator.innerHTML += newWidget;

    counter++;
}

new Dropzone('#discuteaDropzone', {
    url: dropbox.dataset.action,
    init: function() {
        this.on('success', function(file, response) {
            addMedia(response.id);
        });
    }
});
