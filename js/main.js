var videoMaxLengthInSeconds = 120;

        // Inialize the video player
        var player = videojs("myVideo", {
            controls: true,
            width: 720,
            height: 480,
            fluid: false,
            plugins: {
                record: {
                    audio: true,
                    video: true,
                    maxLength: videoMaxLengthInSeconds,
                    debug: true,
                    videoMimeType: "video/webm;codecs=H264"
                }
            }
        }, function(){
            // print version information at startup
            videojs.log(
                'Using video.js', videojs.VERSION,
                'with videojs-record', videojs.getPluginVersion('record'),
                'and recordrtc', RecordRTC.version
            );
        });

        // error handling for getUserMedia
        player.on('deviceError', function() {
            console.log('device error:', player.deviceErrorCode);
        });

        // Handle error events of the video player
        player.on('error', function(error) {
            console.log('error:', error);
        });

        // user clicked the record button and started recording !
        player.on('startRecord', function() {
            console.log('started recording! Do whatever you need to');
        });

        player.on('finishRecord', function() {
        // the blob object contains the recorded data that
        // can be downloaded by the user, stored on server etc.
        console.log('finished recording:', player.recordedData);
        // upload recorded data
        upload(player.recordedData);
        });
        function upload(blob) {
        var serverUrl = './upload-video.php';
        var formData = new FormData();
        formData.append('video', blob, blob.name);
        console.log('upload recording ' + blob.name + ' to ' + serverUrl);
        // start upload
        fetch(serverUrl, {
        method: 'POST',
        body: formData
        }).then(
        success => console.log('upload recording complete.')
        ).catch(
        error => console.error('an upload error occurred!')
        );
        }
            
       