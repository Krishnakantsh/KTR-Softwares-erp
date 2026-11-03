let display = document.querySelector(".display");
let days = document.querySelector(".days");
let previous = document.querySelector(".left");
let next = document.querySelector(".right");
let calendarWidget = document.querySelector(".calendar");

let date = new Date();

let year = date.getFullYear();
let month = date.getMonth();

let eventsByDate = {};

const eventsUrl = calendarWidget ? calendarWidget.dataset.eventsUrl : null;
const sessionId = calendarWidget ? calendarWidget.dataset.sessionId : null;
const schoolId = calendarWidget ? calendarWidget.dataset.schoolId : null;

function pad(n) {
    return String(n).padStart(2, "0");
}

function fetchMonthEvents(y, m) {
    if (!eventsUrl || !sessionId) {
        eventsByDate = {};
        return Promise.resolve();
    }

    const monthStr = `${y}-${pad(m + 1)}`;
    const params = new URLSearchParams({
        month: monthStr,
        session_id: sessionId,
    });
    if (schoolId) params.append("school_id", schoolId);

    return fetch(`${eventsUrl}?${params.toString()}`, {
        headers: { "X-Requested-With": "XMLHttpRequest" },
    })
        .then((res) => res.json())
        .then((res) => {
            eventsByDate = {};
            const events = (res && res.data) || [];

            events.forEach((ev) => {
                const startKey = (ev.start_date || "")
                    .split(" ")[0]
                    .split("T")[0];
                const endKey = ev.end_date
                    ? ev.end_date.split(" ")[0].split("T")[0]
                    : startKey;

                let cursor = new Date(startKey);
                const end = new Date(endKey);

                // multi-day event ho to har din par daal do (dot dikhane ke liye)
                while (cursor <= end) {
                    const key = cursor.toDateString();
                    if (!eventsByDate[key]) eventsByDate[key] = [];
                    eventsByDate[key].push(ev);
                    cursor.setDate(cursor.getDate() + 1);
                }
            });
        })
        .catch((err) => {
            console.error("Failed to load calendar events", err);
            eventsByDate = {};
        });
}

function formatDateDisplay(dateStrKey) {
    const d = new Date(dateStrKey);
    return d.toLocaleDateString("en-US", {
        day: "numeric",
        month: "short",
        year: "numeric",
    });
}

function formatEventRange(ev) {
    const startKey = (ev.start_date || "").split(" ")[0].split("T")[0];
    const endKey = ev.end_date
        ? ev.end_date.split(" ")[0].split("T")[0]
        : startKey;

    let text = formatDateDisplay(startKey);
    if (endKey && endKey !== startKey) {
        text += " - " + formatDateDisplay(endKey);
    }
    if (!ev.is_full_day && ev.start_time) {
        text += ` (${ev.start_time}${ev.end_time ? " - " + ev.end_time : ""})`;
    }
    return text;
}

function escapeHtml(str) {
    const div = document.createElement("div");
    div.textContent = str == null ? "" : str;
    return div.innerHTML;
}

// Calendar ke neeche "Month Events" list banata hai
function renderEventsList() {
    const listEl = document.getElementById("calendarEventsList");
    if (!listEl) return;

    listEl.innerHTML = "";

    const keys = Object.keys(eventsByDate).sort(
        (a, b) => new Date(a) - new Date(b),
    );
    const seen = new Set();
    let hasAny = false;

    keys.forEach((dateKey) => {
        eventsByDate[dateKey].forEach((ev) => {
            // list mein sirf start date ke din ek baar dikhao (multi-day event repeat na ho)
            const startKey = new Date(
                (ev.start_date || "").split(" ")[0].split("T")[0],
            ).toDateString();
            const uniqueKey = ev.id + "-" + startKey;
            if (startKey !== dateKey || seen.has(uniqueKey)) return;
            seen.add(uniqueKey);
            hasAny = true;

            const item = document.createElement("div");
            item.className =
                "d-flex align-items-center justify-content-between gap-16 calendar-event-item";
            item.style.cursor = "pointer";
            item.innerHTML = `
                <div class="ps-10 border-start-width-3-px" style="border-color:${escapeHtml(ev.color || "#487FFF")}">
                    <p class="text-secondary-light mb-2 text-sm">${escapeHtml(formatEventRange(ev))}</p>
                    <h6 class="text-md fw-medium mb-0">${escapeHtml(ev.title)}</h6>
                </div>
            `;
            item.addEventListener("click", () => openEventModal(ev));
            listEl.appendChild(item);
        });
    });

    if (!hasAny) {
        listEl.innerHTML =
            '<p class="text-secondary-light text-center mb-0">Is month mein koi event nahi hai.</p>';
    }
}

