<div class="modal fade" id="complaintConversationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 radius-20 overflow-hidden shadow-lg chat-modal-premium">

            <!-- Modal Header -->
            <div class="chat-header-premium px-24 py-20">
                <div class="d-flex align-items-start justify-content-between">

                    <div class="d-flex align-items-center gap-16">
                        <div class="chat-target-avatar-wrap position-relative">
                            <img src="{{ asset('assets/images/_ (11).jpeg') }}" id="chatModalTargetPhoto"
                                class="chat-target-avatar" alt="target">
                            <span class="avatar-status-dot"></span>
                        </div>

                        <div>
                            <div class="d-flex align-items-center gap-8 flex-wrap">
                                <h5 class="modal-title fw-bold text-neutral-900 mb-0 me-8 text-md"
                                    id="chatModalSubject">
                                    Homework Issue
                                </h5>
                                <span class="status-pill status-open" id="chatModalStatus">
                                    <span class="status-dot"></span> Open
                                </span>
                            </div>
                            <small class="text-neutral-500 text-xs d-flex align-items-center gap-6 mt-2"
                                id="chatModalMeta">
                                <i class="ri-hashtag"></i> CMP-1082 &nbsp;&middot;&nbsp; 28 Jul 2026
                            </small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center   gap-8">
                        <!-- Quick actions -->
                        <div class="dropdown">
                            <button type="button"
                                class="chat-icon-btn border-primary-600 hover:bg-primary-600 hover:text-white"
                                data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                                <i class="ri-more-2-fill text-primary-600"></i>
                            </button>
                            <ul
                                class="dropdown-menu dropdown-menu-end shadow-lg border-0 radius-12 p-8 chat-actions-menu">
                                <li>
                                    <button type="button"
                                        class="dropdown-item radius-8 d-flex align-items-center gap-8 py-8 markResolvedBtn"
                                        id="markResolvedBtn" value="resolve">
                                        <i class="ri-checkbox-circle-line text-success-600"></i> Mark as Resolved
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="dropdown-item radius-8 d-flex align-items-center gap-8 py-8 escalateComplaintBtn"
                                        id="escalateComplaintBtn">
                                        <i class="ri-alarm-warning-line text-warning-600"></i> Escalate
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="dropdown-item radius-8 d-flex align-items-center gap-8 py-8 closeComplaintBtn"
                                        id="closeComplaintBtn">
                                        <i class="ri-close-circle-line text-danger-600"></i> Close Ticket
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="dropdown-item radius-8 d-flex align-items-center gap-8 py-8 reopenComplaintBtn"
                                        id="reopenComplaintBtn">
                                        <i class="ri-refresh-line text-info-600"></i> Reopen
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="dropdown-item radius-8 d-flex align-items-center gap-8 py-8 rejectComplaintBtn"
                                        id="rejectComplaintBtn">
                                        <i class="ri-forbid-line text-danger-600"></i> Reject
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <x-model-close style="height:35px; width:35px; " />


                    </div>
                </div>
            </div>

            <!-- Complaint Info Strip -->
            <div class="chat-info-strip px-24 py-16">
                <div class="row g-10">
                    <div class="col-sm-4">
                        <div class="info-chip">
                            <span class="info-chip-icon bg-primary-50 text-primary-600"><i
                                    class="ri-user-star-line"></i></span>
                            <div>
                                <span class="info-chip-label">Complaint For</span>
                                <strong class="info-chip-value" id="chatModalTargetName">Rahul Sharma &middot;
                                    10A</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="info-chip">
                            <span class="info-chip-icon bg-info-50 text-info-600"><i
                                    class="ri-user-voice-line"></i></span>
                            <div>
                                <span class="info-chip-label">Raised By</span>
                                <strong class="info-chip-value" id="chatModalRaiserName">Mr. Sharma (Parent)</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="info-chip">
                            <span class="info-chip-icon bg-danger-50 text-danger-600"><i
                                    class="ri-flag-2-line"></i></span>
                            <div>
                                <span class="info-chip-label">Priority</span>
                                <strong class="info-chip-value" id="chatModalPriority">
                                    <span class="priority-dot priority-high"></span> High
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Body (Scrollable Chat History) -->
            <div class="modal-body chat-body-premium p-24" id="conversationChatBody">


            </div>

            <!-- Modal Footer -->
            <div class="chat-footer-premium border-top border-neutral-200 p-16 bg-white">

                <!-- Selected attachment preview (hidden by default, filled via JS) -->
                <div class="attach-preview-row d-none" id="attachPreviewRow"></div>

                <form id="sendConversationForm" class="d-flex align-items-center gap-10">
                    @csrf
                    <input type="hidden" name="complaint_id" id="chat_complaint_id" value="">

                    {{-- <label for="chatFileInput" class="chat-icon-btn chat-icon-btn-ghost" title="Attach file">
                        <i class="ri-attachment-2"></i>
                        <input type="file" id="chatFileInput" name="attachment" class="d-none">
                    </label>
                    <label for="chatImageInput" class="chat-icon-btn chat-icon-btn-ghost" title="Attach image">
                        <i class="ri-image-line"></i>
                        <input type="file" id="chatImageInput" name="image" accept="image/*" class="d-none">
                    </label> --}}

                    <!-- Input Box -->
                    <div class="position-relative flex-grow-1">
                        <input type="text" class="chat-input-premium" id="chatMessageInput" name="message"
                            placeholder="Write a message..." required autocomplete="off">
                    </div>

                    <!-- Send Button -->
                    <button type="submit" class="chat-send-btn" title="Send">
                        <i class="ri-send-plane-fill"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@push('styles')
    <style>
        .status-progress {
            background: #e0f2fe;
            color: #0369a1;
        }

        .status-progress .status-dot {
            background: #0ea5e9;
        }

        .status-closed {
            background: #f1f5f9;
            color: #475569;
        }

        .status-closed .status-dot {
            background: #64748b;
        }

        .status-reopened {
            background: #fff1e6;
            color: #c2410c;
        }

        .status-reopened .status-dot {
            background: #f97316;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-rejected .status-dot {
            background: #ef4444;
        }

        /* ============ Shell ============ */
        .chat-modal-premium {
            --chat-primary: #4a5bf6;
            --chat-primary-dark: #3d4bd6;
        }

        /* ============ Header ============ */
        .chat-header-premium {
            background: linear-gradient(135deg, #f3f4ff 0%, #ffffff 65%);
            border-bottom: 1px solid #ecebfa;
        }

        .chat-target-avatar-wrap {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
        }

        .chat-target-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #e3e5ff;
        }

        .avatar-status-dot {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #16a34a;
            border: 2px solid #fff;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            padding: 4px 10px 4px 8px;
            border-radius: 20px;
        }

        .status-pill .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-open {
            background: #fff7e6;
            color: #b45309;
        }

        .status-open .status-dot {
            background: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, .18);
            animation: pulse-dot 1.8s infinite;
        }

        .status-resolved {
            background: #ecfdf3;
            color: #067647;
        }

        .status-resolved .status-dot {
            background: #17b26a;
        }

        @keyframes pulse-dot {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, .35);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(245, 158, 11, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        .chat-icon-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #eceefb;
            background: #fff;
            color: #6b7089;
            font-size: 16px;
            transition: all .15s ease;
        }

        /* .chat-icon-btn:hover {
                                                    background: var(--chat-primary);
                                                    border-color: var(--chat-primary);
                                                    color: #fff;
                                                } */

        .chat-icon-btn-ghost {
            border: none;
            background: transparent;
            color: #9295ab;
        }

        .chat-icon-btn-ghost:hover {
            background: #eef0ff;
            color: var(--chat-primary);
        }

        .chat-actions-menu {
            min-width: 190px;
        }

        .chat-actions-menu .dropdown-item {
            font-size: 13px;
            font-weight: 600;
            color: #3d4159;
        }

        .chat-actions-menu .dropdown-item:hover {
            background: #f4f5ff;
        }

        /* ============ Info Strip ============ */
        .chat-info-strip {
            background: #fbfbfe;
            border-bottom: 1px solid #f0f1f8;
        }

        .info-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-chip-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .info-chip-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #9599b3;
        }

        .info-chip-value {
            font-size: 13px;
            color: #2c2f42;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .priority-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }

        .priority-high {
            background: #e11d48;
        }

        .priority-medium {
            background: #f59e0b;
        }

        .priority-low {
            background: #22c55e;
        }

        /* ============ Chat Body ============ */
        .chat-body-premium {
            background:
                radial-gradient(circle, #eceefb 1px, transparent 1px) 0 0/16px 16px,
                #f7f8fc;
            max-height: 420px;
            overflow-y: auto;
        }

        .chat-body-premium::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body-premium::-webkit-scrollbar-thumb {
            background: #d3d6ee;
            border-radius: 10px;
        }

        .chat-date-separator {
            text-align: center;
            margin: 4px 0 20px;
            position: relative;
        }

        .chat-date-separator span {
            background: #fff;
            border: 1px solid #ecedf7;
            color: #9599b3;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
        }

        .chat-msg-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 22px;
            animation: chat-fade-in .25s ease;
        }

        @keyframes chat-fade-in {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-msg-sent {
            justify-content: flex-end;
        }

        .chat-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px #ecedf7;
        }

        .chat-msg-col {
            display: flex;
            flex-direction: column;
            max-width: 78%;
        }

        .chat-msg-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            padding: 0 4px;
        }

        .chat-bubble {
            padding: 11px 14px;
            font-size: 13.5px;
            line-height: 1.5;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
        }

        .chat-bubble-received {
            background: #fff;
            border: 1px solid #eef0f7;
            color: #363a52;
            border-radius: 4px 16px 16px 16px;
        }

        .chat-bubble-sent {
            background: linear-gradient(135deg, var(--chat-primary) 0%, var(--chat-primary-dark) 100%);
            color: #fff;
            border-radius: 16px 4px 16px 16px;
        }

        .chat-seen-tag {
            font-size: 10.5px;
            color: #9599b3;
            margin-top: 4px;
            padding: 0 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* ============ Footer ============ */
        .chat-footer-premium {
            box-shadow: 0 -2px 10px rgba(16, 24, 40, .03);
        }

        .chat-input-premium {
            width: 100%;
            border: 1px solid #e7e8f3;
            background: #f7f8fc;
            border-radius: 24px;
            padding: 11px 18px;
            font-size: 13.5px;
            color: #2c2f42;
            outline: none;
            transition: all .15s ease;
        }

        .chat-input-premium:focus {
            background: #fff;
            border-color: var(--chat-primary);
            box-shadow: 0 0 0 3px rgba(74, 91, 246, .12);
        }

        .chat-send-btn {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: none;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--chat-primary) 0%, var(--chat-primary-dark) 100%);
            color: #fff;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(74, 91, 246, .32);
            transition: transform .12s ease;
        }

        .chat-send-btn:hover {
            transform: translateY(-1px) scale(1.03);
        }

        .chat-send-btn:active {
            transform: scale(.94);
        }

        .attach-preview-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .attach-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f4f5ff;
            border: 1px solid #e3e5ff;
            color: #4a5bf6;
            font-size: 11.5px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .attach-chip button {
            border: none;
            background: transparent;
            color: #9599b3;
            font-size: 13px;
            line-height: 1;
            padding: 0;
        }
    </style>
