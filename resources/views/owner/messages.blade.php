<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Messages | AccomFinder</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICONS -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;

            width: 100%;
            height: 100%;
        }

        body {
            background: #f5f8fc;

            font-family: Arial, sans-serif;

            color: #132238;

            overflow: hidden;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width: 264px;

            height: 100vh;

            background: #ffffff;

            border-right: 1px solid #dce3eb;

            position: fixed;

            left: 0;
            top: 0;

            z-index: 1000;

            overflow-y: auto;
            overflow-x: hidden;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            height: 138px;

            padding: 35px 26px 20px;

            border-bottom: 1px solid #dce3eb;
        }

        .logo h2 {

            margin: 0;

            font-size: 29px;

            font-weight: 700;

            color: #168d68;

            letter-spacing: -1px;
        }

        .logo h2 span {

            color: #193e67;
        }

        .logo small {

            display: block;

            margin-top: -3px;

            color: #66758a;

            font-size: 14px;

            font-weight: 600;
        }


        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .menu {

            padding: 38px 5px;
        }

        .menu a {

            display: flex;

            align-items: center;

            gap: 10px;

            margin: 0 0 8px 0;

            padding: 14px 26px;

            color: #30435c;

            text-decoration: none;

            border-radius: 11px;

            font-size: 16px;

            transition: 0.2s;
        }

        .menu a:hover {

            background: #eefaf5;

            color: #009b68;
        }

        .menu a.active {

            background: #cdf8e6;

            color: #078e62;
        }

        .menu-icon {

            width: 22px;

            text-align: center;

            font-size: 18px;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .bottom {

            position: absolute;

            bottom: 22px;

            width: 100%;

            padding: 0 5px;
        }

        .bottom a {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 13px 21px;

            color: #30435c;

            text-decoration: none;

            font-size: 16px;

            border-radius: 11px;
        }

        .bottom a:hover {

            color: #dc3545;

            background: #fff5f5;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .content {

            margin-left: 264px;

            width: calc(100% - 264px);

            height: 100vh;

            overflow: hidden;
        }


        /* =====================================================
           FIXED TOP BAR
        ===================================================== */

        .topbar {

            width: calc(100% - 264px);

            height: 74px;

            background: #ffffff;

            border-bottom: 1px solid #dce3eb;

            display: flex;

            justify-content: flex-end;

            align-items: center;

            padding: 0 28px;

            position: fixed;

            top: 0;
            right: 0;
            left: 264px;

            z-index: 900;
        }

        .bell {

            font-size: 23px;

            margin-right: 28px;

            color: #172334;
        }

        .owner-name {

            font-size: 16px;

            font-weight: 600;

            color: #172334;
        }


        /* =====================================================
           SCROLLABLE MAIN
        ===================================================== */

        .main {

            height: calc(100vh - 74px);

            margin-top: 74px;

            padding: 35px 14px 50px;

            overflow-y: auto;

            overflow-x: hidden;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding-bottom: 5px;
        }

        .page-header h1 {

            margin: 0;

            font-size: 38px;

            font-weight: 500;

            color: #132238;
        }

        .page-header p {

            margin: 8px 0 0;

            color: #5d7089;

            font-size: 17px;
        }


        /* =====================================================
           MESSAGES SECTION
        ===================================================== */

        .messages-section {

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 17px;

            margin-top: 30px;

            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }


        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .section-header {

            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .section-header h2 {

            margin: 0;

            font-size: 25px;

            font-weight: 600;

            color: #17395f;
        }


        .section-divider {

            border: 0;

            border-top: 1px solid #e1e6ec;

            margin: 20px 0 25px;
        }


        /* =====================================================
           MESSAGE CARD
        ===================================================== */

        .message-card {

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 14px;

            padding: 22px;

            margin-bottom: 20px;

            transition: 0.2s;
        }

        .message-card:last-child {

            margin-bottom: 0;
        }

        .message-card:hover {

            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }


        /* =====================================================
           MESSAGE HEADER
        ===================================================== */

        .message-top {

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            margin-bottom: 18px;
        }

        .student-info {

            display: flex;

            align-items: center;

            gap: 13px;
        }

        .student-avatar {

            width: 48px;

            height: 48px;

            border-radius: 50%;

            background: #d1fae5;

            color: #168d68;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

            font-weight: 600;
        }

        .student-name {

            color: #17395f;

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 4px;
        }

        .student-contact {

            color: #66778c;

            font-size: 13px;
        }

        .message-date {

            color: #718096;

            font-size: 13px;
        }


        /* =====================================================
           PROPERTY
        ===================================================== */

        .property-box {

            background: #f5f8fc;

            border: 1px solid #e2e8f0;

            border-radius: 9px;

            padding: 13px 15px;

            margin-bottom: 15px;

            color: #53657b;

            font-size: 14px;

            line-height: 1.6;
        }

        .property-box strong {

            color: #17395f;
        }


        /* =====================================================
           ORIGINAL INQUIRY
        ===================================================== */

        .message-text {

            color: #53657b;

            font-size: 14px;

            line-height: 1.7;

            padding: 7px 0 10px;
        }

        .message-text strong {

            color: #17395f;
        }


        /* =====================================================
           CHAT
        ===================================================== */

        .chat-messages {

            margin-top: 15px;
        }

        .chat-message {

            padding: 13px 16px;

            border-radius: 10px;

            margin-bottom: 10px;

            font-size: 14px;

            line-height: 1.6;
        }

        .chat-message.student {

            background: #f1f5f9;

            color: #53657b;
        }

        .chat-message.owner {

            background: #e4faf1;

            color: #53657b;

            margin-left: 45px;
        }

        .chat-message strong {

            display: block;

            margin-bottom: 4px;

            color: #17395f;
        }

        .chat-message.owner strong {

            color: #078e62;
        }


        /* =====================================================
           REPLY BOX
        ===================================================== */

        .reply-box {

            margin-top: 18px;

            padding-top: 18px;

            border-top: 1px solid #e1e6ec;
        }

        .reply-box textarea {

            width: 100%;

            min-height: 90px;

            padding: 12px 14px;

            border: 1px solid #dce3eb;

            border-radius: 9px;

            resize: vertical;

            font-family: Arial, sans-serif;

            font-size: 14px;

            color: #53657b;

            outline: none;
        }

        .reply-box textarea:focus {

            border-color: #14945f;
        }

        .reply-button {

            margin-top: 10px;

            background: #14945f;

            color: #ffffff;

            border: none;

            padding: 10px 18px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 500;

            cursor: pointer;
        }

        .reply-button:hover {

            background: #0d7e50;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: 600;

            margin-top: 12px;
        }

        .status.pending {

            background: #fff4d6;

            color: #a16207;
        }

        .status.replied {

            background: #d9f7e8;

            color: #168451;
        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .success-message {

            background: #d9f7e8;

            color: #168451;

            border: 1px solid #b7efd5;

            padding: 12px 15px;

            border-radius: 9px;

            margin-top: 25px;

            font-size: 14px;
        }

        .error-message {

            background: #fde2e2;

            color: #c73535;

            border: 1px solid #fecaca;

            padding: 12px 15px;

            border-radius: 9px;

            margin-top: 25px;

            font-size: 14px;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-card {

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 14px;

            padding: 55px 25px;

            text-align: center;
        }

        .empty-icon {

            width: 70px;

            height: 70px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: #edf2f7;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #a7b2bf;

            font-size: 34px;
        }

        .empty-card h3 {

            margin: 0 0 8px;

            font-size: 21px;

            color: #243b56;
        }

        .empty-card p {

            margin: 0;

            color: #718096;

            font-size: 15px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 850px) {

            .sidebar {

                width: 220px;
            }

            .content {

                margin-left: 220px;

                width: calc(100% - 220px);
            }

            .topbar {

                left: 220px;

                width: calc(100% - 220px);
            }

        }


        @media (max-width: 600px) {

            .sidebar {

                display: none;
            }

            .content {

                margin-left: 0;

                width: 100%;
            }

            .topbar {

                left: 0;

                width: 100%;
            }

            .main {

                padding-left: 18px;

                padding-right: 18px;
            }

            .message-top {

                flex-direction: column;

                gap: 10px;
            }

            .chat-message.owner {

                margin-left: 10px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="logo">

        <h2>
            <span>Accom</span>Finder
        </h2>

        <small>
            Owner Portal
        </small>

    </div>


    <!-- MENU -->

    <div class="menu">


        <!-- DASHBOARD -->

        <a href="{{ route('owner.dashboard') }}">

            <span class="menu-icon">

                <i class="bi bi-house-door"></i>

            </span>

            Dashboard

        </a>


        <!-- LISTINGS -->

        <a href="{{ route('owner.listings') }}">

            <span class="menu-icon">

                <i class="bi bi-buildings"></i>

            </span>

            Listings

        </a>


        <!-- TENANTS -->

        <a href="{{ route('owner.tenants') }}">

            <span class="menu-icon">

                <i class="bi bi-people"></i>

            </span>

            Tenants

        </a>


        <!-- PAYMENTS -->

        <a href="{{ route('owner.payments') }}">

            <span class="menu-icon">

                <i class="bi bi-cash-stack"></i>

            </span>

            Payments

        </a>


        <!-- REPORTS -->

        <a href="{{ route('owner.reports') }}">

            <span class="menu-icon">

                <i class="bi bi-bar-chart"></i>

            </span>

            Reports

        </a>


        <!-- MESSAGES -->

        <a
            href="{{ route('owner.messages') }}"
            class="active"
        >

            <span class="menu-icon">

                <i class="bi bi-chat-dots"></i>

            </span>

            Messages

        </a>


    </div>


    <!-- LOGOUT -->

    <div class="bottom">

        <a href="{{ route('owner.logout') }}">

            <span class="menu-icon">

                <i class="bi bi-box-arrow-right"></i>

            </span>

            Logout

        </a>

    </div>


</div>



<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<div class="content">


    <!-- =====================================================
         FIXED TOP BAR
    ====================================================== -->

    <div class="topbar">

        <i class="bi bi-bell bell"></i>

        <div class="owner-name">

            {{ session('owner_name', 'Owner') }}

        </div>

    </div>


    <!-- =====================================================
         SCROLLABLE MAIN
    ====================================================== -->

    <div class="main">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <div class="page-header">

            <div>

                <h1>
                    Messages
                </h1>

                <p>
                    Respond to student inquiries about your properties
                </p>

            </div>

        </div>


        <!-- =================================================
             SUCCESS MESSAGE
        ================================================== -->

        @if(session('success'))

            <div class="success-message">

                {{ session('success') }}

            </div>

        @endif


        <!-- =================================================
             ERROR MESSAGE
        ================================================== -->

        @if(session('error'))

            <div class="error-message">

                {{ session('error') }}

            </div>

        @endif


        <!-- =================================================
             MESSAGES SECTION
        ================================================== -->

        <div class="messages-section">


            <div class="section-header">

                <h2>
                    Student Inquiries
                </h2>

            </div>


            <hr class="section-divider">


            @if(isset($inquiries) && $inquiries->count() > 0)


                @foreach($inquiries as $inquiry)


                    <!-- =================================================
                         MESSAGE CARD
                    ================================================== -->

                    <div class="message-card">


                        <!-- STUDENT -->

                        <div class="message-top">

                            <div class="student-info">


                                <div class="student-avatar">

                                    {{
                                        strtoupper(
                                            substr(
                                                $inquiry->student->name ?? 'S',
                                                0,
                                                1
                                            )
                                        )
                                    }}

                                </div>


                                <div>

                                    <div class="student-name">

                                        {{ $inquiry->student->name ?? 'Student' }}

                                    </div>


                                    <div class="student-contact">

                                        {{ $inquiry->student->email ?? 'No email' }}


                                        @if(!empty($inquiry->student->phone))

                                            &nbsp; • &nbsp;

                                            {{ $inquiry->student->phone }}

                                        @endif

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
                                Property:
                            </strong>

                            {{ $inquiry->accommodation->name ?? 'Unknown Property' }}


                            @if(!empty($inquiry->accommodation->address))

                                <br>

                                <i class="bi bi-geo-alt-fill"></i>

                                {{ $inquiry->accommodation->address }}

                            @endif

                        </div>


                        <!-- ORIGINAL INQUIRY -->

                        <div class="message-text">

                            <strong>
                                Student Inquiry:
                            </strong>

                            <br>

                            {{ $inquiry->message }}

                        </div>


                        <!-- =================================================
                             CONVERSATION
                        ================================================== -->

                        @php

                            $messages = \App\Models\Message::where(
                                'inquiry_id',
                                $inquiry->id
                            )
                            ->orderBy('created_at', 'asc')
                            ->get();

                        @endphp


                        @if($messages->count() > 0)


                            <div class="chat-messages">


                                @foreach($messages as $message)


                                    @if($message->sender_type === 'student')


                                        <div class="chat-message student">

                                            <strong>

                                                <i class="bi bi-person"></i>

                                                Student:

                                            </strong>

                                            {{ $message->message }}

                                        </div>


                                    @else


                                        <div class="chat-message owner">

                                            <strong>

                                                <i class="bi bi-person-check"></i>

                                                You:

                                            </strong>

                                            {{ $message->message }}

                                        </div>


                                    @endif


                                @endforeach


                            </div>


                        @endif


                        <!-- =================================================
                             OWNER REPLY
                        ================================================== -->

                        <div class="reply-box">


                            <form
                                action="{{ route('owner.messages.reply', $inquiry->id) }}"
                                method="POST"
                            >

                                @csrf


                                <textarea
                                    name="reply"
                                    placeholder="Write your reply to the student..."
                                    required
                                ></textarea>


                                <button
                                    type="submit"
                                    class="reply-button"
                                >

                                    <i class="bi bi-send"></i>

                                    Send Reply

                                </button>


                            </form>


                        </div>


                        <!-- =================================================
                             STATUS
                        ================================================== -->

                        @if($inquiry->status === 'Replied')


                            <span class="status replied">

                                <i class="bi bi-check-circle-fill"></i>

                                Replied

                            </span>


                        @else


                            <span class="status pending">

                                <i class="bi bi-clock"></i>

                                New Inquiry

                            </span>


                        @endif


                    </div>


                @endforeach


            @else


                <!-- =================================================
                     EMPTY STATE
                ================================================== -->

                <div class="empty-card">


                    <div class="empty-icon">

                        <i class="bi bi-chat-dots"></i>

                    </div>


                    <h3>
                        No Messages Yet
                    </h3>


                    <p>
                        Students will see your properties and send inquiries!
                    </p>


                </div>


            @endif


        </div>


    </div>


</div>


</body>

</html>
