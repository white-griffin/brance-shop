@extends('layouts.admin.admin')
@section('title','  کاربران  ')
@section('pageTitle',' ویرایش  کاربر ')
@section('content')
    @include('admin.users.main-card',[
       'active' =>'restricted-sentences'
   ])
    <div class="card" data-select2-id="select2-data-131-rhmf">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست جملات ممنوعه کاربر</span>
            </h3>

        </div>
        <!--begin::Card body-->
        <div class="card-body pt-0">

            <!--begin::Table-->
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                           id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead >
                        <!--begin::Table row-->
                        <tr class="min-w-125px sorting" style="text-align: center">


                            <th class="min-w-300px"
                                colspan="1"  >  جمله
                            </th>

                            <th class="min-w-100px  "
                                colspan="1"  > لهجه
                            </th>
                            <th class="min-w-100px  "
                                colspan="1"  > زبان سرچ
                            </th>
                            <th class="min-w-200px sorting"
                                style="width: 170px;"> تلفظ
                            </th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1"
                                aria-label="Status: activate to sort column ascending">وضعیت
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1"
                                aria-label="Status: activate to sort column ascending">تاریخ سرچ
                            </th>


                            <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                 aria-label="Actions">عملیات
                            </th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600" id="words" style="text-align: center">
                        @if($sentences->count() > 0)
                            @foreach($sentences as $sentence)
                                <tr class="odd" id="{{$sentence->id}}" data-id="{{$sentence->id}}" style="border-color: black">


                                    <td >
                                        <div class="row">
                                            <div>
                                                <span class="col-md-1">فارسی :</span>
                                                <input class=" col-md-10 form-control form-control-lg form-control-solid mb-3"
                                                       name="fa_{{$sentence->id}}"
                                                       value="{{$sentence->fa_sentence}}"
                                                       id="fa_{{$sentence->id}}"
                                                       disabled
                                                />
                                            </div>
                                            <div>
                                                <span>عربی :</span>
                                                <input class="form-control form-control-lg form-control-solid"
                                                       name="ar_{{$sentence->id}}"
                                                       value="{{$sentence->ar_sentence}}"
                                                       id="ar_{{$sentence->id}}"
                                                       disabled
                                                />
                                            </div>


                                        </div>


                                    </td>
                                    <td>{!! $sentence->accent->title !!}</td>
                                    <td>
                                        {!! $sentence->webPresent()->baseLanguage !!}
                                    </td>
                                    <td >
                                        <audio  controls style="max-width: 250px" id="voice_{{$sentence->id}}">
                                            <source src="{{$sentence->webPresent()->voice}}" type="audio/ogg" >
                                            <source src="{{$sentence->webPresent()->voice}}" type="audio/mp3" >
                                        </audio>
                                        <div class="d-flex justify-content-evenly">
                                            <a class="btn btn-icon btn-light-info btn-sm me-1"
                                               onclick="startRecording()">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-microphone"></i>
                                            </span>
                                            </a>

                                            <a class="btn btn-icon btn-light-dark btn-sm me-1"
                                               onclick="stopRecording({{$sentence->id}})">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-stop-circle"></i>
                                            </span>
                                            </a>
                                            <a class="btn btn-icon btn-light-success btn-sm me-1"
                                               onclick="uploadAudio({{$sentence->id}})">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-upload"></i>
                                            </span>
                                            </a>
                                            <a class="btn btn-icon btn-light-danger btn-sm me-1"
                                               onclick="deleteVoice({{$sentence->id}})">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            </a>

                                        </div>
                                    </td>

                                    <td>
                                        <!--begin::Badges-->
                                        {!! $sentence->webPresent()->status !!}
                                        <!--end::Badges-->
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                        {!! $sentence->webPresent()->createdDate !!}
                                        <!--end::Badges-->
                                    </td>
                                    <!--end::Date=-->
                                    <!--begin::Action=-->
                                    <td class="">

                                        <a class="btn btn-icon btn-light-warning btn-sm me-1" id="enable_edit_{{$sentence->id}}"
                                           onclick="enableEdit({{$sentence->id}})">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </a>
                                        <a class="btn btn-icon btn-light-success btn-sm me-1" style="display: none" id="submit_edit_{{$sentence->id}}"
                                           onclick="submitEdit({{$sentence->id}},{{$sentence->accent->id}})">
                                              <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-check-square"></i>
                                            </span>
                                        </a>
                                        <a href="{{route('admin.sentences.edit',$sentence)}}"
                                           class="btn btn-icon btn-light-primary btn-sm me-1">
                                             <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </a>

                                        @include('admin.__modules.delete-link',['url' => route('admin.sentences.delete',$sentence)])
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align:center;color:red"><a class="btn btn-danger" href="">
                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i></a></td>
                            </tr>
                        @endif
                        </tbody>
                        <!--end::Table body-->

                    </table>
                </div>

            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