@endpush


@push('script')
    <script>
        $(function() {

            // ================= Open Modal on button click (globally delegated) =================
            $(document).on('click', '.open-conversation-btn', function() {
                let complaintId = $(this).data('id');
                $('#chat_complaint_id').val(complaintId);

                $('#closeComplaintBtn').attr('data-id', complaintId);

                // Turant modal open karo, andar loading dikhao
                $('#conversationChatBody').html(
                    '<div class="text-center py-3 text-neutral-400">Loading conversation...</div>'
                );
                $('#complaintConversationModal').modal('show');

                loadConversation(complaintId);
            });

            // ================= Fetch complaint + messages and populate modal =================
            function loadConversation(complaintId) {
                getDataById("{{ route('school.complaint.get.with') }}", complaintId, function(res) {
                    if (res.status && res.data) {
                        populateConversationModal(res.data);
                    } else {
                        $('#conversationChatBody').html(
                            '<div class="text-center py-3 text-danger-600">Unable to load conversation.</div>'
                        );
                    }
                    setTimeout(() => {
                        let chatBody = document.getElementById('conversationChatBody');
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }, 200);
                });
            }

            // ================= Populate full modal (header + info-strip + messages) =================
            function populateConversationModal(data) {

                // ---- Header: Subject ----
                $('#chatModalSubject').text(data.subject || 'N/A');

                // ---- Header: Status pill ----
                setStatusPill(data.status);

                // ---- Header: Complaint No + Date ----
                let createdDate = data.created_at ? new Date(data.created_at).toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                }) : '';
                $('#chatModalMeta').html(
                    `<i class="ri-hashtag"></i> ${data.complaint_no || ''} &nbsp;&middot;&nbsp; ${createdDate}`
                );

                // ---- Info Strip: Complaint For (Target) ----
                let target = data.person_details || {};
                let targetName = `${target.first_name || ''} ${target.last_name || ''}`.trim() || 'N/A';
                let className = target.class_master ? target.class_master.name : '';
                let sectionName = target.section ? target.section.name : '';
                let classDetails = className ? `${className}${sectionName ? ' (' + sectionName + ')' : ''}` : '';
                $('#chatModalTargetName').text(classDetails ? `${targetName} · ${classDetails}` : targetName);

                if (target.student_photo) {
                    $('#chatModalTargetPhoto').attr('src', '/' + target.student_photo);
                } else {
                    $('#chatModalTargetPhoto').attr('src', "{{ asset('assets/images/_ (11).jpeg') }}");
                }

                // ---- Info Strip: Raised By ----
                let raiserName = data.raised_by_name ||
                    (data.raised_by_type == 1 ? 'Admin' : (data.raised_by_type == 2 ? 'Staff' : 'Parent'));
                $('#chatModalRaiserName').text(raiserName);

                // ---- Info Strip: Priority ----
                let priorityHtml = '';
                switch (parseInt(data.priority)) {
                    case 1:
                        priorityHtml = '<span class="priority-dot priority-low"></span> Low';
                        break;
                    case 2:
                        priorityHtml = '<span class="priority-dot priority-medium"></span> Medium';
                        break;
                    case 3:
                        priorityHtml = '<span class="priority-dot priority-high"></span> High';
                        break;
                    default:
                        priorityHtml = '<span class="priority-dot"></span> N/A';
                }
                $('#chatModalPriority').html(priorityHtml);

                // ---- Messages ----
                renderConversation(data.messages);
            }

            // ================= Set / update status pill (used on load + after admin reply) =================
            // function setStatusPill(status) {
            //     let statusHtml = '';
            //     let statusClass = 'status-open';
            //     switch (parseInt(status)) {
            //         case 1:
            //             statusHtml = '<span class="status-dot"></span> Open';
            //             statusClass = 'status-open';
            //             break;
            //         case 2:
            //             statusHtml = '<span class="status-dot"></span> In Progress';
            //             statusClass = 'status-open';
            //             break;
            //         case 3:
            //             statusHtml = '<span class="status-dot"></span> Resolved';
            //             statusClass = 'status-resolved';
            //             break;
            //         case 4:
            //             statusHtml = '<span class="status-dot"></span> Closed';
            //             statusClass = 'status-resolved';
            //             break;
            //         default:
            //             statusHtml = '<span class="status-dot"></span> Unknown';
            //             statusClass = 'status-open';
            //     }
            //     $('#chatModalStatus').attr('class', 'status-pill ' + statusClass).html(statusHtml);
            // }

            // ================= setStatusPill: ab 7 status ke hisaab se =================
            function setStatusPill(status) {
                let statusHtml = '';
                let statusClass = 'status-open';

                switch (parseInt(status)) {
                    case 1:
                        statusHtml = '<span class="status-dot"></span> Open';
                        statusClass = 'status-open';
                        break;
                    case 2:
                        statusHtml = '<span class="status-dot"></span> Under Review';
                        statusClass = 'status-progress';
                        break;
                    case 3:
                        statusHtml = '<span class="status-dot"></span> In Progress';
                        statusClass = 'status-progress';
                        break;
                    case 4:
                        statusHtml = '<span class="status-dot"></span> Resolved';
                        statusClass = 'status-resolved';
                        break;
                    case 5:
                        statusHtml = '<span class="status-dot"></span> Closed';
                        statusClass = 'status-closed';
                        break;
                    case 6:
                        statusHtml = '<span class="status-dot"></span> Reopened';
                        statusClass = 'status-reopened';
                        break;
                    case 7:
                        statusHtml = '<span class="status-dot"></span> Rejected';
                        statusClass = 'status-rejected';
                        break;
                    default:
                        statusHtml = '<span class="status-dot"></span> Unknown';
                }

                $('#chatModalStatus').attr('class', 'status-pill ' + statusClass).html(statusHtml);

                // Current status ke hisaab se dropdown me relevant buttons hi dikhao
                toggleActionButtons(status);
            }

            // ================= Dropdown me sirf relevant actions dikhao =================
            function toggleActionButtons(status) {
                status = parseInt(status);

                // Sab pehle chhupao, phir jo chahiye dikhao
                $('#markResolvedBtn, #escalateComplaintBtn, #closeComplaintBtn, #reopenComplaintBtn, #rejectComplaintBtn')
                    .closest('li').show();

                if (status === 4 || status === 5 || status === 7) {
                    // Resolved / Closed / Rejected -> sirf Reopen dikhna chahiye
                    $('#markResolvedBtn, #escalateComplaintBtn, #closeComplaintBtn, #rejectComplaintBtn').closest(
                        'li').hide();
                } else {
                    // Open / Under Review / In Progress / Reopened -> Reopen ka koi matlab nahi
                    $('#reopenComplaintBtn').closest('li').hide();
                }
            }

            // ================= Generic status-action handler =================
            function handleStatusAction(routeName, complaintId, action) {

                $.ajax({
                    url: routeName,
                    method: "POST",
                    data: {
                        id: complaintId,
                        _method: "PUT",
                        _token: "{{ csrf_token() }}",
                        action :action
                    },
                    success: function(res) {
                        if (res.status && res.data) {
                            setStatusPill(res.data.status);
                        } else {
                            showToast('error', res.message || 'Action failed.')

                        }
                    },
                    error: function(xhr) {
                        showToast('error', res.responseText || 'Something went wrong.')
                    }
                });

            }

            let statusRoute = "{{ route('school.complaint.status') }}";

            $(document).on('click', '#markResolvedBtn', function() {
                let action = "resolve";
                let complaintId = $('#chat_complaint_id').val();

                handleStatusAction(statusRoute, complaintId, action);
            });

            $(document).on('click', '#closeComplaintBtn', function() {
                   let action = "resolve";
                let complaintId = $('#chat_complaint_id').val();
                handleStatusAction(statusRoute, complaintId, action);
            });

            $(document).on('click', '#reopenComplaintBtn', function() {
                   let action = "reopen";
                let complaintId = $('#chat_complaint_id').val();
                handleStatusAction(statusRoute, complaintId, action);
            });

            $(document).on('click', '#rejectComplaintBtn', function() {
                   let action = "reject";
                let complaintId = $('#chat_complaint_id').val();
                handleStatusAction(statusRoute, complaintId, action);
            });

            $(document).on('click', '#escalateComplaintBtn', function() {
                   let action = "escalate";
                let complaintId = $('#chat_complaint_id').val();
                handleStatusAction(statusRoute, complaintId, action);
            });

            // ================= Render chat messages (full list) =================
            function renderConversation(messages) {
                let html = '';
                if (!messages || messages.length === 0) {
                    html =
                        '<div class="text-center py-3 text-neutral-400">No messages yet. Start the conversation below.</div>';
                } else {
                    $.each(messages, function(i, msg) {
                        html += buildMessageHtml(msg);
                    });
                }
                $('#conversationChatBody').html(html);
            }

            // ================= Build a single message bubble HTML =================
            // created_by_type: 1 = Admin, 2 = Staff, 3 = Student

            function buildMessageHtml(msg) {
                let isSent = parseInt(msg.created_by_type) === 1;

                let senderName = msg.sender_name;
                if (!senderName) {
                    switch (parseInt(msg.created_by_type)) {
                        case 1:
                            senderName = 'Admin Support';
                            break;
                        case 2:
                            senderName = 'Staff';
                            break;
                        case 3:
                            senderName = 'Student';
                            break;
                        default:
                            senderName = 'User';
                    }
                }

                let timeStr = msg.created_at ?
                    new Date(msg.created_at).toLocaleTimeString('en-IN', {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) :
                    'Just now';

                let avatarUrl = msg.sender_photo ||
                    (isSent ? "{{ asset('assets/images/chat/8.png') }}" :
                        "{{ asset('assets/images/chat/2.png') }}");

                return `
                <div class="chat-msg-row ${isSent ? 'chat-msg-sent' : 'chat-msg-received'}">
                    ${!isSent ? `<img src="${avatarUrl}" class="chat-avatar" alt="User">` : ''}
                    <div class="chat-msg-col ${isSent ? 'align-items-end' : ''}">
                        <div class="chat-msg-meta ${isSent ? 'flex-row-reverse' : ''}">
                            <span class="fw-semibold text-xs text-neutral-800">${senderName}</span>
                            <span class="text-xs text-neutral-400">${timeStr}</span>
                        </div>
                        <div class="chat-bubble ${isSent ? 'chat-bubble-sent' : 'chat-bubble-received'}">
                            ${msg.message ?? ''}
                        </div>
                    </div>
                    ${isSent ? `<img src="${avatarUrl}" class="chat-avatar" alt="User">` : ''}
                </div>`;
            }

            // ================= Send new message (real API call) =================
            $('#sendConversationForm').on('submit', function(e) {
                e.preventDefault();

                let message = $('#chatMessageInput').val().trim();
                let complaintId = $('#chat_complaint_id').val();
                if (!message || !complaintId) return;

                // Agar body me "No messages yet" wala placeholder hai to usse clear kar do
                if ($('#conversationChatBody').find('.chat-msg-row').length === 0) {
                    $('#conversationChatBody').empty();
                }

                let $btn = $('.chat-send-btn');
                $btn.prop('disabled', true);

                $.post("{{ route('school.complaintMessage.save') }}", {
                    _token: "{{ csrf_token() }}",
                    complaint_id: complaintId,
                    message: message,
                    message_type: 1
                }, function(res) {
                    if (res.status && res.data) {
                        $('#conversationChatBody').append(buildMessageHtml(res.data));
                        $('#chatMessageInput').val('');

                        // Complaint agar Open se In Progress hui hai to status pill live update kar do
                        if (res.complaint_status !== undefined) {
                            setStatusPill(res.complaint_status);
                        }
                    } else {
                        alert(res.message || 'Unable to send message.');
                    }
                }).fail(function() {
                    alert('Something went wrong while sending the message.');
                }).always(function() {
                    $btn.prop('disabled', false);
                    let chatBody = document.getElementById('conversationChatBody');
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
            });

            // ================= Attachment preview =================
            function bindAttachPreview(inputId, icon) {
                $(document).on('change', '#' + inputId, function() {
                    const file = this.files[0];
                    if (!file) return;

                    $('#attachPreviewRow').removeClass('d-none');

                    const $chip = $(`
                        <span class="attach-chip" data-for="${inputId}">
                            <i class="${icon}"></i> ${file.name}
                            <button type="button" class="remove-attach-chip"><i class="ri-close-line"></i></button>
                        </span>
                    `);

                    $('#attachPreviewRow').find(`[data-for="${inputId}"]`).remove();
                    $('#attachPreviewRow').append($chip);
                });
            }

            bindAttachPreview('chatFileInput', 'ri-file-line');
            bindAttachPreview('chatImageInput', 'ri-image-line');

            $(document).on('click', '.remove-attach-chip', function() {
                const $chip = $(this).closest('.attach-chip');
                const inputId = $chip.data('for');
                $('#' + inputId).val('');
                $chip.remove();
                if ($('#attachPreviewRow').children().length === 0) {
                    $('#attachPreviewRow').addClass('d-none');
                }
            });

            // ================= Auto-scroll to bottom whenever modal opens =================
            $('#complaintConversationModal').on('shown.bs.modal', function() {
                const $body = $('#conversationChatBody');
                $body.scrollTop($body[0].scrollHeight);
            });

        });
    </script>
@endpush
