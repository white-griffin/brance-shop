

URL = window.URL || window.webkitURL;
var gumStream;
//stream from getUserMedia()
var rec;
//Recorder.js object
var input;
//MediaStreamAudioSourceNode we'll be recording
// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;

var audioFile ;
function startRecording() {
    console.log("recordButton clicked");
    var constraints = {
        audio: true,
        video: false
    }
    /* Disable the record button until we get a success or fail from getUserMedia() */


    /* We're using the standard promise based getUserMedia()

    https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia */

    navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
        var audioContext = new AudioContext;
        console.log("getUserMedia() success, stream created, initializing Recorder.js ...");
        /* assign to gumStream for later use */
        gumStream = stream;
        /* use the stream */
        input = audioContext.createMediaStreamSource(stream);
        /* Create the Recorder object and configure to record mono sound (1 channel) Recording 2 channels will double the file size */
        rec = new Recorder(input, {
            numChannels: 1
        })
        //start the recording process
        rec.record()
        console.log("Recording started");
    }).catch(function(err) {
        //enable the record button if getUserMedia() fail
    });
}

function stopRecording(id) {
    console.log("stopButton clicked");
    sentenceId = id
    //disable the stop button, enable the record too allow for new recordings

    //reset button just in case the recording is stopped while paused

    //tell the recorder to stop the recording
    rec.stop(); //stop microphone access
    gumStream.getAudioTracks()[0].stop();
    //create the wav blob and pass it on to createDownloadLink
    rec.exportWAV(createDownloadLink);
}

function uploadAudio(sentenceId) {
    let formData = new FormData();
    formData.append("sound", audioFile);
    formData.append("_token", $('meta[name="_token"]').attr('content'));
    formData.append("sentence_id", sentenceId);
    fetch(uploadMainVoiceUrl, {
        method: "POST",
        body: formData,
    })
        .then(function (response){
            if(response.status == 403){
                Toast.fire({
                    icon: 'error',
                    title: 'عدم دسترسی'
                })
            }else {
                Toast.fire({
                    icon: 'success',
                    title: 'عملیات موفق'
                })
            }

        })
        .catch(function (error){
            Toast.fire({
                icon: 'error',
                title: 'خطا در عملیات'
            })
        });
}

function createDownloadLink(blob) {
    audioFile = blob;
    var url = URL.createObjectURL(blob);
    var $source = $('#voice_'+sentenceId);
    $source[0].src = url;


}

function deleteVoice(sentenceId) {
    $.ajax({
        url: deleteMainVoiceUrl,
        method: 'POST',
        data: {
            _token: $('meta[name="_token"]').attr('content'),
            sentence_id : sentenceId,

        },
        success:function(response)
        {
            if(response.status == 403){
                Toast.fire({
                    icon: 'error',
                    title: 'عدم دسترسی'
                })
            }else {
                Toast.fire({
                    icon: 'success',
                    title: 'عملیات موفق',
                })
                document.getElementById('voice_'+sentenceId).src = ''
            }



        },
        error: function(response) {
            console.log(response)
            Toast.fire({
                icon: 'error',
                title: 'خطا در عملیات',
            })
        }
    });
}