@endsection
@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function enableEdit(rowId) {
            document.getElementById('ar_'+rowId).disabled = false;
            document.getElementById('fa_'+rowId).disabled = false;
            $('#enable_edit_'+rowId).hide()
            $('#submit_edit_'+rowId).show()
        }

        function submitEdit(rowId,accent) {

            $.ajax({
                url: "{{route('admin.sentences.change-sentences')}}",
                method: 'POST',
                data: {
                    _token: "{!! csrf_token() !!}",
                    sentence_id : rowId,
                    fa_sentence : document.getElementById('fa_'+rowId).value,
                    ar_sentence : document.getElementById('ar_'+rowId).value,
                    accent : accent,
                },
                success:function(response)
                {
                    Toast.fire({
                        icon: 'success',
                        title: 'عملیات موفق',
                    })
                    document.getElementById('ar_'+rowId).disabled = true;
                    document.getElementById('fa_'+rowId).disabled = true;
                    $('#enable_edit_'+rowId).show()
                    $('#submit_edit_'+rowId).hide()


                },
                error: function(response) {
                    if(response.status == 403){
                        Toast.fire({
                            icon: 'error',
                            title: 'عدم دسترسی'
                        })
                    }else {
                        Toast.fire({
                            icon: 'error',
                            title: 'خطا در عملیات',
                        })

                    }

                }
            });
        }

        function createFastSentence(rowId,accent) {
            Swal.fire({
                title: "از بارگزاری جمله مطمئن هستید ؟ ",
                showCancelButton: true,
                confirmButtonText: "بله",
                cancelButtonText: "لغو",
                showLoaderOnConfirm: true,
                backdrop: true,
                preConfirm: async () => {
                    try {
                        let formData = new FormData();
                        formData.append("_token", "{{csrf_token()}}");
                        formData.append("fa_sentence", document.getElementById('fast_fa_'+rowId).value);
                        formData.append("ar_sentence", document.getElementById('fast_ar_'+rowId).value);
                        formData.append("accent", accent);

                        return fetch("{{route('admin.sentences.fast-store')}}", {
                            method: "POST",
                            body: formData,
                        })
                            .then(function (response){
                                if(response.status != 200){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'خطا در عملیات',
                                        text: 'عملیات با خطا روبرو شده است',
                                    });
                                }else if(response.status == 200){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'عملیات موفق',
                                        text: 'بارگزاری جمله با موفقیت انجام شد',
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
    </script>
    <script>
        function deleteVoice(sentenceId) {
            $.ajax({
                url: "{{route('admin.sentences.delete-voice')}}",
                method: 'POST',
                data: {
                    _token: "{!! csrf_token() !!}",
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
        var wordID ;
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
            wordID = id
            //disable the stop button, enable the record too allow for new recordings

            //reset button just in case the recording is stopped while paused

            //tell the recorder to stop the recording
            rec.stop(); //stop microphone access
            gumStream.getAudioTracks()[0].stop();
            //create the wav blob and pass it on to createDownloadLink
            rec.exportWAV(convertVoice);
        }

        function uploadAudio(sentenceId) {
            if (!audioFile){
                Swal.fire({
                    icon: 'error',
                    title: 'پیدا نشد!',
                    text: 'صدای جدیدی ضبط نشده است',
                });
            }else{
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
                            formData.append("_token", "{{csrf_token()}}");
                            formData.append("sentence_id", sentenceId);
                            return fetch("{{route('admin.sentences.upload-voice')}}", {
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

        }



        function convertVoice(blob) {

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

            const file = new File([blob], 'test.wav', {
                type: 'audio/wav',
            })

            const formData = new FormData();
            formData.append('_method', 'post');
            formData.append('voiceModelId', '1039621');
            formData.append('soundFile', file);
            let axiosConfig = {
                headers: {
                    "Authorization": "Bearer MKeDbSJj.hQ0LzT4eqtsxFdgTJLQ13Qar",
                }
            };

            axios.post('https://arpeggi.io/api/kits/v1/voice-conversions', formData, axiosConfig)
                .then((res) => {

                    console.log("RESPONSE RECEIVED 1: ", res);

                    setTimeout(function (){
                        getConvertedVoice(res.data.id)


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

        function getConvertedVoice(id) {

            let voiceUrl;
            let axiosConfig = {
                headers: {
                    "Authorization": "Bearer MKeDbSJj.hQ0LzT4eqtsxFdgTJLQ13Qar",
                }
            };

            axios.get('https://arpeggi.io/api/kits/v1/voice-conversions/'+id, axiosConfig)
                .then((res) => {
                    convertedVoice = res.data.outputFileUrl

                    var url = res.data.outputFileUrl;
                    var $source = $('#voice_'+wordID);
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


    </script>
@endsection
