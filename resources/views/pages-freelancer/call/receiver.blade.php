@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="main-content">

            <div class="container">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <div class="box h-[70vh] flex flex-col">
                            <div class="p-5">
                                <h2>Receiving Call</h2>
                                <div id="local-player" style="width: 400px; height: 300px; background: #333;"></div>
                                <div id="remote-playerlist"></div>

                                <a href="{{ route('freelancer.call.end', $call->id) }}" class="btn btn-danger mt-4">End
                                    Call</a>

                                <p id="status">Waiting for peer to join...</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script>
        const client = AgoraRTC.createClient({
            mode: "rtc",
            codec: "vp8"
        });

        client.join("{{ $token }}", "{{ $channelName }}", "{{ $uid }}").then((uid) => {
            console.log("Joined channel successfully as", uid);

            const localStream = AgoraRTC.createStream({
                streamID: uid,
                audio: true,
                video: true,
            });

            localStream.init(() => {
                localStream.play("local-player");
                client.publish(localStream);
            });
        });
        client.on("stream-added", (evt) => {
            client.subscribe(evt.stream);
        });

        client.on("stream-subscribed", (evt) => {
            const remoteStream = evt.stream;
            const remoteId = "remote-player-" + remoteStream.getId();
            const remoteDiv = document.createElement("div");
            remoteDiv.id = remoteId;
            remoteDiv.style.width = "400px";
            remoteDiv.style.height = "300px";
            document.getElementById("remote-playerlist").appendChild(remoteDiv);
            remoteStream.play(remoteId);
        });

        client.on('connection-state-change', (curState, revState, reason) => {
            console.log('Connection state changed from', revState, 'to', curState, 'because', reason);
            if (curState === 'CONNECTED') {
                // مكالمة ناجحة
                document.getElementById('status').innerText = 'Call Connected ✅';
            } else if (curState === 'DISCONNECTED') {
                document.getElementById('status').innerText = 'Call Disconnected ❌';
            }
        });

        client.on('peer-online', (evt) => {
            console.log('Peer online:', evt.uid);
            document.getElementById('status').innerText = 'Peer joined the call';
        });

        client.on('peer-leave', (evt) => {
            console.log('Peer left:', evt.uid);
            document.getElementById('status').innerText = 'Peer left the call';
        });
    </script>
@endsection
