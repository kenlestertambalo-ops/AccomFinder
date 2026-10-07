<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages | AccomFinder</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            background: #f5f7fb;
            color: #333;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #ddd;
            z-index: 1000;
        }

        .logo {
            height: 145px;
            padding: 25px;
            border-bottom: 1px solid #eee;
        }

        .logo h2 {
            color: #2563eb;
            font-size: 30px;
            font-weight: 700;
        }

        .logo p {
            margin-top: 5px;
            color: gray;
            font-size: 16px;
        }

        .menu {
            padding: 20px;
        }

        .menu a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: .2s ease;
        }

        .menu a:hover {
            background: #f1f5f9;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout {
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .logout a {
            display: block;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .logout a:hover {
            background: #f1f5f9;
            color: #2563eb;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f5f7fb;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            z-index: 900;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-info strong {
            font-size: 20px;
            color: #111;
        }

        .user-info span {
            margin-top: 3px;
            font-size: 15px;
            color: #777;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 110px 40px 40px;
        }

        .page-title {
            margin-bottom: 30px;
        }

        .page-title h1 {
            margin-bottom: 5px;
            color: #111;
            font-size: 44px;
            font-weight: 700;
        }

        .page-title p {
            color: #777;
            font-size: 21px;
        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .success-message {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }


        /* =====================================================
           MESSAGE CONTAINER
        ===================================================== */

        .messages-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }


        /* =====================================================
           CONVERSATION CARD
        ===================================================== */

        .message-card {
            background: #ffffff;
            border: 1px solid #e1e5ea;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        }


        /* =====================================================
           OWNER HEADER
        ===================================================== */

        .message-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .owner-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .owner-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 700;
        }

        .owner-name {
            color: #173b63;
            font-size: 16px;
            font-weight: 700;
        }

        .owner-email {
            color: #777;
            font-size: 12px;
            margin-top: 2px;
        }

        .message-date {
            color: #888;
            font-size: 12px;
        }


        /* =====================================================
           PROPERTY
        ===================================================== */

        .property-box {
            background: #f5f7fb;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            padding: 10px 13px;
            margin-bottom: 18px;
            color: #385572;
            font-size: 13px;
        }


        /* =====================================================
           CONVERSATION
        ===================================================== */

        .conversation {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 18px;
        }

        .chat-message {
            max-width: 75%;
            padding: 11px 14px;
            border-radius: 12px;
        }

        .chat-message.student {
            align-self: flex-end;
            background: #2563eb;
            color: white;
            border-bottom-right-radius: 3px;
        }

        .chat-message.owner {
            align-self: flex-start;
            background: #f1f5f9;
            color: #333;
            border-bottom-left-radius: 3px;
        }

        .sender-name {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .chat-text {
            font-size: 14px;
            line-height: 1.5;
            white-space: pre-wrap;
        }

        .chat-time {
            display: block;
            margin-top: 6px;
            font-size: 10px;
            opacity: .7;
        }


        /* =====================================================
           REPLY FORM
        ===================================================== */

        .reply-form {
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 90px;
            resize: vertical;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            outline: none;
        }

        .reply-form textarea:focus {
            border-color: #2563eb;
        }

        .reply-button {
            margin-top: 10px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .reply-button:hover {
            background: #1d4ed8;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-block;
            margin-bottom: 15px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status.replied {
            background: #dcfce7;
            color: #166534;
        }

        .status.unread {
            background: #fff7ed;
            color: #92400e;
        }


        /* =====================================================
           NO MESSAGES
        ===================================================== */

        .no-messages {
            background: #ffffff;
            border: 1px solid #e1e5ea;
            border-radius: 12px;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 40px;
        }

        .no-messages-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .no-messages h2 {
            color: #173b63;
            margin-bottom: 10px;
        }

        .no-messages p {
            color: #777;
            font-size: 16px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .navbar {
                position: relative;
                left: 0;
            }

            .content {
                padding: 30px 20px;
            }

            .page-title h1 {
                font-size: 34px;
            }

            .page-title p {
                font-size: 17px;
            }

            .message-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .chat-message {
                max-width: 90%;
            }
        }

    </style>

</head>


<body>


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <div class="sidebar">

        <div class="logo">

            <h2>
                AccomFinder
            </h2>

            <p>
                Student Portal
            </p>

        </div>


        <div class="menu">

            <a href="{{ route('student.dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('student.search') }}">
                🔍 Search
            </a>

            <a href="{{ route('student.saved') }}">
                ❤ Saved
            </a>

            <a
                href="{{ route('student.messages') }}"
                class="active"
            >
                💬 Messages
            </a>

        </div>


        <div class="logout">

            <a href="{{ route('student.logout') }}">
                🚪 Logout
            </a>

        </div>

    </div>


    <!-- =====================================================
         MAIN
    ====================================================== -->

    <div class="main">


        <!-- NAVBAR -->

        <div class="navbar">

            <div class="user-info">

                <strong>
                    {{ session('student_name', 'Student') }}
                </strong>

                <span>
                    {{ session('student_email', 'Welcome') }}
                </span>

            </div>

        </div>


        <!-- CONTENT -->

        <div class="content">


            <div class="page-title">

                <h1>
                    Messages
                </h1>

                <p>
                    Communicate with accommodation owners
                </p>

            </div>


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="success-message">
                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

                <div class="error-message">
                    {{ session('error') }}
                </div>

            @endif


            <!-- VALIDATION ERRORS -->

            @if($errors->any())

                <div class="error-message">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <!-- =================================================
                 INQUIRIES
            ================================================== -->

            @if(isset($inquiries) && $inquiries->count() > 0)


                <div class="messages-container">


                    @foreach($inquiries as $inquiry)


                        <div class="message-card">


                            <!-- OWNER INFORMATION -->

                            <div class="message-header">

                                <div class="owner-info">

                                    <div class="owner-avatar">

                                        {{
                                            strtoupper(
                                                substr(
                                                    $inquiry->owner->name ?? 'O',
                                                    0,
                                                    1
                                                )
                                            )
                                        }}

                                    </div>


                                    <div>

                                        <div class="owner-name">

                                            {{ $inquiry->owner->name ?? 'Property Owner' }}

                                        </div>


                                        <div class="owner-email">

                                            {{ $inquiry->owner->email ?? 'Owner' }}

                                        </div>

                                    </div>

                                </div>


                                <div class="message-date">

                                    {{ $inquiry->created_at->format('M d, Y h:i A') }}

                                </div>

                            </div>


                            <!-- PROPERTY -->

                            <div class="property-box">

                                <strong>
                                    Accommodation:
                                </strong>

                                {{ $inquiry->accommodation->name ?? 'Accommodation' }}

                                @if(!empty($inquiry->accommodation->address))

                                    <br>

                                    📍 {{ $inquiry->accommodation->address }}

                                @endif

                            </div>


                            <!-- =================================================
                                 CONVERSATION
                            ================================================== -->

                            <div class="conversation">

                                @if(isset($messages[$inquiry->id]))

                                    @foreach($messages[$inquiry->id] as $message)

                                        @if($message->sender_type === 'student')

                                            <div class="chat-message student">

                                                <div class="sender-name">
                                                    You
                                                </div>

                                                <div class="chat-text">
                                                    {{ $message->message }}
                                                </div>

                                                <small class="chat-time">

                                                    {{ $message->created_at->format('M d, Y h:i A') }}

                                                </small>

                                            </div>

                                        @else

                                            <div class="chat-message owner">

                                                <div class="sender-name">
                                                    {{ $inquiry->owner->name ?? 'Owner' }}
                                                </div>

                                                <div class="chat-text">
                                                    {{ $message->message }}
                                                </div>

                                                <small class="chat-time">

                                                    {{ $message->created_at->format('M d, Y h:i A') }}

                                                </small>

                                            </div>

                                        @endif

                                    @endforeach

                                @else

                                    <!-- FALLBACK FOR OLD INQUIRIES -->

                                    <div class="chat-message student">

                                        <div class="sender-name">
                                            You
                                        </div>

                                        <div class="chat-text">
                                            {{ $inquiry->message }}
                                        </div>

                                    </div>

                                    @if(!empty($inquiry->reply))

                                        <div class="chat-message owner">

                                            <div class="sender-name">
                                                {{ $inquiry->owner->name ?? 'Owner' }}
                                            </div>

                                            <div class="chat-text">
                                                {{ $inquiry->reply }}
                                            </div>

                                        </div>

                                    @endif

                                @endif

                            </div>


                            <!-- =================================================
                                 STATUS
                            ================================================== -->

                            @if($inquiry->status === 'Replied')

                                <span class="status replied">
                                    Owner Replied
                                </span>

                            @else

                                <span class="status unread">
                                    Waiting for Reply
                                </span>

                            @endif


                            <!-- =================================================
                                 STUDENT REPLY
                            ================================================== -->

                            <div class="reply-form">

                                <form
                                    action="{{ route('student.messages.reply', $inquiry->id) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <textarea
                                        name="message"
                                        placeholder="Write a reply to the owner..."
                                        required
                                    ></textarea>

                                    <button
                                        type="submit"
                                        class="reply-button"
                                    >
                                        Send Reply
                                    </button>

                                </form>

                            </div>


                        </div>


                    @endforeach


                </div>


            @else


                <!-- =================================================
                     NO MESSAGES
                ================================================== -->

                <div class="no-messages">

                    <div class="no-messages-icon">
                        💬
                    </div>

                    <h2>
                        No Messages Yet
                    </h2>

                    <p>
                        You don't have any inquiries yet.
                    </p>

                </div>


            @endif


        </div>

    </div>


</body>

</html>
