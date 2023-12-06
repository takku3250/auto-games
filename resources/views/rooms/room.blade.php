<x-app-layout>
    <x-slot name="head">
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
<link rel='stylesheet' href='https://unpkg.com/@fortawesome/fontawesome-svg-core@1.2.17/styles.css' integrity='sha384-bM49M0p1PhqzW3LfkRUPZncLHInFknBRbB7S0jPGePYM+u7mLTBbwL0Pj/dQ7WqR' crossorigin='anonymous'>
<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.css"
        type="text/css" media="all" />
       <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
        </script>-->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</x-slot>

    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">

            <div class="chat"style="width:80vw;min-width:300px;max-width:550px;">
                @if($messages_data)
                @foreach($messages_data as $messages)
                {{$messages->message}}
                {{$messages->owner_id}}
                @endforeach
                @endif
                <div class="card">
                    <div class="card-header msg_head bg-secondary">
                        <div class="d-flex bd-highlight">
                            <div class="user_info">
                                <span>{{ $user->name }}</span>
                                <p>message count : {{ $user->get_room_messages_count }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body">

                    </div>
                    <div class="card-footer bg-secondary">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text attach_btn"><i class="fas fa-paperclip">text</i></span>
                            </div>
                            
                            <textarea id="message" name="message" class="form-control type_msg"
                                placeholder="Type your message..."></textarea>
                            <div class="input-group-append">
                                <span class="input-group-text send_btn"><i class="fas fa-location-arrow">test</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script>
   
       $(document).ready(function() {
            $('.send_btn').on('click', function() {
                //let message=getElementById('message').value;
                 owner_id = @json($user->id);
                 room_id=@json($room_id);
               
                message = $('#message').val();
                send_message(message);
            });
            //post送信するためcsrfが必須。
            function send_message(message) {
                if (!message) {
                    return false;
                }
                create_message = auth_message(message, msg_time)
                $('.card-body').append(create_message);

               
               console.log(message);
                $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    dataType: 'json',
                    url: "{{ route('store_message', $user) }}",
                    //timeout: 3000,
                    data:{
                        message: message,
                        owner_id: owner_id, 
                        room_id: room_id
                    },   
                    
                });
            }
        });
        //htmlを作成する
        new Date().toLocaleString({
            timeZone: 'Asia/Tokyo'
        })

        Date.prototype.yyyymmddhis = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            var h = this.getHours().toString();
            var m = this.getMinutes().toString();
            var s = this.getSeconds().toString();

            return yyyy + "/" + (mm[1] ? mm : "0" + mm[0]) + "/" + (dd[1] ? dd : "0" + dd[0]) +
                " " + (h[1] ? h : "0" + h[0]) + ":" + (m[1] ? m : "0" + m[0]) + ":" + (s[1] ? s : "0" + s[
                    0]); // padding
        };

        msg_time = new Date();
        msg_time = msg_time.yyyymmddhis()
        auth_img_url = "{{ Auth::user()->img_url }}"

        function auth_message(message, msg_time) {
            if (!message) {
                return false;
            }
            create_message = `<div class="d-flex justify-content-end mb-4">`;
            create_message += '<div class="msg_cotainer_send">';
            create_message += `${message.replace(/\n/g, '<br>')}`;
            create_message += `<span class="msg_time_send text-nowrap">${msg_time}</span>`;
            create_message += '</div>';
            create_message += '<div class="img_cont_msg">';
            create_message += `<img src="${auth_img_url}" class="rounded-circle user_img_msg"></div></div>`;

            return create_message;
        }

        //ajaxでメッセージを取得
        //+
        getMessages()
        //+
        function getMessages() {
            $.ajax({
                    type: 'get',
                    datatype: 'json',
                    url: "{{ route('get_messages', $user) }}",
                    timeout: 3000,
                })
                .done(function(data, textStatus, jqXHR) {
                    auth_id = {{ Auth::id() }}
                    $result = $(".card-body"),
                        messages = [];

                    $.each(data, function(index, value) {
                        message = ``;
                        if (auth_id == value.from_user_id) {
                            message += auth_message(value.message, value.created_at);
                        } else {
                            message += user_message(value.message, value.created_at);
                        }
                        messages.push(message);
                    });
                    $result[0].innerHTML = messages.join("");
                });
        }
        //htmlの作成
        //+
        user_img_url = "{{ $user->img_url }}";
        //+
        function user_message(message, msg_time) {
            create_message = `<div class="d-flex justify-content-start mb-4">`;
            create_message += '<div class="img_cont_msg">';
            create_message += `<img src="${user_img_url}" class="rounded-circle user_img_msg"></div>`;
            create_message += '<div class="msg_cotainer">';
            create_message += `${message.replace(/\n/g, '<br>')}`;
            create_message += `<span class="msg_time text-nowrap">${msg_time}</span>`;
            create_message += '</div></div>';
            return create_message;
        }

        //+
        //チャンネルの購入とブロードキャストするイベントを設定する
        window.Echo.channel("chat.{{ Auth::id() }}") //ok
            .listen('.chat_event', (data) => { //.を忘れるな
            // message = user_message(data.message, new Date(data.created_at).yyyymmddhis());
                es_message = escape_html(data.message);
                message = user_message(es_message, new Date(data.created_at).yyyymmddhis());

                    
                $('.card-body').append(message).animate({scrollTop:$('.msg_cotainer:last').offset().top});
                });

//+
        function escape_html(string) {
            if (typeof string !== 'string') {
                return string;
            }
            return string.replace(/[&'`"<>]/g, function(match) {
            return {
                '&': '&amp;',
                "'": '&#x27;',
                '`': '&#x60;',
                    '"': '&quot;',
                    '<': '&lt;',
                    '>': '&gt;',
                } [match]
            });
        }
            
    </script>


</x-app-layout>
            