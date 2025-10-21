
var convertedVoice;

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
var sentenceId ;


function uploadConvertedVoice(sentenceId) {
    let convertedVoice = document.getElementById('converted_mp3_src_' + sentenceId).src;
    Swal.fire({
        title: "از بارگزاری صدا مطمئن هستید ؟ ",
        showCancelButton: true,
        confirmButtonText: "بله",
        cancelButtonText: "تلاش دوباره",
        showLoaderOnConfirm: true,
        backdrop: true,
        preConfirm: async () => {
            try {
                let formData = new FormData();
                formData.append("sound", audioFile);
                formData.append("_token", $('meta[name="_token"]').attr('content'))
                formData.append("sentence_id", sentenceId);
                return fetch(uploadConvertedVoiceUrl, {
                    method: "POST",
                    body: formData,
                })
                    .then(function (response){
                        if(response.status == 403) {
                            Swal.fire({
                                icon: 'error',
                                title: 'عدم دسترسی',
                                text: 'شما مجاز به انجام این کار نیستید',
                            });
                        }else if(response.status != 200){
                            Swal.fire({
                                icon: 'error',
                                title: 'خطا در عملیات',
                                text: 'عملیات با خطا روبرو شده است',
                            });
                        }else if(response.status == 200){
                            Swal.fire({
                                icon: 'success',
                                title: 'عملیات موفق',
                                text: 'بارگزاری صدا با موفقیت انجام شد',
                            });
                        }

                    })
                    .catch(function (error){
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا در عملیات',
                            text: 'عملیات با خطا روبرو شده است',
                        });
                    });

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطا در عملیات',
                });
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {


        }
    });

}

async function convertVoice(sentenceId) {

    let voiceUrl = document.getElementById('mp3_src_' + sentenceId).src
    if (voiceUrl)
    Swal.fire({
        title: "در حال تغییر صدا . . .",
        html: "این فرایند در  <b></b> ثانیه پایان می بابد.",
        timer: 12000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        // if (result.dismiss === Swal.DismissReason.timer) {
        //     console.log("I was closed by the timer");
        // }
    });
    let mainVoice = new File([await (await fetch(voiceUrl)).blob()], 'blob_src_' + sentenceId+'.wav',{
        type:'audio/wav'
    });
    const formData = new FormData();
    formData.append('_method', 'post');
    formData.append('voiceModelId', '110792');
    formData.append('soundFile', mainVoice);

    let axiosConfig = {
        headers: {
            "Authorization": "Bearer ttvUmtXE.TNjsMGVNxOmXWZ_3haZSCrOf",
        }
    };

    axios.post('https://arpeggi.io/api/kits/v1/voice-conversions', formData, axiosConfig)
        .then((res) => {

            console.log("RESPONSE RECEIVED 1: ", res);

            setTimeout(function (){
                getConvertedVoice(res.data.id,sentenceId)


            }, 5000)
        })
        .catch((err) => {
            Toast.fire({
                icon: 'error',
                title: 'خطا در عملیات',
            })
            console.log("AXIOS ERROR: ", err);
        })

}

function getConvertedVoice(id,sentenceId) {

    console.log('id : '+id)
    let axiosConfig = {
        headers: {
            "Authorization": "Bearer ttvUmtXE.TNjsMGVNxOmXWZ_3haZSCrOf",
        }
    };

    axios.get('https://arpeggi.io/api/kits/v1/voice-conversions/'+id, axiosConfig)
        .then((res) => {
            console.log(res)

            var url = res.data.outputFileUrl;
            var $source = $('#converted_voice_'+sentenceId);
            $source[0].src = url;
            // audioFile
            fetch(url).then(r => r.blob()).then(blobFile => {
                audioFile = blobFile;
            })

        })
        .catch((err) => {
            Toast.fire({
                icon: 'error',
                title: 'خطا در عملیات',
            })
            console.log("AXIOS ERROR 2: ", err);
        })

}

function deleteConvertedVoice(sentenceId) {
    $.ajax({
        url: deleteConvertedVoiceUrl,
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


