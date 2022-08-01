@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <button id="btn-nft-enable" onclick="startFCM()"
                    class="btn btn-danger btn-xs btn-flat">Allow for Notification
                </button>

            <div class="card mt-3">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('send.web-notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDV9ExP1U1ucVqy3mrwC3GrvCLD3kPreew",
        authDomain: "training-b00b9.firebaseapp.com",
        projectId: "training-b00b9",
        storageBucket: "training-b00b9.appspot.com",
        messagingSenderId: "382787136089",
        appId: "1:382787136089:web:da5921b7337a9905cfdf48",
        measurementId: "G-EXDP1XZNDT"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (token) {
                console.log(token);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            
            $.ajax({
                url: '{{ route("save-token") }}',
                type: 'POST',
                data: {
                    token: token
                },

            dataType: 'JSON',
            success: function (response) {
            alert('Token saved successfully.');
            },
            error: function (err) {
            console.log('User Chat Token Error' + err);
            },
            });
            
            }).catch(function (err) {
            console.log('User Chat Token Error' + err);
            });
            }

    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });

</script>
@endsection
