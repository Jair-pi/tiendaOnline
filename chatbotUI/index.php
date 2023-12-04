
<body>
    <!-- Font Awesome 4.7 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Bootstrap 5.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Tu archivo de estilos personalizados -->
    <link rel="stylesheet" href="chatbotUI/style.css">

    <div class="container_chatbot chat_collapse" id="chatUI">
        <div class="row">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div class="chat">
                        <!--cabecera del chat-->
                        <div class="chat-header clearfix" id="chat_header">
                            <div class="row align-items-center">
                                <div class="col-lg-6 head_elements">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_info">
                                        <img src="chatbotUI/src/bot_img.jpeg" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-0">RomedilBot</h6>
                                        <small>Activo ahora</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="list-unstyled m-0" id="chat_cont">

                                <!-- Mensaje del usuario
                            <li class="clearfix">
                                <div class="message-data text-end">
                                    <span class="message-data-time">10:10 AM, Today</span>
                                    <img src="src/user_img.jpg" alt="avatar">
                                </div>
                                <div class="message other-message float-right"> Buenos días, a cuánto el kilo de carne? </div>
                            </li>
                            -----Mensaje del bot-------
                            <li class="clearfix">
                                <div class="message-data">
                                    <span class="message-data-time">10:12 AM, Today</span>
                                </div>
                                <div class="message my-message">¿?</div>
                            </li>
                             -->


                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <span class="input-group-text" id="btn_sendMsg">
                                    <i class="fa fa-send"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Enter text here..." id="input_msg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="chatbotUI/chat.js"></script>
    <script src="chatbotUI/ui.js"></script>

</body>