// Ek event ka detail popup mein dikhata hai
function openEventModal(ev) {
    const titleEl = document.getElementById("eventModalTitle");
    const dateEl = document.getElementById("eventModalDate");
    const locationEl = document.getElementById("eventModalLocation");
    const descEl = document.getElementById("eventModalDescription");
    const priorityEl = document.getElementById("eventModalPriority");

    if (titleEl) titleEl.textContent = ev.title || "";
    if (dateEl) dateEl.textContent = formatEventRange(ev);
    if (locationEl) locationEl.textContent = ev.location || "-";
    if (descEl)
        descEl.textContent = ev.description || "Koi description nahi hai.";
    if (priorityEl) priorityEl.textContent = ev.priority || "-";

    const modalEl = document.getElementById("calendarEventShowModal");
    if (modalEl && window.bootstrap) {
        window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
}

// Jab ek din mein 1 se zyada events ho, pehle unki list dikhata hai
function openDayEventsModal(dateKey, events) {
    const body = document.getElementById("dayEventsModalBody");
    const labelEl = document.getElementById("dayEventsModalLabel");
    if (!body) return;

    body.innerHTML = "";
    events.forEach((ev) => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "w-100 text-start btn btn-outline-primary mb-8";
        btn.textContent = ev.title;
        btn.addEventListener("click", () => {
            const dayModalEl = document.getElementById("dayEventsModal");
            if (dayModalEl && window.bootstrap) {
                window.bootstrap.Modal.getOrCreateInstance(dayModalEl).hide();
            }
            openEventModal(ev);
        });
        body.appendChild(btn);
    });

    if (labelEl)
        labelEl.textContent = "Events on " + formatDateDisplay(dateKey);

    const modalEl = document.getElementById("dayEventsModal");
    if (modalEl && window.bootstrap) {
        window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
}

// Date box par click hone par call hota hai
function handleDayClick(dateKey) {
    document
        .querySelectorAll(".day--selected")
        .forEach((el) => el.classList.remove("day--selected"));
    const dayEl = days.querySelector(`[data-date="${dateKey}"]`);
    if (dayEl) dayEl.classList.add("day--selected");

    const events = eventsByDate[dateKey] || [];
    if (events.length === 1) {
        openEventModal(events[0]);
    } else if (events.length > 1) {
        openDayEventsModal(dateKey, events);
    }
}

function displayCalendar() {
    const firstDay = new Date(year, month, 1);

    const lastDay = new Date(year, month + 1, 0);

    const firstDayIndex = firstDay.getDay(); //4

    const numberOfDays = lastDay.getDate(); //31

    let formattedDate = date.toLocaleString("en-US", {
        month: "long",
        year: "numeric",
    });

    display.innerHTML = `${formattedDate}`;

    // Pehle selected month ki events fetch karo, phir grid banao
    fetchMonthEvents(year, month).then(() => {
        days.innerHTML = "";

        for (let x = 1; x <= firstDayIndex; x++) {
            const div = document.createElement("div");
            div.innerHTML += "";

            days.appendChild(div);
        }

        for (let i = 1; i <= numberOfDays; i++) {
            let div = document.createElement("div");
            let currentDate = new Date(year, month, i);
            const dateKey = currentDate.toDateString();

            div.dataset.date = dateKey;

            div.innerHTML += i;
            days.appendChild(div);
            if (
                currentDate.getFullYear() === new Date().getFullYear() &&
                currentDate.getMonth() === new Date().getMonth() &&
                currentDate.getDate() === new Date().getDate()
            ) {
                div.classList.add("current-date");
            }

            // Is date par event(s) hain to dot dikhao aur click karne layak banao
            if (eventsByDate[dateKey] && eventsByDate[dateKey].length) {
                console.log("Event : ", eventsByDate[dateKey]);

                if (eventsByDate[dateKey].is_holiday == true) {
                    div.classList.add("is_holiday");
                }

                div.classList.add("day--has-events");

                const dot = document.createElement("span");
                dot.className = "event-dot";
                div.appendChild(dot);

                div.addEventListener("click", () => handleDayClick(dateKey));
            }
        }

        renderEventsList();
    });
}

// Call the function to display the calendar
displayCalendar();

previous.addEventListener("click", () => {
    if (month < 0) {
        month = 11;
        year = year - 1;
    }
    month = month - 1;
    date.setMonth(month);
    displayCalendar();
});

next.addEventListener("click", () => {
    if (month > 11) {
        month = 0;
        year = year + 1;
    }

    month = month + 1;
    date.setMonth(month);

    displayCalendar();
});
// ============================= Calendar Js End =================================
